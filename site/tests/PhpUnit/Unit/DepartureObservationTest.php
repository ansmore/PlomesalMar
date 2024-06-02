<?php

namespace Tests\Unit;

use App\Models\Departure;
use App\Models\DepartureObservation;
use App\Models\Observation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DepartureObservationTest extends TestCase
{
    use RefreshDatabase;

    public function test_departure_observation_belongs_to_departure()
    {
        $departure = Departure::factory()->create();
        $departureObservation = DepartureObservation::factory()->create(['departure_id' => $departure->id]);

        $this->assertEquals($departure->id, $departureObservation->departure->id);
    }

    public function test_departure_observation_belongs_to_observation()
    {
        $observation = Observation::factory()->create();
        $departureObservation = DepartureObservation::factory()->create(['observation_id' => $observation->id]);

        $this->assertEquals($observation->id, $departureObservation->observation->id);
    }
}
