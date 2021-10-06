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
                'id'=>1,
                'name' => 'Ingeniería de Software',
                'code' => 'ISW',
                'trimesters'=>12
            ],
            2 => [
                'id'=>2,
                'name' => 'Psicología Escolar',
                'code' => 'PSS',
                'trimesters'=>12
            ], 
            3 => [
                'id'=>3,
                'name' => 'Psicología Clínica',
                'code' => 'PSC',
                'trimesters'=>12
            ], 
            4 => [
                'id'=>4,
                'name' => 'Licenciatura en Derecho',
                'code' => 'DER',
                'trimesters'=>12
            ], 
            5 => [
                'id'=>5,
                'name' => 'Licenciatura en Agrimensura',
                'code' => 'AGR',
                'trimesters'=>12
            ], 
            6 => [
                'id'=>6,
                'name' => 'Informática Gerencial',
                'code' => 'IFG',
                'trimesters'=>12
            ],
        ];
        $career=$names[$this->num];
        $this->num++;
        return [
            'id'=>$career['id'],
            'name'=>$career['name'],
            'code'=>$career['code'],
            'trimesters'=>$career['trimesters'],
            'slug'=>Str::slug($career['name'], '-'),
        ];

    }
}
