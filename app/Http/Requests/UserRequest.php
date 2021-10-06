<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()->hasRole('admin')) {
            return true;
        }
        return false;
    }

    public function prepareForValidation()
    {
        $this->request->add(['fullname' => $this->name . ' ' . $this->lastname]);
        $this->request->add(['slug' => Str::slug($this->fullname, '-')]);
        $this->photo?'':$this->request->add(['photo'=>'profile.png']);;
        if (strlen($this->password) < 6) {
            $this->request->remove('password');
        }
        $this->role!='student'?$this->request->remove('career_id'):'';
    }
    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'fullname' => 'required|unique:users,fullname,'.$this->id,
            'photo' => 'required|string|min:8',
            'birthday' => 'required|date',
            'password' => 'confirmed'

        ];
    }
}
