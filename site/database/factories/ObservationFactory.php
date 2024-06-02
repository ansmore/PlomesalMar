<?php

namespace Database\Factories;

use App\Models\Observation;
use App\Models\Specie;
use Illuminate\Database\Eloquent\Factories\Factory;

class ObservationFactory extends Factory
{
    protected $model = Observation::class;

    public function definition()
    {
        return [
            'waypoint' => $this->faker->word,
            'species_id' => Specie::factory(),
            'time' => $this->faker->time(),
            'number_of_individuals' => $this->faker->numberBetween(1, 100),
            'in_flight' => $this->faker->boolean(),
            'distance_under_300m' => $this->faker->boolean(),
            'notes' => $this->faker->sentence,
            'is_validated' => $this->faker->boolean(),
        ];
    }
}
