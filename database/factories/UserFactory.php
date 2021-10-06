<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    
    protected $model = User::class;

    public function definition()
    {
        $name=$this->faker->firstName();
        $lastname=$this->faker->lastname();
        return [
            'name' => $name,
            'lastname' => $lastname,
            'slug'=>Str::slug($name.' '.$lastname,'-'),
            'birthday'=>$this->faker->date('Y-m-d','2000-12-31'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
