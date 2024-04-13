<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Image;
use App\Models\Observation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ImageObservation>
 */
class ImageObservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
		$existingImages = Image::all();
		$existingObservations = Observation::all();

		if ( $existingImages->isEmpty()) {
            $existingImages = Image::factory()->create();
        }

        if ($existingObservations->isEmpty() ) {
            $existingObservations = Observation::factory()->create();
        }

		$selectedImage = $existingImages->random();
		$selectedObservation = $existingObservations->random();

        return [
            'image_id' => $selectedImage->id,
			'observation_id' => $selectedObservation->id,
        ];
    }
}
