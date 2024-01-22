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
            'plate' => $this->generateRandomPlate(),
            'in_parking' => fake()->boolean(),
            'client_id' => Client::pluck('id')->random(),
        ];
    }
    private function generateRandomPlate(): string
    {
        $letters = ['А', 'В', 'Е', 'К', 'М', 'Н', 'О', 'Р', 'С', 'Т', 'У', 'Х'];
        $letter = $this->faker->randomElement($letters);
        $digits = $this->faker->randomNumber(3);
        $regionLetters = $this->faker->randomElements($letters, 2);
        $regionDigits = $this->faker->randomNumber(2, true);
        return $letter . $digits . implode('', $regionLetters) . $regionDigits;
    }
}
