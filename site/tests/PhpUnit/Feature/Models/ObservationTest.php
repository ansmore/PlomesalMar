<?php

namespace Tests\Feature\Models;

use Tests\TestCase;
use App\Models\Specie;
use App\Models\Departure;
use App\Models\Observation;
use Illuminate\Http\Request;
use App\Models\ImageObservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ObservationTest extends TestCase
{
    use RefreshDatabase;

    public function testObservationCreation(): void
    {
        $specie = Specie::factory()->create();

        $observation = Observation::factory()->create([
            'waypoint' => 'WP123',
            'species_id' => $specie->id,
            'time' => '12:00',
            'number_of_individuals' => 5,
            'in_flight' => true,
            'distance_under_300m' => false,
            'notes' => 'Sample note',
            'is_validated' => true,
        ]);

        $this->assertDatabaseHas('observations', [
            'waypoint' => 'WP123',
            'species_id' => $specie->id,
            'time' => '12:00',
            'number_of_individuals' => 5,
            'in_flight' => true,
            'distance_under_300m' => false,
            'notes' => 'Sample note',
            'is_validated' => true,
        ]);
    }

    public function testSpeciesRelation(): void
    {
        $specie = Specie::factory()->create();
        $observation = Observation::factory()->create(['species_id' => $specie->id]);

        $this->assertEquals($specie->id, $observation->species->id);
    }

    public function testImagesRelation(): void
    {
        $observation = Observation::factory()->create();
        $imageObservation = ImageObservation::factory()->create(['observation_id' => $observation->id]);

        $this->assertTrue($observation->images->contains($imageObservation));
    }

    public function testDepartureRelation(): void
    {
        $observation = Observation::factory()->create();
        $departure = Departure::factory()->create();

        DB::table('departure_observations')->insert([
            'observation_id' => $observation->id,
            'departure_id' => $departure->id,
        ]);

        $this->assertTrue($observation->departure->contains($departure));
    }

    public function testGetSpeciesDataByYear(): void
    {
        $specie = Specie::factory()->create();
    
        $departure = Departure::factory()->create(['date' => '2023-06-01']);
    
        $observation = Observation::factory()->create([
            'species_id' => $specie->id,
            'number_of_individuals' => 5
        ]);
    
        DB::table('departure_observations')->insert([
            'observation_id' => $observation->id,
            'departure_id' => $departure->id,
        ]);
    
        $data = DB::table('observations')
            ->join('departure_observations', 'observations.id', '=', 'departure_observations.observation_id')
            ->join('departures', 'departure_observations.departure_id', '=', 'departures.id')
            ->select('departures.date', 'observations.number_of_individuals')
            ->whereYear('departures.date', 2023)
            ->where('observations.species_id', $specie->id)
            ->get();
    
        $groupedData = DB::table('observations')
            ->join('departure_observations', 'observations.id', '=', 'departure_observations.observation_id')
            ->join('departures', 'departure_observations.departure_id', '=', 'departures.id')
            ->select(DB::raw("strftime('%m', departures.date) as month"), DB::raw('SUM(observations.number_of_individuals) as total'))
            ->whereYear('departures.date', 2023)
            ->where('observations.species_id', $specie->id)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');
    
        $this->assertEquals(5, $groupedData->first()->total);
    }

    public function testGetYears(): void
    {
        Departure::factory()->create(['date' => '2023-06-01']);
        Departure::factory()->create(['date' => '2022-06-01']);

        $years = DB::table('departures')
            ->select(DB::raw("strftime('%Y', date) as year"))
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        $this->assertCount(2, $years);
        $this->assertEquals(2023, $years[0]);
        $this->assertEquals(2022, $years[1]);
    }

    public function testScopeSearch(): void
    {
        Observation::factory()->create(['waypoint' => 'WP123']);
        Observation::factory()->create(['waypoint' => 'WP456']);

        $observations = Observation::search('WP123')->get();
        $this->assertCount(1, $observations);
        $this->assertEquals('WP123', $observations->first()->waypoint);
    }

    public function testGetFilteredObservations(): void
    {
        Observation::factory()->create(['waypoint' => 'WP123']);
        Observation::factory()->create(['waypoint' => 'WP456']);

        $request = new Request(['search' => 'WP123']);
        $observations = Observation::getFilteredObservations($request);

        $this->assertCount(1, $observations);
        $this->assertEquals('WP123', $observations->first()->waypoint);
    }

    public function testCreateObservation(): void
    {
        $specie = Specie::factory()->create();

        $data = [
            'species_id' => $specie->id,
            'time' => '12:00',
            'waypoint' => 'WP123',
            'number_of_individuals' => 5,
            'in_flight' => true,
            'distance_under_300m' => false,
            'notes' => 'Sample note'
        ];

        $observationId = Observation::createObservation($data);

        $this->assertDatabaseHas('observations', [
            'id' => $observationId,
            'waypoint' => 'WP123'
        ]);
    }

    public function testDeleteWithRelations(): void
    {
        $observation = Observation::factory()->create();
        $imageObservation = ImageObservation::factory()->create(['observation_id' => $observation->id]);

        $observation->deleteWithRelations();

        $this->assertDatabaseMissing('observations', ['id' => $observation->id]);
        $this->assertDatabaseMissing('observation_image', ['id' => $imageObservation->id]);
    }

    public function testUpdateObservation(): void
    {
        $observation = Observation::factory()->create(['waypoint' => 'WP123']);
        $specie = Specie::factory()->create();
        $departure = Departure::factory()->create();

        $data = [
            'time' => '13:00',
            'species_id' => $specie->id,
            'waypoint' => 'WP456',
            'in_flight' => true,
            'distance_under_300m' => true,
            'is_validated' => true,
            'number_of_individuals' => 10,
            'notes' => 'Updated note',
            'departure_id' => $departure->id
        ];

        $observation->updateObservation($data);

        $this->assertDatabaseHas('observations', [
            'id' => $observation->id,
            'waypoint' => 'WP456',
            'number_of_individuals' => 10,
            'notes' => 'Updated note'
        ]);
    }

    public function testGetImageUrls(): void
    {
        $observation = Observation::factory()->create();
        $imageObservation = ImageObservation::factory()->create(['observation_id' => $observation->id]);

        Http::fake([
            '*' => Http::response(['optimized_images' => [
                ['version' => 'small', 'url' => '/images/small.jpg'],
                ['version' => 'medium', 'url' => '/images/medium.jpg'],
                ['version' => 'large', 'url' => '/images/large.jpg']
            ]], 200)
        ]);

        $imageUrls = $observation->getImageUrls();

        $this->assertCount(1, $imageUrls);
        $this->assertArrayHasKey('images', $imageUrls[0]);
        $this->assertArrayHasKey('small', $imageUrls[0]['images']);
        $this->assertArrayHasKey('medium', $imageUrls[0]['images']);
        $this->assertArrayHasKey('large', $imageUrls[0]['images']);
    }

    public function testFirstImage(): void
    {
        $observation = Observation::factory()->create();
        $imageObservation = ImageObservation::factory()->create(['observation_id' => $observation->id]);

        $firstImage = $observation->firstImage;

        $this->assertEquals($imageObservation->id, $firstImage->id);
    }
}
