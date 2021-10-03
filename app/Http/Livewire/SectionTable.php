<?php

namespace App\Http\Livewire;

use App\Models\CareerSubject;
use App\Models\Section;
use App\Models\SectionSubjectUser;
use App\Models\Selectiondate;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;


class SectionTable extends Component
{
    use WithPagination;
    public $having = false, $hide_button = false;
    public $action = "Agregar", $search;
    public $selected = [], $matIds = [];
    public $role;
    public function render()
    {
        $user = Auth::user();
        $role = $user->getRoleNames()[0];
        $this->role = $role;
        /* Obtiene las asignaturas que el usuario tiene inscritas */
        $sub_user = $user->subjects;
        $career = null;
        /* Si el usuario logueado es estudiante */
        if ($role == 'student') {
            /* Obtiene la carrera del usuario */
            $career = Auth::user()->career;
            /* Obtiene todas las materias de esa carrera */
            $subjects = $career->subjects;
            /* Para almacenar el id de secciones elegidas */
            $ids = [];
            $sections = null;
            /* Si el usuario tiene asignaturas */
            if ($subjects->count()) {
                /* Por cada asignatura */
                foreach ($subjects as $subject) {
                    /* Si se pide las que no tiene */
                    if (!$this->having) {
                        if (!$sub_user->contains($subject)) {
                            /* Añade los Ids de las materias que no tiene */
                            array_push($ids, $subject->id);
                        }
                    }
                }
                /* Busca las secciones que incluyen los ids recolectados */
                $sections = SectionSubjectUser::with('teacher', 'section', 'subject')
                    ->whereIn('subject_id', $ids)
                    ->where('quota', '>', 0)
                    ->search($this->search)->paginate(6);
            }
            /* Si se pide las que sí tiene y el usuario ha inscrito materias */
            if ($this->having && $sub_user->count()) {
                /* Para almacenar cada sección */
                $id_course = [];
                /* Por cada asignatura que tiene el usuario */
                /* Añade el id de la asignatura y de la sección a su array */
                foreach ($sub_user as $sub) {
                    array_push($ids, $sub->id);
                    array_push($id_course, $sub->pivot->course_id);
                }
                /* Obteiene las secciones donde el usuario tiene materias inscritas */
                $sections = SectionSubjectUser::with('teacher', 'section', 'subject')
                    ->whereIn('subject_id', $ids)
                    ->whereIn('section_subject_user.id', $id_course)
                    ->search($this->search)->paginate(6);
            }
        } else {
            /* Si es un admin o un support, simplemente trae todas las asignaturas con cupo */
            $sections = SectionSubjectUser::with('teacher', 'section', 'subject')
                ->where('quota', '>', 0)
                ->search($this->search)->paginate(6);
        }
        return view('livewire.section-table')->with(['sections' => $sections, 'career' => $career]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function check($id, $mat)
    {
        if (in_array($id, $this->selected)) {
            $this->selected = array_diff($this->selected, [$id]);
        } else {
            array_push($this->selected, $id);
        }
        if (in_array($mat, $this->matIds)) {
            $this->matIds = array_diff($this->matIds, [$mat]);
        } else {
            array_push($this->matIds, $mat);
        }
    }
    public function select()
    {
        $user = Auth::user();
        $career = $user->career;
        $selDate = Selectiondate::first();
        $count=$user->subjects->count();
        for ($i = 0; $i < 4-$count && $i<count($this->selected) ; $i++) {
            $id = $this->selected[$i];
            $section = SectionSubjectUser::where('id', '=', $id)->first();
            $career_subject = CareerSubject::where('career_id', $career->id)
                ->where('subject_id', $section->subject_id)->first();
            $user->subjects()->attach($section->subject_id, ['trimester' => $career_subject->trimester, 'status' => 'coursing', 'course_id' => $section->id, 'teacher_id'=>$section->user_id, 'created_at' => now(), 'updated_at' => now()]);
            $section->quota = $section->quota - 1;
            $section->save();
            if ($selDate->count()) {
                $selDate->count = $selDate->count + 1;
                $selDate->save();
            }
        }
        return redirect(request()->header('Referer'));
    }
    public function unselect($id)
    {
        $user = Auth::user();
        $selDate = Selectiondate::first();
        $section = SectionSubjectUser::where('id', '=', $id)->first();
        $section->quota = $section->quota + 1;
        $section->save();
        $user->subjects()->detach($section->subject_id);
        if ($selDate->count()) {
            $selDate->count = $selDate->count - 1;
            $selDate->save();
        }
        return redirect(request()->header('Referer'));
    }

    public function delete(SectionSubjectUser $section)
    {
        $section->delete();
        return redirect(request()->header('Referer'));
    }
}
