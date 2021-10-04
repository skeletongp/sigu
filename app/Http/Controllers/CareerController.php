<?php

namespace App\Http\Controllers;

use App\Http\Requests\CareerRequest;
use App\Models\Career;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Mockery\Matcher\Subset;

class CareerController extends Controller
{
   public function __construct() {
      $this->middleware(['role:admin|support'])
      ->except('index','show','addsubject');
   }
    public function index()
    {
        $careers = Career::searcH(request('q'))->orderby('name')->paginate(10);
        return view('careers.index')->with(['careers'=>$careers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('careers.create');
    }

    
    public function store(CareerRequest $request)
    {
        Career::create($request->all());
        return redirect()->route('careers.index');
    }

    public function show(Career $career)
    {
        $users=User::where('career_id','=',$career->id)->search(request('q'))->paginate(9);
        $subjects=$career->subjects;
        return view('careers.show')->with(['users'=>$users, 'subjects'=>$subjects, 'career'=>$career]);
    }

   
    public function edit(Career $career)
    {
        
        return view('careers.edit')->with(['career'=>$career]);
    }

    
    public function update(CareerRequest $request, Career $career)
    {
        $career->update($request->all());
        return redirect()->route('careers.index');
    }

   
    public function destroy(Career $career)
    {
        $career->delete();
        return redirect()->route('careers.index');
    }

    public function addsubject(Career $career)
    {
        $subjects=Subject::orderby('name')->get();
        return view('careers.addsubject')->with(['subjects'=>$subjects,'career'=>$career]);
    }
    public function storesubject(Request $request, Career $career)
    {
        $career->subjects()->attach($request->subject, ['trimester'=>$request->trimester]);
        $subjects=Subject::orderby('name')->get();
        return view('careers.addsubject')->with(['subjects'=>$subjects,'career'=>$career, 'data'=>$request->trimester]);
    }
    public function detachsubject(Career $career, Subject $subject)
    {
        $career->subjects()->detach($subject);
        $subjects=Subject::orderby('name')->get();
        return view('careers.addsubject')->with(['subjects'=>$subjects,'career'=>$career]);
    }
}
