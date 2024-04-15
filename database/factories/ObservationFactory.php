<?php

namespace Database\Factories;

use App\Models\Specie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Observation>
 */
class ObservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'waypoint' => $this->faker->word,
            'species_id' => Specie::inRandomOrder()->first()->id,
            'number_of_individuals' => $this->faker->numberBetween(1, 100),
            'in_flight' => $this->faker->boolean,
            'distance_under_300m' => $this->faker->boolean,
            'notes' => $this->faker->optional()->text,
        ];
    }
}