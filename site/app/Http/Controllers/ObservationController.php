<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Specie;
use App\Models\Departure;
use App\Models\Observation;
use Illuminate\Http\Request;
use App\Models\ImageObservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class ObservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $language = null)
    {
        $observations = Observation::getFilteredObservations($request);
        return view('pages.observations', ['language' => $language, 'observations' => $observations]);
    }

    public function create($language = null)
    {
        $departures = Departure::all();
        $species = Specie::all();

        foreach ($departures as $departure) {
            if (is_string($departure->observers)) {
                $observerNames = explode(',', $departure->observers);
            } else {
                $observerNames = $departure->observers;
            }
            $observerNames = array_map('trim', $observerNames);
            $users = User::whereIn('name', $observerNames)->get(['id', 'name']);
            $departure->observer_users = $users;
        }

        return view('pages.observationsPages.create', compact('departures', 'species'));
    }

    public function store(Request $request, $language = null)
    {
        $validatedData = $request->validate([
            'departure_id' => 'required|exists:departures,id',
            'time' => 'required|date_format:H:i',
            'species_id' => 'required|exists:species,id',
            'waypoint' => 'required|string',
            'in_flight' => 'boolean',
            'distance_under_300m' => 'boolean',
            'number_of_individuals' => 'required|integer|min:1',
            'notes' => 'nullable|string',
            'image_user' => 'nullable|array',
            'image_user.*' => 'exists:users,id',
            'image_number' => 'nullable|array',
            'image_number.*' => 'integer',
            'image_file' => 'nullable|array',
            'image_file.*' => 'image|max:10240',
        ]);

        DB::beginTransaction();

        try {
            $observationId = Observation::createObservation($validatedData);

            DB::table('departure_observations')->insert([
                'departure_id' => $validatedData['departure_id'],
                'observation_id' => $observationId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if (isset($validatedData['image_file'])) {
                foreach ($validatedData['image_file'] as $index => $file) {
                    $response = Http::withHeaders([
                        'Accept' => 'application/json',
                        'APP-TOKEN' => config('services.api.token'),
                    ])->attach(
                        'image', file_get_contents($file), $file->getClientOriginalName()
                    )->post(config('services.api.url') . '/api/V1/images');

                    if ($response->successful()) {
                        $imageId = $response->json()['imageId'];

                        ImageObservation::create([
                            'image_id' => $imageId,
                            'observation_id' => $observationId,
                            'user_id' => $validatedData['image_user'][$index] ?? null,
                            'photography_number' => $validatedData['image_number'][$index] ?? null,
                        ]);
                    } else {
                        Log::error('Error pujant la imatge: ' . $response->body());
                        throw new \Exception('Error en pujar una o més imatges.');
                    }
                }
            }

            DB::commit();

            return redirect()->route('observations.index', ['language' => $language])->with('status', 'Observació creada correctament.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creant l\'observació: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error en crear l\'observació: ' . $e->getMessage());
        }
    }

    public function edit($language, $id)
    {
        $observation = Observation::findOrFail($id);
        $departures = Departure::all();
        $species = Specie::all();
        $users = User::all();

        $departureObservation = $observation->getDepartureObservation();
        $departureId = $departureObservation ? $departureObservation->departure_id : null;

        foreach ($departures as $departure) {
            $departure->observer_users = $departure->getObserverUsers();
        }

        $imageUrls = $observation->getImageUrls();

        return view('pages.observationsPages.edit', compact('observation', 'departures', 'species', 'imageUrls', 'departureId', 'users'));
    }

    public function update(Request $request, $language, $id)
    {
        try {
            $validatedData = $request->validate([
                'departure_id' => 'required|exists:departures,id',
                'time' => 'required|date_format:H:i:s',
                'species_id' => 'required|exists:species,id',
                'waypoint' => 'required|string',
                'in_flight' => 'boolean',
                'distance_under_300m' => 'boolean',
                'is_validated' => 'boolean',
                'number_of_individuals' => 'required|integer|min:1',
                'notes' => 'nullable|string',
                'image_user' => 'nullable|array',
                'image_user.*' => 'exists:users,id',
                'image_number' => 'nullable|array',
                'image_number.*' => 'nullable|integer',
                'image_file' => 'nullable|array',
                'image_file.*' => 'image|max:10240',
                'image_file_new' => 'nullable|array',
                'image_file_new.*' => 'image|max:10240',
                'image_user_new' => 'nullable|array',
                'image_user_new.*' => 'exists:users,id',
                'image_number_new' => 'nullable|array',
                'image_number_new.*' => 'nullable|integer',
            ]);

            DB::beginTransaction();

            $observation = Observation::findOrFail($id);
            $observation->updateObservation($validatedData);

            if (isset($validatedData['image_file'])) {
                $observation->updateImages($validatedData['image_file']);
            }

            if (isset($validatedData['image_file_new']) && isset($validatedData['image_user_new']) && isset($validatedData['image_number_new'])) {
                $observation->addNewImages(
                    $validatedData['image_file_new'],
                    $validatedData['image_user_new'],
                    $validatedData['image_number_new']
                );
            }

            DB::commit();

            return redirect()->route('observations.index', ['language' => $language])->with('status', 'Observació actualitzada correctament.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error actualitzant l\'observació: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error en actualitzar l\'observació: ' . $e->getMessage());
        }
    }

    public function deleteImage(Request $request, $language, $observationId)
    {
        $imageId = $request->input('image_id');

        DB::beginTransaction();

        try {
            $observation = Observation::findOrFail($observationId);
            $observation->deleteImage($imageId);

            DB::commit();

            return redirect()->route('observations.edit', ['language' => $language, 'observation' => $observationId])->with('status', 'Imatge eliminada correctament.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error eliminant la imatge: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error en eliminar la imatge: ' . $e->getMessage());
        }
    }

    public function show($language = null, $id)
    {
        $observation = Observation::findOrFail($id);
        $departures = Departure::all();
        $species = Specie::all();

        $departureObservation = $observation->getDepartureObservation();
        $departureId = $departureObservation ? $departureObservation->departure_id : null;

        foreach ($departures as $departure) {
            $departure->observer_users = $observation->getObserverUsers($departure);
        }

        $imageUrls = $observation->getImageUrls();

        return view('pages.observationsPages.show', compact('observation', 'departures', 'species', 'imageUrls', 'departureId'));
    }

    public function destroy(Request $request, $language, $id)
    {
        try {
            $observation = Observation::find($id);

            if (!$observation) {
                Log::warning('No s\'ha trobat l\'observació amb ID: ' . $id);
                return redirect()->back()->with('error', 'No s\'ha trobat l\'observació.');
            }

            $observation->deleteWithRelations();

            return redirect()->back()->with('status', 'L\'observació s\'ha eliminat amb èxit.');
        } catch (\Exception $e) {
            Log::error('Error en intentar eliminar l\'observació: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
