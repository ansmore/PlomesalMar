<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DepartureUserObservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartureUserObservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DepartureUserObservation::factory()->count(50)->create();
    }
}
