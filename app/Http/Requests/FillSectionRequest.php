<?php

namespace App\Http\Requests;

use App\Models\SectionSubjectUser;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class FillSectionRequest extends FormRequest
{
    public function prepareForValidation()
    {
       
    }
    public function authorize()
    {
        $data = SectionSubjectUser::where('section_id', '=', $this->section_id)
            ->where('day', '=', $this->day)
            ->where('id','!=', $this->id)
            ->whereBetween('start', [$this->start, $this->end])
            ->get();

        if ($data->count()) {
            return false;
        }
        $data = SectionSubjectUser::where('user_id', '=', $this->user_id)
            ->where('day', '=', $this->day)
            ->where('id','!=', $this->id)
            ->whereBetween('start', [$this->start, $this->end])
            ->get();
        if ($data->count()) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quota' => 'numeric|max:30|min:10',
            'start'=>'required|',
            'end'=>'after:start'
        ];
    }
    protected function failedAuthorization()
    {
        throw new AuthorizationException('Verifique el choque de horario, maestro y sección');
    }
}
