<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
class SectionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function prepareForValidation()
    {
        $this->request->add(['code'=>strtoupper($this->code)]);
    }

    public function rules()
    {
        return [
            'name'=>'required|string|max:40|unique:sections,name,'.$this->id,
            'code'=>'required|string|max:4|unique:sections,code,'.$this->id,
        ];
    }
}
