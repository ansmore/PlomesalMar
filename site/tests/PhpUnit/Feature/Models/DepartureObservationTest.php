<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\DepartureObservation;
use App\Models\Departure;
use App\Models\Observation;

class DepartureObservationTest extends TestCase
{
    use RefreshDatabase;

    public function testDepartureObservationCreation(): void
    {
        $departure = Departure::factory()->create();
        $observation = Observation::factory()->create();

        DepartureObservation::factory()->create([
            'departure_id' => $departure->id,
            'observation_id' => $observation->id
        ]);

        $this->assertDatabaseHas('departure_observations', [
            'departure_id' => $departure->id,
            'observation_id' => $observation->id
        ]);
    }

    public function testDepartureRelation(): void
    {
        $departure = Departure::factory()->create();
        $observation = Observation::factory()->create();

        $departureObservation = DepartureObservation::factory()->create([
            'departure_id' => $departure->id,
            'observation_id' => $observation->id
        ]);

        $this->assertEquals($departure->id, $departureObservation->departure->id);
    }

    public function testObservationRelation(): void
    {
        $departure = Departure::factory()->create();
        $observation = Observation::factory()->create();

        $departureObservation = DepartureObservation::factory()->create([
            'departure_id' => $departure->id,
            'observation_id' => $observation->id
        ]);

        $this->assertEquals($observation->id, $departureObservation->observation->id);
    }

    public function testCreateRelations(): void
    {
        $departure = Departure::factory()->create();
        $observation = Observation::factory()->create();

        DepartureObservation::createRelations($departure->id, $observation->id);

        $this->assertDatabaseHas('departure_observations', [
            'departure_id' => $departure->id,
            'observation_id' => $observation->id
        ]);
    }
}
