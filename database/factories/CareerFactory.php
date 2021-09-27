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
                'trimesters'=>12
            ],
            2 => [
                'name' => 'Psicología Escolar',
                'code' => 'PSS',
                'trimesters'=>12
            ], 
            2 => [
                'name' => 'Psicología Clínica',
                'code' => 'PSC',
                'trimesters'=>12
            ], 
            3 => [
                'name' => 'Licenciatura en Derecho',
                'code' => 'DER',
                'trimesters'=>12
            ], 
            4 => [
                'name' => 'Licenciatura en Agrimensura',
                'code' => 'AGR',
                'trimesters'=>12
            ], 
            5 => [
                'name' => 'Informática Gerencial',
                'code' => 'IFG',
                'trimesters'=>12
            ],
        ];
        $career=$names[$this->num];
        $this->num++;
        return [
            'name'=>$career['name'],
            'code'=>$career['code'],
            'trimesters'=>$career['trimesters'],
            'slug'=>Str::slug($career['name'], '-'),
        ];

    }
}
