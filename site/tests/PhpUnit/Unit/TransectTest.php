<?php

namespace Tests\Unit;

use App\Models\Transect;
use App\Models\Departure;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransectTest extends TestCase
{
    use RefreshDatabase;

    public function test_transect_can_have_departures()
    {
        $transect = Transect::factory()->create();
        $departure = Departure::factory()->create(['transect_id' => $transect->id]);

        $this->assertTrue($transect->departure->contains($departure));
    }
}
