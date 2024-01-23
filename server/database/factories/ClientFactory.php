<?php

namespace Database\Factories;
use Illuminate\Support\Arr;
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
        $sexValues = ['male', 'female', 'N/A'];
        return [
            'name' => fake()->name(),
            'sex' => Arr::random($sexValues),
            'phone' => fake()->unique()->phoneNumber(),
            'address' => fake()->streetName(),
        ];
    }
}
