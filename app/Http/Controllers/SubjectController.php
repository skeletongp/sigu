<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Models\Career;
use App\Models\SectionSubjectUser;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{

    public function index()
    {
        $subjects = Subject::search(request('q'))->orderby('name')->paginate(6);
        return view('subjects.index')->with(['subjects' => $subjects]);
    }


    public function create()
    {
        $careers = Career::orderby('name')->get();
        $subjects=Subject::orderby('name')->get();
        return view('subjects.create')->with(['careers' => $careers,'subjects'=>$subjects]);
    }

    public function store(SubjectRequest $request)
    {
        $subject = Subject::create($request->except('\%22careers'));
        if (request("\%22careers")) {
            foreach (request("\%22careers") as $career) {
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
        $subjects=Subject::orderby('name')->get();
        return view('subjects.edit')->with(['careers' => $careers, 'subject' => $subject, 'subjects'=>$subjects]);
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
        if (Auth::user()->getRoleNames()[0]=='student') {
            return view('subjects.mysubjects');
        } else {
            $subjects=Auth::user()->teach_sections;
            return view('subjects.myteachsubjects')
            ->with(['subjects'=>$subjects]);
        }
        
    }
    public function myteachstudents( $section)
    {

       if (intval($section)) {
        $section=SectionSubjectUser::find($section);
        $students=$section->students;
       }
       else{
           $section=Subject::where('slug','=',$section)->first();
           $students=$section->students;
           foreach ($students as $key=> $student) {
               if (!Auth::user()->teach_students->contains($student)) {
                  $students->forget($key);
               }
           }
       }

        return view('subjects.myteachstudents')
        ->with(['students'=>$students]);
    }
}
