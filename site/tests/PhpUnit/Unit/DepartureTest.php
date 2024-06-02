<?php

namespace Tests\Unit;

use App\Models\Boat;
use App\Models\Departure;
use App\Models\Transect;
use App\Models\Observation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DepartureTest extends TestCase
{
    use RefreshDatabase;

    public function test_departure_belongs_to_boat()
    {
        $boat = Boat::factory()->create();
        $departure = Departure::factory()->create(['boat_id' => $boat->id]);

        $this->assertEquals($boat->id, $departure->boat->id);
    }

    public function test_departure_belongs_to_transect()
    {
        $transect = Transect::factory()->create();
        $departure = Departure::factory()->create(['transect_id' => $transect->id]);

        $this->assertEquals($transect->id, $departure->transect->id);
    }

    public function test_departure_can_have_observations()
    {
        $departure = Departure::factory()->create();
        $observation = Observation::factory()->create();

        $departure->observations()->attach($observation);

        $this->assertTrue($departure->observations->contains($observation));
    }
}
