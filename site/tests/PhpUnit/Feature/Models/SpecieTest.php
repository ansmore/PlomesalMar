<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Specie;
use Illuminate\Http\Request;

class SpecieTest extends TestCase
{
    use RefreshDatabase;

    public function testSpecieCreation(): void
    {
        Specie::factory()->create([
            'scientific_name' => 'Panthera leo',
            'common_name' => 'Lion'
        ]);

        $this->assertDatabaseHas('species', [
            'scientific_name' => 'Panthera leo',
            'common_name' => 'Lion'
        ]);

        $this->assertDatabaseMissing('species', [
            'scientific_name' => 'Panthera tigris',
            'common_name' => 'Tiger'
        ]);
    }

    public function testSpecieSearchScope(): void
    {
        Specie::factory()->create([
            'scientific_name' => 'Panthera leo',
            'common_name' => 'Lion'
        ]);

        Specie::factory()->create([
            'scientific_name' => 'Panthera tigris',
            'common_name' => 'Tiger'
        ]);

        $species = Specie::search('Lion')->get();
        $this->assertCount(1, $species);
        $this->assertEquals('Lion', $species->first()->common_name);

        $species = Specie::search('Panthera')->get();
        $this->assertCount(2, $species);
    }

    public function testSpecieUpdate(): void
    {
        $specie = Specie::factory()->create([
            'scientific_name' => 'Panthera leo',
            'common_name' => 'Lion'
        ]);

        $request = new Request([
            'common_name' => 'African Lion',
            'scientific_name' => 'Panthera leo leo'
        ]);

        $updateResult = Specie::updateFromRequest($request, $specie->id);
        $this->assertTrue($updateResult);

        $this->assertDatabaseHas('species', [
            'common_name' => 'African Lion',
            'scientific_name' => 'Panthera leo leo'
        ]);
    }

    public function testSpecieCreateFromRequest(): void
    {
        $request = new Request([
            'common_name' => 'Lion',
            'scientific_name' => 'Panthera leo'
        ]);

        $newSpecie = Specie::createFromRequest($request);

        $this->assertDatabaseHas('species', [
            'common_name' => 'Lion',
            'scientific_name' => 'Panthera leo'
        ]);

        $this->assertEquals('Lion', $newSpecie->common_name);
        $this->assertEquals('Panthera leo', $newSpecie->scientific_name);
    }

    public function testSpecieGetFilteredSpecies(): void
    {
        Specie::factory()->create([
            'scientific_name' => 'Panthera leo',
            'common_name' => 'Lion'
        ]);

        Specie::factory()->create([
            'scientific_name' => 'Panthera tigris',
            'common_name' => 'Tiger'
        ]);

        $request = new Request([
            'search' => 'Panthera',
            'orderByField' => 'common_name',
            'orderByDirection' => 'asc'
        ]);

        $species = Specie::getFilteredSpecies($request);

        $this->assertCount(2, $species);
        $this->assertEquals('Lion', $species->first()->common_name);
        $this->assertEquals('Tiger', $species->last()->common_name);
    }
}
