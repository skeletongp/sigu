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
        $subjects=User::find($this->id)->subjects()->get();
        return view('components.students-subjects')->with(['subjects'=>$subjects, 'user'=>$this->user]);
    }
}
