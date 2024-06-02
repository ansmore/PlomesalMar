<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ImageObservation;
use App\Models\Observation;
use App\Models\User;

class ImageObservationFactory extends Factory
{
    protected $model = ImageObservation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'observation_id' => Observation::factory(),
            'user_id' => User::factory(),
            'photography_number' => $this->faker->unique()->numberBetween(1000, 9999),
            'image_id' => $this->faker->unique()->numberBetween(1, 100),
        ];
    }
}
