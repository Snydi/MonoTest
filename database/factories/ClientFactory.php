<?php

namespace Database\Factories;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;
use Propaganistas\LaravelPhone\PhoneNumber;
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
            'phone' => '+7 (' . fake()->numerify('###') . ') ' .
                fake()->numerify('###') . '-' . fake()->numerify('##'). '-' . fake()->numerify('##'),
            'address' => fake()->streetName(),
        ];
    }
}
