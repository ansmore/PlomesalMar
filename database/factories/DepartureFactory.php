<?php

namespace Database\Factories;

use App\Models\Boat;
use App\Models\Transect;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Departure>
 */
class DepartureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'boat_id' => Boat::inRandomOrder()->first()->id,
            'transect_id' => Transect::inRandomOrder()->first()->id,
            'date' => $this->faker->date(),
            'time' => $this->faker->time()
        ];
    }
}