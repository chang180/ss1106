<?php

namespace Database\Factories;

use App\Models\Phone;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'chinese' => $this->faker->numberBetween(50, 100),
            'english' => $this->faker->numberBetween(50, 100),
            'math' => $this->faker->numberBetween(50, 100),
            'photo' => $this->faker->imageUrl($width = 640, $height = 480),
        ];
    }

    /**
     * Indicate that the user is suspended.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function suspended()
    {
        return $this->state(function (array $attributes) {
            return [
                'account_status' => 'suspended',
            ];
        });
    }
}
