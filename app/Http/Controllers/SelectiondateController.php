<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Selectiondate;
use Illuminate\Http\Request;

class SelectiondateController extends Controller
{
    
    public function index()
    {
        //
    }

   
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy( $career)
    {
        $career=Career::where('slug','=',$career)->first();
        foreach ($career->selectiondate as $seldate) {
            $seldate->delete();
        }
        return redirect()->back();
    }
   
}
