<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'cost' => $this->faker->randomFloat(2, 100, 1000),
            'duration' => $this->faker->numberBetween(1, 12),
            'modality' => $this->faker->randomElement(['Online', 'Presencial']),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'academy_id' => null,
        ];
    }
}
