<?php

namespace App\Http\Controllers;

use App\Http\Requests\FillSectionRequest;
use App\Http\Requests\SectionRequest;
use App\Http\Requests\SelectionRequest;
use App\Models\Section;
use App\Models\SectionSubjectUser;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\JsonDecoder;

use function PHPSTORM_META\type;

class SectionController extends Controller
{

    public function index()
    {
        $sections = Section::get();
        return view('sections.index')->with(['sections' => $sections]);
    }


    public function create()
    {
        return view('sections.create');
    }


    public function store(SectionRequest $request)
    {
        Section::create($request->all());
        return redirect()->route('sections.index');
    }


    public function show(Section $section)
    {
        $data= $section->courses->groupby('subject_id');
        return view('sections.show')
        ->with(['data'=>$data]);
    }


    public function edit(SectionSubjectUser $section)
    {
        $subjects = Subject::orderby('name')->get();
        $sections = Section::orderby('name')->get();
        $teachers=User::isRole('teacher')->orderby('name')->get();
        return view('sections.edit')
        ->with([
            'sections' => $sections,
            'subjects' => $subjects,
            'teachers' => $teachers,
            'sect'=>$section
        ]);
    }


    public function update(Request $request, Section $section)
    {
        //
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('sections.index');
    }
    public function selection()
    {
        $user=Auth::user();
        $subjects = Subject::orderby('name')->get();
        $sections = Section::orderby('name')->get();
        $teachers=User::isRole('teacher')->orderby('name')->get();
      if (($user->rol() != 'student') || ($user->subjects->count() < 3  && $user->career->selectiondate->count())) {
        return view('sections.selection')
        ->with([
            'sections' => $sections,
            'subjects' => $subjects,
            'teachers' => $teachers,
        ]);
      } else {
          return redirect()->route('subjects.mysubjects');
      }
      
    }
    public function select(FillSectionRequest $request)
    {
        SectionSubjectUser::updateOrCreate(['id'=>$request->id],$request->all());
        return redirect()->route('sections.selection');
    }

}
