<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class StudentsSubjects extends Component
{
    public $id, $user, $trim;
    public function __construct($id, $user, $trim)
    {
       $this->id=$id;
       $this->user=$user;
       $this->trim=$trim;
    }

    
    public function render()
    {
        $courses=User::find($this->id)->courses()->get();
        return view('components.students-subjects')->with(['courses'=>$courses, 'user'=>$this->user]);
    }
}
