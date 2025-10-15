<?php

namespace Database\Factories;

use App\Models\PlaneModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PlaneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = PlaneModel::class;

    public function definition(): array
    {
        $arrivalDate = $this->faker->dateTimeBetween('now', '+1 year');
        $departureDate = $this->faker->dateTimeBetween($arrivalDate, '+1 year');
        return [
            'model' => $this->faker->randomElement([
                'Boeing 737', 'Airbus A320', 'Cessna 172'
            ]),
            'capacity' => $this->faker->numberBetween(50, 300),
            'range_km' => $this->faker->numberBetween(500, 15000),
            'flight_type' => $this->faker()->randomElement(['local', 'european', 'international']),
            'arrival_date' => $arrivalDate,
            'departure_date' => $departureDate

        ];
    }

    
}
