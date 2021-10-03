<?php

namespace App\Http\Livewire;

use App\Models\Career;
use App\Models\Selectiondate;
use Livewire\Component;

class OpenSelection extends Component
{
    public $career;
    public $start;
    public $end;
    public $open=false;
    public function __construct($career) {
        $this->career = Career::where('slug',$career)->first();
    }
    public function render()
    {
        $this->career_id=$this->career->id;
        return view('livewire.open-selection');
    }
    protected $rules=[
        'start'=>'required',
        'end'=>'required|after:start',
    ];
    public function opendate()
    {
       $this->validate();
       $selDate= new Selectiondate();
       $selDate->career_id=$this->career->id;
       $selDate->start=$this->start;
       $selDate->end=$this->end;
       $selDate->save();
       return redirect(request()->header('Referer'));
    }
    public function toggle()
    {
            $this->open=!$this->open;
    }
}
