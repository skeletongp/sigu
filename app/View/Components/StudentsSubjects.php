<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class StudentsSubjects extends Component
{
    public $id, $user;
    public function __construct($id, $user)
    {
       $this->id=$id;
       $this->user=$user;
    }

    
    public function render()
    {
        $subjects=User::find($this->id)->subjects()->paginate(9);
        return view('components.students-subjects')->with(['subjects'=>$subjects, 'user'=>$this->user]);
    }
}
