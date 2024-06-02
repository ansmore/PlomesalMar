<?php

namespace Tests\Unit;

use App\Models\Specie;
use App\Models\Observation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SpecieTest extends TestCase
{
    use RefreshDatabase;

    public function test_specie_can_have_observations()
    {
        $specie = Specie::factory()->create();
        $observation = Observation::factory()->create(['species_id' => $specie->id]);

        // Cargar la relación observations
        $specie->load('observations');

        $this->assertTrue($specie->observations->contains($observation));
    }
}
