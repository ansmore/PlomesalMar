<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Departure;
use App\Models\Observation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\departure_user_observation>
 */
class DepartureUserObservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'departure_id' => Departure::factory(),
            'user_id' => User::factory(),
            'observation_id' => Observation::factory(),
            'is_observer' => $this->faker->boolean,
        ];
    }
}