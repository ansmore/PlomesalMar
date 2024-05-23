<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ImageObservation;
use App\Models\Observation;
use App\Models\User;

class ImageObservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $observation1 = Observation::find(5) ?? Observation::factory()->create();
        $user1 = User::find(1) ?? User::factory()->create();
        ImageObservation::factory()->create([
            'observation_id' => $observation1->id,
            'user_id' => $user1->id,
            'photography_number' => 1010
        ]);

        $observation2 = Observation::find(3) ?? Observation::factory()->create();
        $user2 = User::find(2) ?? User::factory()->create();
        ImageObservation::factory()->create([
            'observation_id' => $observation2->id,
            'user_id' => $user2->id,
            'photography_number' => 1020
        ]);

        ImageObservation::factory()->count(5)->create();
    }
}
