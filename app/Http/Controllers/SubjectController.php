<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Models\Career;
use App\Models\Subject;
use Illuminate\Http\Request;

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
        return view('subjects.create')->with(['careers' => $careers]);
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
        return view('subjects.edit')->with(['careers' => $careers, 'subject' => $subject]);
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
}
