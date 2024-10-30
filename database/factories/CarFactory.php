<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition()
    {
        return [
            'user_id' => 4,
            'license_plate' => strtoupper($this->faker->bothify('??-###-??')),
            'brand' => $this->faker->word,
            'model' => $this->faker->word,
            'seats' => $this->faker->numberBetween(2, 7),
            'doors' => $this->faker->numberBetween(2, 5),
            'weight' => $this->faker->numberBetween(1000, 3000),
            'price' => $this->faker->numberBetween(5000, 50000),
            'mileage' => $this->faker->numberBetween(0, 200000),
            'production_year' => $this->faker->year,
            'color' => $this->faker->safeColorName,
            'status' => 'Te koop',
            'sold_at' => null,
            'image' => 'https://static.foxdealer.com/489/2023/06/no-car-placeholder.png',
        ];
    }
}
