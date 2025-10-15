<?php

namespace Database\Factories;

use App\Models\AirportModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AirportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = AirportModel::class;
    
    public function definition(): array
    {
        return [
            'name' => $this->faker()->randomElement([
                'El Prat', 'Helsinki-Vantaa', 'Abu Dhabi International'
            ]),
            'location' => $this->faker()->city(),
            'capacity' => $this->faker()->numberBetween(100, 500)
        ];
    }
}
