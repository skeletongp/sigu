<?php

namespace Database\Factories;

use App\Models\Career;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class CareerFactory extends Factory
{
   
    protected $model = Career::class;
    public $num=1;
    
    public function definition()
    {
        $names = [
            1 => [
                'name' => 'Ingeniería de Software',
                'code' => 'ISW',
            ],
            2 => [
                'name' => 'Psicología Escolar',
                'code' => 'PSS',
            ], 
            2 => [
                'name' => 'Psicología Clínica',
                'code' => 'PSC',
            ], 
            3 => [
                'name' => 'Licenciatura en Derecho',
                'code' => 'DER',
            ], 
            4 => [
                'name' => 'Licenciatura en Agrimensura',
                'code' => 'AGR',
            ], 
            5 => [
                'name' => 'Informática Gerencial',
                'code' => 'IFG',
            ],
        ];
        $career=$names[$this->num];
        $this->num++;
        return [
            'name'=>$career['name'],
            'code'=>$career['code'],
            'slug'=>Str::slug($career['name'], '-'),
        ];

    }
}
