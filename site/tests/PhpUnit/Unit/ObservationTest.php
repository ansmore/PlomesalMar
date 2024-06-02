<?php

namespace Tests\Unit;

use App\Models\Observation;
use App\Models\Specie;
use App\Models\ImageObservation;
use App\Models\Departure;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ObservationTest extends TestCase
{
    use RefreshDatabase;

    public function test_observation_belongs_to_specie()
    {
        $specie = Specie::factory()->create();
        $observation = Observation::factory()->create(['species_id' => $specie->id]);

        $this->assertEquals($specie->id, $observation->species->id);
    }

    public function test_observation_can_have_images()
    {
        $observation = Observation::factory()->create();
        $imageObservation = ImageObservation::factory()->create(['observation_id' => $observation->id]);

        $this->assertTrue($observation->images->contains($imageObservation));
    }

    public function test_observation_can_belong_to_departures()
    {
        $observation = Observation::factory()->create();
        $departure = Departure::factory()->create();

        $observation->departure()->attach($departure);

        $this->assertTrue($observation->departure->contains($departure));
    }
}
