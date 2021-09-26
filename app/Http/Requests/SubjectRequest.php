<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class SubjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            'name'=>'required|string|max:40|unique:subjects,name,'.$this->id,
            'slug'=>'required|string|max:45|unique:subjects,slug,'.$this->id,
            'code'=>'required|string|max:4|unique:subjects,code,'.$this->id,
        ];
    }
}
