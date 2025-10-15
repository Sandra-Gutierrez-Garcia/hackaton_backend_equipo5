<?php

namespace Database\Seeders;

use App\Models\AirportModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AirportModel::create([
            'name' => 'El Prat',
            'location' => 'Barcelona, Spain',
            'capacity' => 200
        ]);

        AirportModel::create([
            'name' => 'Helsinki-Vantaa',
            'location' => 'Helsinki, Finland',
            'capacity' => 150
        ]);

        AirportModel::create([
            'name' => 'Abu Dhabi International',
            'location' => 'Abu Dhabi, UAE',
            'capacity' => 300
        ]);
    }
}
