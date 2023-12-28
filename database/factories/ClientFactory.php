<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'sex' => fake()->numberBetween(0, 2), //стандарт ISO/IEC 5218
            'phone' => fake()->unique()->phoneNumber(),
            'address' => fake()->streetName(),
        ];
    }
}
