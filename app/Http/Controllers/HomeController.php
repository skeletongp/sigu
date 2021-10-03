<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;


class HomeController extends Controller
{

    public function home()
    {
        $user=new User();
        $careers = Career::get();
        $subjects = Subject::get();
        return view('home')
            ->with([
                'user' => $user,
                'careers' => $careers,
                'subjects' => $subjects,
            ]);
    }
}
