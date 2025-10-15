<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\TerritoryModel;
use Illuminate\Database\Seeder;

class TerritorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TerritoryModel::factory(3)->create();

        TerritoryModel::create([
            'name' => 'Barcelona',
            'citizens' => 5500000,
            'pollution_level' => 75.50,
            'airport_id' => 1
        ]);

        TerritoryModel::create([
            'name' => 'Helsinki',
            'citizens' => 1200000,
            'pollution_level' => 40.30,
            'airport_id' => 2
        ]);

        TerritoryModel::create([
            'name' => 'Abu Dhabi',
            'citizens' => 3000000,
            'pollution_level' => 60.80,
            'airport_id' => 3
        ]);
    }
}
