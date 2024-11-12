<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition()
    {
        $brandModels = [
            'Toyota' => ['Corolla', 'Camry', 'Prius', 'Yaris', 'Avalon', 'Highlander', 'RAV4', 'Tacoma', 'Tundra', 'Sienna', '4Runner', 'Sequoia', 'Land Cruiser', 'Supra', 'C-HR', 'Mirai', 'Venza', 'Matrix'],
            'Honda' => ['Civic', 'Accord', 'CR-V', 'Pilot', 'Fit', 'HR-V', 'Odyssey', 'Ridgeline', 'Passport', 'Insight', 'Clarity', 'Element', 'S2000', 'Prelude', 'Crosstour', 'CR-Z', 'Del Sol'],
            'Ford' => ['Mustang', 'F-150', 'Explorer', 'Escape', 'Edge', 'Fusion', 'Focus', 'Fiesta', 'Expedition', 'Ranger', 'Bronco', 'Maverick', 'Taurus', 'Flex', 'EcoSport', 'GT', 'Thunderbird'],
            'Chevrolet' => ['Silverado', 'Equinox', 'Malibu', 'Traverse', 'Tahoe', 'Suburban', 'Camaro', 'Corvette', 'Blazer', 'Colorado', 'Impala', 'Spark', 'Sonic', 'Trax', 'Volt', 'Bolt', 'Cruze', 'Avalanche'],
            'BMW' => ['3 Series', '5 Series', '7 Series', 'X1', 'X3', 'X5', 'X7', 'Z4', 'M3', 'M5', 'i3', 'i8', '4 Series', '6 Series', '8 Series', 'X2', 'X4', 'X6'],
            'Mercedes-Benz' => ['C-Class', 'E-Class', 'S-Class', 'GLA', 'GLB', 'GLC', 'GLE', 'GLS', 'A-Class', 'B-Class', 'CLA', 'CLS', 'G-Class', 'SL', 'SLC', 'AMG GT', 'EQC'],
            'Volkswagen' => ['Golf', 'Passat', 'Jetta', 'Tiguan', 'Atlas', 'Beetle', 'Arteon', 'Touareg', 'ID.4', 'Polo', 'Scirocco', 'CC', 'Eos', 'Routan', 'Sharan', 'T-Roc', 'T-Cross'],
            'Audi' => ['A3', 'A4', 'A6', 'A8', 'Q3', 'Q5', 'Q7', 'Q8', 'TT', 'R8', 'S3', 'S4', 'S5', 'S6', 'S7', 'S8', 'RS3', 'RS5'],
            'Nissan' => ['Altima', 'Sentra', 'Maxima', 'Rogue', 'Murano', 'Pathfinder', 'Frontier', 'Titan', 'Leaf', 'Juke', 'Versa', 'Kicks', 'Armada', '370Z', 'GT-R', 'Xterra', 'Cube'],
            'Hyundai' => ['Elantra', 'Sonata', 'Tucson', 'Santa Fe', 'Kona', 'Palisade', 'Veloster', 'Ioniq', 'Accent', 'Genesis', 'Azera', 'Venue', 'Nexo', 'Creta', 'Terracan'],
            'Skoda' => ['Octavia', 'Superb', 'Fabia', 'Kodiaq', 'Karoq', 'Scala', 'Kamiq', 'Rapid', 'Citigo', 'Roomster', 'Yeti', 'Enyaq', 'Felicia', 'Favorit', '110', '120', '130', '135', '136', '1000 MB', '105', '125', '135 GLi', '136 GLi', '110 R', '120 L', '130 L', '135 L']
        ];

        // Flatten the brandModels array to get a list of all models
        $allModels = [];
        foreach ($brandModels as $brand => $models) {
            foreach ($models as $model) {
                $allModels[] = ['brand' => $brand, 'model' => $model];
            }
        }

        // Shuffle the array to randomize the order
        shuffle($allModels);

        // Get the current index for the unique model
        static $index = 0;

        // Get the brand and model from the shuffled list
        $brandModel = $allModels[$index];
        $index++;

        return [
            'user_id' => 4, // Assuming all cars belong to user with ID 4
            'license_plate' => strtoupper($this->faker->bothify('??-###-??')),
            'brand' => $brandModel['brand'],
            'model' => $brandModel['model'],
            'seats' => $this->faker->numberBetween(2, 7),
            'doors' => $this->faker->numberBetween(2, 5),
            'weight' => $this->faker->numberBetween(1000, 3000),
            'price' => $this->faker->numberBetween(5000, 50000),
            'mileage' => $this->faker->numberBetween(0, 200000),
            'production_year' => $this->faker->year,
            'color' => $this->faker->safeColorName,
            'status' => 'Te koop',
            'sold_at' => null,
            'image' => 'https://via.placeholder.com/150', // Placeholder image URL
        ];
    }
}
