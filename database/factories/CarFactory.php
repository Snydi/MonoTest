<?php

namespace Database\Factories;

use App\Models\CarBrand;
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
        $carBrands = CarBrand::pluck('name')->toArray();

        $carBrandModels = [];

        foreach ($carBrands as $brand) {
            switch ($brand) {
                case 'Toyota':
                    $carBrandModels[$brand] = ['Corolla', 'Camry', 'Rav4'];
                    break;

                case 'Honda':
                    $carBrandModels[$brand] = ['Civic', 'Accord', 'CR-V'];
                    break;

                case 'Ford':
                    $carBrandModels[$brand] = ['Fusion', 'Escape', 'Explorer'];
                    break;

                case 'Chevrolet':
                    $carBrandModels[$brand] = ['Malibu', 'Equinox', 'Tahoe'];
                    break;

                case 'Nissan':
                    $carBrandModels[$brand] = ['Altima', 'Rogue', 'Pathfinder'];
                    break;

                case 'BMW':
                    $carBrandModels[$brand] = ['3 Series', 'X5', '7 Series'];
                    break;

                case 'Mercedes-Benz':
                    $carBrandModels[$brand] = ['C-Class', 'E-Class', 'GLC'];
                    break;

                case 'Audi':
                    $carBrandModels[$brand] = ['A4', 'Q5', 'A6'];
                    break;

                case 'Volkswagen':
                    $carBrandModels[$brand] = ['Jetta', 'Tiguan', 'Passat'];
                    break;

                case 'Tesla':
                    $carBrandModels[$brand] = ['Model 3', 'Model S', 'Model X'];
                    break;
            }
        }

        $selectedBrand = $this->faker->randomElement($carBrands);
        $selectedModel = $this->faker->randomElement($carBrandModels[$selectedBrand]);

        $carColors = [
            'Красный', 'Синий', 'Зеленый', 'Желтый', 'Черный',
            'Белый', 'Серебрянный', 'Серый', 'Оранжевый', 'Фиолетовый'
        ];

        return [
            'brand' => $selectedBrand,
            'model' => $selectedModel,
            'color' => $this->faker->randomElement($carColors),
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
