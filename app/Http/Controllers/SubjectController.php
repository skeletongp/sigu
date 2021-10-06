<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Http\Requests\SubjectRequest;
use App\Models\Career;
use App\Models\SectionSubjectUser;
use App\Models\Subject;
use App\Models\SubjectUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{

    public function __construct() {
        $this->middleware(['role:admin|support'])->only('create','store','edit','update');
    }
    public function index()
    {
        $subjects = Subject::search(request('q'))->orderby('name')->paginate(6);
        return view('subjects.index')->with(['subjects' => $subjects]);
    }


    public function create()
    {
        $careers = Career::orderby('name')->get();
        $subjects = Subject::orderby('name')->get();
        return view('subjects.create')->with(['careers' => $careers, 'subjects' => $subjects]);
    }

    public function store(SubjectRequest $request)
    {
        $subject = Subject::create($request->except('careers'));
        if (request("careers")) {
            foreach (request("careers") as $career) {
                $subject->careers()->syncWithoutDetaching($career);
            }
        }
        return redirect()->route('subjects.create');
    }

    public function show(Subject $subject)
    {
        $careers = $subject->careers()->search(request('q'))->paginate(6);
        return view('subjects.show')->with(['careers' => $careers, 'subject' => $subject]);
    }


    public function edit(Subject $subject)
    {
        $careers = Career::orderby('name')->get();
        $subjects = Subject::orderby('name')->get();
        return view('subjects.edit')->with(['careers' => $careers, 'subject' => $subject, 'subjects' => $subjects]);
    }


    public function update(SubjectRequest $request, Subject $subject)
    {

        $subject->update($request->except('\%22careers'));
        if (request("\%22careers")) {
            foreach (request("\%22careers") as $career) {
                $subject->careers()->syncWithoutDetaching($career);
            }
        }
        return redirect()->route('subjects.show', $subject);
    }


    public function destroy(Subject $subject)
    {
        //
    }
    public function detach(Career $career, Subject $subject)
    {
        $subject->careers()->detach($career);
        return redirect()->route('subjects.show', $subject);
    }
    public function mysubjects()
    {
        if (Auth::user()->rol() == 'student') {
            return view('subjects.mysubjects');
        } else {
            $subjects = Auth::user()->teach_sections()->orderby('subject_id')->paginate(6);
            return view('subjects.myteachsubjects')
                ->with(['subjects' => $subjects]);
        }
    }
    public function myteachstudents($section)
    {

        if (intval($section)) {
            $section = SectionSubjectUser::find($section);
            $search=request('q');
            $students = optional($section)->students($search);
        } else {
            $section = Subject::where('slug', '=', $section)->first();
            $students = optional($section)->students();
            foreach ($students as $key => $student) {
                if (!Auth::user()->teach_students->contains($student)) {
                    $students->forget($key);
                }
            }
        }
        return view('subjects.myteachstudents')
            ->with(
                [
                    'students' => $students,
                    'section' => $section
                ]
            );
    }
    public function editnotes(Request $request)
    {
        $section=SubjectUser::where('user_id','=',$request->user_id)
        ->where('course_id','=',$request->course_id)->first();

        return view('subjects.editnotes')
        ->with(['section'=>$section]);

    }
    public function calificate(NoteRequest $request)
    {
        $section=SubjectUser::find($request->section);
       $section->update($request->except('condition','section'));
       return redirect()->route('subjects.mysubjects');
    }
}
