<?php

namespace App\Http\Controllers;

use App\Models\Specie;
use App\Models\Departure;
use App\Models\Observation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class GraphController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function index($language = null)
    {
        return view('dashboard.managementGraph', [
			'language' => $language,
        ]);
    }

    public function graph1(Request $request, $language = null)
    {
        $language = Session::get('language', config('app.fallback_locale', 'ca'));
        $species = Specie::all();
        $years = Observation::getYears();
        
        $selectedYear = $request->input('year', $years->first());
        $selectedSpecieId = $request->input('species', $species->first()->id ?? null);
        
        $speciesData = [];
        foreach ($species as $specie) {
            $observations = Observation::getSpeciesDataByYear($specie->id, $selectedYear);
            
            $months = [1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'];
            $data = array_fill_keys(array_keys($months), 0);
            foreach ($observations as $month => $observation) {
                $data[$month] = $observation->total;
            }
            $speciesData[$specie->id] = array_values($data);
        }

        $labels = array_values($months);
        return view('dashboard.graphs.graph1', [
            'language' => $language,
            'speciesData' => $speciesData,
            'labels' => $labels,
            'species' => $species,
            'selectedSpecieId' => $selectedSpecieId,
            'years' => $years,
            'selectedYear' => $selectedYear
        ]);
    }

    public function multiYearSpeciesGraph(Request $request, $language = null)
    {
        $language = Session::get('language', config('app.fallback_locale', 'ca'));
        $selectedYear1 = $request->input('year1', date('Y'));
        $selectedYear2 = $request->input('year2', date('Y'));

        $selectedSpeciesIds = array_filter([
            $request->input('species_id1', null),
            $request->input('species_id2', null),
            $request->input('species_id3', null),
            $request->input('species_id4', null),
            $request->input('species_id5', null)
        ], fn($id) => !is_null($id));

        $years = Observation::getYears();

        $speciesData1 = [];
        $speciesData2 = [];
        $speciesNames = [];

        $months = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo',
            6 => 'Junio', 7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre',
            11 => 'Noviembre', 12 => 'Diciembre'
        ];

        foreach ($selectedSpeciesIds as $speciesId) {
            $species = Specie::find($speciesId);
            if (!$species) {
                continue;
            }

            $speciesNames[$speciesId] = $species->common_name;

            $data1 = array_fill_keys(array_keys($months), 0);
            $data2 = array_fill_keys(array_keys($months), 0);

            $observations1 = Observation::getSpeciesDataByYear($speciesId, $selectedYear1);
            $observations2 = Observation::getSpeciesDataByYear($speciesId, $selectedYear2);

            foreach ($observations1 as $month => $observation) {
                $data1[$month] = $observation->total;
            }

            foreach ($observations2 as $month => $observation) {
                $data2[$month] = $observation->total;
            }

            $speciesData1[$speciesId] = array_values($data1);
            $speciesData2[$speciesId] = array_values($data2);
        }

        $labels = array_values($months);

        if ($request->isMethod('post')) {
            return response()->json([
                'labels' => $labels,
                'speciesData1' => $speciesData1,
                'speciesData2' => $speciesData2,
                'speciesNames' => $speciesNames,
            ]);
        }

        return view('dashboard.graphs.multiGraph', [
            'language' => $language,
            'speciesData1' => $speciesData1,
            'speciesData2' => $speciesData2,
            'labels' => $labels,
            'speciesNames' => $speciesNames,
            'species' => Specie::all(),
            'selectedYear1' => $selectedYear1,
            'selectedYear2' => $selectedYear2,
            'selectedSpeciesIds' => $selectedSpeciesIds,
            'years' => $years,
            'months' => $months
        ]);
    }


    public function donutGraph(Request $request)
    {
        $departures = Departure::all();
        $observations = [];

        if ($request->has('departure_id')) {
            $departureId = $request->input('departure_id');
            $observations = DB::table('observations')
                ->join('departure_observations', 'observations.id', '=', 'departure_observations.observation_id')
                ->join('species', 'observations.species_id', '=', 'species.id')
                ->where('departure_observations.departure_id', $departureId)
                ->select('species.common_name as species', DB::raw('SUM(observations.number_of_individuals) as total'))
                ->groupBy('species.common_name')
                ->get();
        }

        return view('dashboard.graphs.donutGraph', compact('departures', 'observations'));
    }

}