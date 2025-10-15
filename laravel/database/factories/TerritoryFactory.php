<?php

namespace Database\Factories;

use App\Models\TerritoryModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TerritoryFactory extends Factory
{

    protected $model = TerritoryModel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->city(),
            'citizens' => $this->faker->numberBetween(1000, 100000),
            'pollution_level' => $this->faker->randomFloat(2, 0, 100),
            'airport_id' => null
        ];
    }
}
