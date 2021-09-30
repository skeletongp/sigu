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
        //
    }


    public function edit(Section $section)
    {
        //
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
        $subjects = Subject::orderby('name')->get();
        $sections = Section::orderby('name')->get();
        $teachers=User::isRole('teacher')->orderby('name')->get();
        return view('sections.selection')
            ->with([
                'sections' => $sections,
                'subjects' => $subjects,
                'teachers' => $teachers,
            ]);
    }
    public function select(FillSectionRequest $request)
    {
        SectionSubjectUser::create($request->all());
        return redirect()->route('sections.selection');
    }
}
