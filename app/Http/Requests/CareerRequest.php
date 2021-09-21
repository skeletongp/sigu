<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
class CareerRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }
    
    public function prepareForValidation()
    {
        $this->request->add(['slug'=>Str::slug($this->name,'-')]);
        $this->request->add(['code'=>strtoupper($this->code)]);
    }
    
    public function rules()
    {
        return [
            'name'=>'required|string|max:40|unique:careers,name',
            'slug'=>'required|string|max:45|unique:careers,slug',
            'code'=>'required|string|max:4|unique:careers,code',
        ];
    }
}
