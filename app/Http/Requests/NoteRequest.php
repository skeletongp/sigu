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
        $this->ap?: $this->request->add(['ap'=>0]);
        $this->poe?: $this->request->add(['poe'=>0]);
        $this->pf?: $this->request->add(['pf'=>0]);
        $this->ef?: $this->request->add(['ef'=>0]);
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
            'ap'=>'numeric|between:0,25',
            'poe'=>'numeric|between:0,10',
            'pf'=>'numeric|between:0,15',
            'ef'=>'numeric|between:0,50',
            'nf'=>'numeric|between:0,100',
        ];
    }
}
