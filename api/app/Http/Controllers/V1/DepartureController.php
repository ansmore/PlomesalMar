<?php

namespace App\Http\Controllers\V1;

use App\Models\Departure;
use App\Models\Observation;
use Illuminate\Http\Request;
use App\Models\ImageObservation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DepartureUserObservation;

class DepartureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departures = Departure::all();
        return response()->json($departures);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'boat_id' => 'required|exists:boats,id',
            'transect_id' => 'required|exists:transects,id',
            'date' => 'required|date',
            'observers' => 'required|array',
            'observers.*' => 'exists:users,id',
            'observations' => 'required|array',
            'observations.*.species_id' => 'required|exists:species,id',
            'observations.*.time' => 'required|date_format:H:i:s',
            'observations.*.waypoint' => 'required|string|max:255',
            'observations.*.number_of_individuals' => 'required|integer',
            'observations.*.in_flight' => 'boolean',
            'observations.*.distance_under_300m' => 'boolean',
            'observations.*.notes' => 'nullable|string'
        ]);

        DB::beginTransaction();

        try {
            // Obtener los nombres de los observadores seleccionados
            $observersNames = User::whereIn('id', $request->observers)->pluck('name')->toArray();
            $observers = implode(', ', $observersNames);

            // Crear Departure con los nombres de los observadores en el campo observers
            $departure = Departure::create([
                'boat_id' => $request->boat_id,
                'transect_id' => $request->transect_id,
                'date' => $request->date,
                'observers' => $observers
            ]);

            // Crear observaciones
            foreach ($request->observations as $observationData) {
                $observation = Observation::create([
                    'species_id' => $observationData['species_id'],
                    'time' => $observationData['time'],
                    'waypoint' => $observationData['waypoint'],
                    'number_of_individuals' => $observationData['number_of_individuals'],
                    'in_flight' => $observationData['in_flight'] ?? false,
                    'distance_under_300m' => $observationData['distance_under_300m'] ?? false,
                    'notes' => $observationData['notes'] ?? null,
                ]);

                // Vincular observación con la departure
                DB::table('departure_observations')->insert([
                    'departure_id' => $departure->id,
                    'observation_id' => $observation->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();
            return response()->json($departure, 201);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating departure: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $departure = Departure::findOrFail($id);
        return response()->json($departure);
    }

}
