<?php

namespace App\Http\Controllers\V1;

use App\Models\Departure;
use App\Models\Observation;
use Illuminate\Http\Request;
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
            'time' => 'required',
            'users' => 'required|array',
            'users.*' => 'exists:users,id',
            'observers' => 'required|array',
            'observers.*' => 'exists:users,id',
            'observations' => 'required|array',
            'observations.*.species_id' => 'required|exists:species,id',
            'observations.*.waypoint' => 'required|string|max:255',
            'observations.*.number_of_individuals' => 'required|integer',
            'observations.*.in_flight' => 'boolean',
            'observations.*.distance_under_300m' => 'boolean',
            'observations.*.notes' => 'nullable|string',
            'observations.*.images' => 'nullable|array',
            'observations.*.images.*.photography_number' => 'required|integer',
        ]);

        DB::beginTransaction();

        try {
            $departure = Departure::create($request->only(['boat_id', 'transect_id', 'date', 'time']));

            foreach ($request->observations as $observationData) {
                $imagesData = $observationData['images'] ?? [];
                unset($observationData['images']);

                $observation = Observation::create($observationData);
                $observation->save();

                foreach ($imagesData as $imageData) {
                    $image = new Image($imageData);
                    $image->save();
                    $observation->images()->attach($image->id);
                }

                foreach ($request->users as $userId) {
                    $isObserver = in_array($userId, $request->observers);
                    DepartureUserObservation::create([
                        'departure_id' => $departure->id,
                        'user_id' => $userId,
                        'observation_id' => $observation->id,
                        'is_observer' => $isObserver
                    ]);
                }
            }

            DB::commit();

            return response()->json($departure->load('observations.images'), 201);

        } catch (Exception $e) {
            DB::rollBack();
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}