<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_name' => $this->faker->text,
            'company_code' => $this->faker->uuid(),
            'company_sector' => $this->faker->text,
            'company_location' => $this->faker->text,
        ];
    }
}
