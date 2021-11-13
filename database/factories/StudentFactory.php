<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name,
            'chinese'=>$this->faker->numberBetween(0,100),
            'english'=>$this->faker->numberBetween(0,100),
            'math'=>$this->faker->numberBetween(0,100),
        ];
    }
}
