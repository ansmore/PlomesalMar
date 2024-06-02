<?php

namespace Tests\Unit;

use App\Models\Specie;
use App\Models\Departure;
use App\Models\Observation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class GraphControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Replace the default getSpeciesDataByYear method for testing with SQLite
        Observation::macro('getSpeciesDataByYear', function($speciesId, $year) {
            return DB::table('observations')
                ->join('departure_observations', 'observations.id', '=', 'departure_observations.observation_id')
                ->join('departures', 'departure_observations.departure_id', '=', 'departures.id')
                ->select(DB::raw('strftime("%m", departures.date) as month'), DB::raw('SUM(observations.number_of_individuals) as total'))
                ->whereRaw('strftime("%Y", departures.date) = ?', [$year])
                ->where('observations.species_id', $speciesId)
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->keyBy('month');
        });

        // Replace the default getYears method for testing with SQLite
        Observation::macro('getYears', function() {
            return DB::table('departures')
                ->select(DB::raw('strftime("%Y", date) as year'))
                ->distinct()
                ->orderBy('year', 'desc')
                ->pluck('year');
        });
    }

    public function test_index_view_is_accessible()
    {
        $response = $this->actingAs(User::factory()->create())->get(route('dashboard.management', ['language' => 'en']));

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.managementGraph');
    }

    public function test_graph1_view_is_accessible()
    {
        $this->actingAs(User::factory()->create());

        $specie = Specie::factory()->create();
        $departure = Departure::factory()->create();
        $observation = Observation::factory()->create([
            'species_id' => $specie->id,
            'time' => now(),
        ]);

        DB::table('departure_observations')->insert([
            'observation_id' => $observation->id,
            'departure_id' => $departure->id,
        ]);

        $response = $this->get(route('dashboard.graph1', [
            'language' => 'en',
            'year' => now()->year,
            'species' => $specie->id,
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.graphs.graph1');
        $response->assertViewHas('speciesData');
        $response->assertViewHas('labels');
        $response->assertViewHas('species');
        $response->assertViewHas('selectedSpecieId');
        $response->assertViewHas('years');
        $response->assertViewHas('selectedYear');
    }

    public function test_multi_year_species_graph_view_is_accessible()
    {
        $this->actingAs(User::factory()->create());

        $specie1 = Specie::factory()->create();
        $specie2 = Specie::factory()->create();
        $departure = Departure::factory()->create();

        $observation1 = Observation::factory()->create([
            'species_id' => $specie1->id,
            'time' => now(),
        ]);

        $observation2 = Observation::factory()->create([
            'species_id' => $specie2->id,
            'time' => now(),
        ]);

        DB::table('departure_observations')->insert([
            'observation_id' => $observation1->id,
            'departure_id' => $departure->id,
        ]);

        DB::table('departure_observations')->insert([
            'observation_id' => $observation2->id,
            'departure_id' => $departure->id,
        ]);

        $request = [
            'year1' => now()->year,
            'year2' => now()->year,
            'species_id1' => $specie1->id,
            'species_id2' => $specie2->id,
        ];

        $response = $this->post(route('dashboard.multiGraph', array_merge($request, ['language' => 'en'])));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'labels',
            'speciesData1',
            'speciesData2',
            'speciesNames',
        ]);
    }

    public function test_donut_graph_view_is_accessible()
    {
        $this->actingAs(User::factory()->create());

        $departure = Departure::factory()->create();
        $specie = Specie::factory()->create();

        $observation = Observation::factory()->create([
            'species_id' => $specie->id,
            'time' => now(),
        ]);

        DB::table('departure_observations')->insert([
            'observation_id' => $observation->id,
            'departure_id' => $departure->id,
        ]);

        $response = $this->get(route('dashboard.donutGraph', [
            'language' => 'en',
            'departure_id' => $departure->id,
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.graphs.donutGraph');
        $response->assertViewHas('departures');
        $response->assertViewHas('observations');
    }
}
