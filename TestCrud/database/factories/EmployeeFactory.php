<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_name' => $this->faker->text,
            'employee_code' => $this->faker->uuid(),
            'employee_department' => $this->faker->text,
            'company_code' => $this->faker->text,
        ];
    }
}
