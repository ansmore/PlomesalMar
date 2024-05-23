<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Specie;
use App\Models\Departure;
use App\Models\Observation;
use Illuminate\Http\Request;
use App\Models\DepartureUserObservation;
use App\Models\ObservationImage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;


class ObservationController extends Controller
{
    
	public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $language = null)
    {
        $observations = Observation::getFilteredObservations($request);
        return view('pages.observations', ['language' => $language, 'observations' => $observations]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create($language = null)
    {
        $departures = Departure::with('users')->get();
        $species = Specie::all();
        $users = User::all();

        return view('pages.observationsPages.create', compact('departures', 'species', 'users'));
    }

    public function store(Request $request, $language = null)
    {
        $validatedData = $request->validate([
            'departure_id' => 'required|exists:departures,id',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
            'time' => 'required|date_format:H:i',
            'species_id' => 'required|exists:species,id',
            'waypoint' => 'required|string',
            'in_flight' => 'boolean',
            'distance_under_300m' => 'boolean',
            'number_of_individuals' => 'required|integer|min:1',
            'notes' => 'nullable|string',
            'image_user_id' => 'nullable|array',
            'image_user_id.*' => 'exists:users,id',
            'image_number' => 'nullable|array',
            'image_number.*' => 'integer',
            'image_file' => 'nullable|array',
            'image_file.*' => 'image|max:10240',
        ]);

        DB::beginTransaction();

        try {
            $observationId = Observation::createObservation($validatedData);

            $allUsers = Departure::find($validatedData['departure_id'])->users;

            DepartureUserObservation::createRelations($validatedData['departure_id'], $observationId, $validatedData['user_ids'], $allUsers);

            if (isset($validatedData['image_file'])) {
                foreach ($validatedData['image_file'] as $index => $file) {
                    $response = Http::withHeaders([
                        'Accept' => 'application/json',
                        'APP-TOKEN' => config('services.api.token'),
                    ])->attach(
                        'image', file_get_contents($file), $file->getClientOriginalName()
                    )->post(config('services.api.url') . '/V1/images');

                    if ($response->successful()) {
                        $imageId = $response->json()['imageId'];

                        ObservationImage::create([
                            'image_id' => $imageId,
                            'observation_id' => $observationId,
                            'user_id' => $validatedData['image_user_id'][$index],
                            'photography_number' => $validatedData['image_number'][$index],
                        ]);
                    } else {
                        throw new QueryException('Error al subir una o más imágenes.');
                    }
                }
            }

            DB::commit();

            return redirect()->route('observations.index')->with('success', 'Observación creada correctamente.');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['db_error' => 'Error al crear la observación: ' . $e->getMessage()]);
        }
    }
}