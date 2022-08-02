<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'company_id' => mt_rand(1, 10),
            'firstname' => $this->faker->firstname(),
            'lastname' => $this->faker->lastname(),
            'email' => $this->faker->email(),
        ];
    }
}
