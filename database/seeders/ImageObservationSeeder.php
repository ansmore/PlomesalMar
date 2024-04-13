<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ImageObservation;
use App\Models\Image;
use App\Models\Observation;

class ImageObservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		/**
         *
         */
        $image = Image::find(1);
        $observation = Observation::find(5);
        ImageObservation::factory()->create([
            'observation_id' => $observation->id,
            'image_id' => $image->id,
        ]);
		/**
         *
         */
        $image = Image::find(2);
        $observation = Observation::find(3);
        ImageObservation::factory()->create([
            'observation_id' => $observation->id,
            'image_id' => $image->id,
        ]);
        ImageObservation::factory()->count(5)->create();
    }
}
