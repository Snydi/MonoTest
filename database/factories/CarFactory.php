<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand' => fake()->word(),
            'model' => fake()->word(),
            'color' => fake()->word(),
            'plate' => fake()->randomNumber(),
            'in_parking' => fake()->boolean(),
            'client_id' => Client::pluck('id')->random(),
        ];
    }
}
