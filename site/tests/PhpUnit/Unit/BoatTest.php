<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Boat;
use App\Models\Departure;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BoatTest extends TestCase
{
    use RefreshDatabase;

    public function test_boat_can_have_departures()
    {
        $boat = Boat::factory()->create();
        $departure = Departure::factory()->create(['boat_id' => $boat->id]);

        $this->assertTrue($boat->departures->contains($departure));
    }

    public function test_cannot_delete_boat_with_departures()
    {
        $this->expectException(QueryException::class);

        $boat = Boat::factory()->create();
        Departure::factory()->create(['boat_id' => $boat->id]);

        $boat->delete();
    }
}
