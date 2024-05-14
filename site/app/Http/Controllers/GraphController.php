<?php

namespace App\Http\Controllers;

use App\Models\Specie;
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
        $language = Session::get('language', config('app.fallback_locale', 'ca'));
        $species = Specie::all();

        $speciesData = [];
        foreach ($species as $specie) {
            $observations = DB::table('observations')
            ->join('departure_user_observations', 'observations.id', '=', 'departure_user_observations.observation_id')
            ->join('departures', 'departure_user_observations.departure_id', '=', 'departures.id')
            ->select(DB::raw('MONTH(departures.date) as month'), DB::raw('SUM(observations.number_of_individuals) as total'))
            ->where('observations.species_id', $specie->id)
            ->groupBy('month')
            ->orderBy('month')
            ->get();        

            $months = [1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'];
            $data = array_fill_keys(array_keys($months), 0);
            foreach ($observations as $observation) {
                $data[$observation->month] = $observation->total;
            }
            $speciesData[$specie->id] = array_values($data);
        }

        $labels = array_values($months); 
        return view('pages.dashboard', [
            'language' => $language,
            'speciesData' => $speciesData,
            'labels' => $labels,
            'species' => $species,
            'selectedSpecieId' => $species->first()->id ?? null
        ]);
    }
}
