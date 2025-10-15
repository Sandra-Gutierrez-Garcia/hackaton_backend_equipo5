<?php

namespace Database\Seeders;

use App\Models\PlaneModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlaneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PlaneModel::create([
            'model' => 'Boeing 737',
            'capacity' => 189,
            'range_km' => 5600,
            'flight_type' => 'international',
            'arrival_date' => '2025-12-01 10:00:00',
            'departure_date' => '2025-12-01 14:00:00',
        ]);

        PlaneModel::create([
            'model' => 'Airbus A320',
            'capacity' => 180,
            'range_km' => 6100,
            'flight_type' => 'european',
            'arrival_date' => '2025-12-02 12:00:00',
            'departure_date' => '2025-12-02 16:00:00',
        ]);

        PlaneModel::create([
            'model' => 'Cessna 172',
            'capacity' => 4,
            'range_km' => 1280,
            'flight_type' => 'local',
            'arrival_date' => '2025-12-03 09:00:00',
            'departure_date' => '2025-12-03 11:00:00',
        ]);
    }
}
