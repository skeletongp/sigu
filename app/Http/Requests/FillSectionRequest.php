<?php

namespace App\Http\Requests;

use App\Models\SectionSubjectUser;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class FillSectionRequest extends FormRequest
{
    public $msg, $error = false;
    public function prepareForValidation()
    {
        /* Verifica si inicia antes que otra y termina despues que la otra inicie
        Según sección*/
        $data = SectionSubjectUser::where('section_id', '=', $this->section_id)
            ->where('day', '=', $this->day)
            ->where('id', '!=', $this->id)
            ->where('start', '<', $this->start)
            ->where('end', '>', $this->start)
            ->get();
        if ($data->count()) {
            $this->error = true;
            $this->msg = "Hay un choque de horario con esta sección:\r\n ".$data[0]->from.'-'.$data[0]->finish;
        }
        /* Verifica siinicia antes que otra y termina después que la otra inicie 
        Según maestro*/
        $data = SectionSubjectUser::where('user_id', '=', $this->user_id)
            ->where('day', '=', $this->day)
            ->where('id', '!=', $this->id)
            ->where('start', '<', $this->start)
            ->where('end', '>', $this->start)
            ->get();
        if ($data->count()) {
            $this->error = true;
            $this->msg = "Hay un choque de horario con este maestro:\r\n".$data[0]->from.'-'.$data[0]->finish;
        }
        /* Verifica si inicia mientras otra está en curso
        Según maestro */
        $data = SectionSubjectUser::where('user_id', '=', $this->user_id)
            ->where('day', '=', $this->day)
            ->where('id', '!=', $this->id)
            ->whereBetween('start', [$this->start, $this->end])
            ->get();
        if ($data->count()) {
            $this->error = true;
            $this->msg = "Hay un choque de horario con este maestro: \r\n".$data[0]->from.'-'.$data[0]->finish;
        }
        /* Verifica si inicia mientras otra está en curso
        Según sección */
        $data = SectionSubjectUser::where('section_id', '=', $this->section_id)
            ->where('day', '=', $this->day)
            ->where('id', '!=', $this->id)
            ->whereBetween('start', [$this->start, $this->end])
            ->get();
        if ($data->count()) {
            $this->error = true;
            $this->msg = "Hay un choque de horario con esta sección: \r\n".$data[0]->from.'-'.$data[0]->finish;
        }
        if ($this->error) {
            throw ValidationException::withMessages(['error' => $this->msg]);
        }
    }
    public function authorize()
    {

        return true;
    }


    public function rules()
    {
        return [
            'quota' => 'numeric|max:30|min:10',
            'start' => 'required|',
            'day' => 'required|',
            'end' => 'after:start'
        ];
    }
   /*  protected function failedAuthorization()
    {
        
        throw new AuthorizationException('Verifique el choque de horario, maestro y sección');
    } */
}
