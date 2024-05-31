<?php

namespace Database\Factories;

use App\Enums\Gender;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'date_of_birth' => $this->faker->date($format = 'Y-m-d'),
            'gender' => $this->faker->randomElement([Gender::Male, Gender::Female]),
        ];
    }
}
