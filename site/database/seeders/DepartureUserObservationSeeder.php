<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DepartureUserObservation;

class DepartureUserObservationSeeder extends Seeder
{
    public function run()
    {
        DepartureUserObservation::factory()->count(50)->create();
    }
}
