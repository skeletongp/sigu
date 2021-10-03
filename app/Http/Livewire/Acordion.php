<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Acordion extends Component
{
    public $data, $open=false;
    public function render()
    {
        return view('livewire.acordion');
    }
}
