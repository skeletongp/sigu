<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function prepareforvalidation()
    {   
        $nf=$this->ap+$this->poe+$this->pf+$this->ef;
        $this->request->add(['nf'=>$nf]);
        $condition=$this->condition;
        if ($condition=="true") {
            if ($this->nf >= 70) {
                $this->request->add(['status' => 'aproved']);
            } else {
                $this->request->add(['status' => 'failed']);
            }
        } 
    }
    public function rules()
    {
        return [
            'ap'=>'required|numeric|between:0,25',
            'poe'=>'required|numeric|between:0,10',
            'pf'=>'required|numeric|between:0,15',
            'ef'=>'required|numeric|between:0,50',
            'nf'=>'required|numeric|between:0,100',
        ];
    }
}
