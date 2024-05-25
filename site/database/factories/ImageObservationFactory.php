<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ImageObservation;

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
            'observation_id' => function () {
                return Observation::query()->inRandomOrder()->first()->id;
            },
            'user_id' => function () {
                return User::query()->inRandomOrder()->first()->id;
            },
            'photography_number' => $this->faker->unique()->numberBetween(1000, 9999),
            'image_id' => $this->faker->randomElement([]),
        ];
    }
}
