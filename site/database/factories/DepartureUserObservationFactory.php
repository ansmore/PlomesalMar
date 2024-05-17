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
        $departureIds = Departure::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();
        $observationIds = Observation::pluck('id')->toArray();

        if (empty($departureIds) || empty($userIds) || empty($observationIds)) {
            throw new \Exception('One or more required tables (departures, users, observations) are empty.');
        }

        return [
            'departure_id' => $this->faker->randomElement($departureIds),
            'user_id' => $this->faker->randomElement($userIds),
            'observation_id' => $this->faker->randomElement($observationIds),
            'is_observer' => $this->faker->boolean,
        ];
    }
}
