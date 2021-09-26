<?php

namespace App\Http\Controllers;

use App\Http\Requests\CareerRequest;
use App\Models\Career;
use App\Models\User;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $users=User::where('career_id','=',$career->id)->paginate(9);
        $subjects=$career->subjects;
        return view('careers.show')->with(['users'=>$users, 'subjects'=>$subjects]);
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
}
