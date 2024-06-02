<?php

namespace Database\Factories;

use App\Models\DepartureObservation;
use App\Models\Departure;
use App\Models\Observation;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartureObservationFactory extends Factory
{
    protected $model = DepartureObservation::class;

    public function definition()
    {
        return [
            'departure_id' => Departure::factory(),
            'observation_id' => Observation::factory(),
        ];
    }
}
