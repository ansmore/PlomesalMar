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
                            'user_id' => $validatedData['image_user'][$index],
                            'photography_number' => $validatedData['image_number'][$index],
                        ]);
                    } else {
                        Log::error('Error uploading image: ' . $response->body());
                        throw new \Exception('Error al subir una o más imágenes.');
                    }
                }
            }

            DB::commit();

            return redirect()->route('observations.index', ['language' => $language])->with('status', 'Observación creada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating observation: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al crear la observación: ' . $e->getMessage());
        }
    }

    public function edit($language, $id)
    {

        $observation = Observation::findOrFail($id);
        $departures = Departure::all();
        $species = Specie::all();

        $departureObservation = DB::table('departure_observations')
            ->where('observation_id', $observation->id)
            ->first();

        $departureId = $departureObservation ? $departureObservation->departure_id : null;

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

        $imageUrls = [];
        foreach ($observation->images as $image) {

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'APP-TOKEN' => config('services.api.token'),
            ])->get(config('services.api.url') . "/api/V1/images/{$image->image_id}");

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['optimized_images']) && is_array($data['optimized_images'])) {
                    $imageSet = [];
                    foreach ($data['optimized_images'] as $optimizedImage) {
                        if (isset($optimizedImage['version']) && isset($optimizedImage['url'])) {
                            $absoluteUrl = config('services.api.url') . $optimizedImage['url'];
                            $imageSet[$optimizedImage['version']] = $absoluteUrl;
                        }
                    }
                    if (!empty($imageSet)) {
                        $imageUrls[] = [
                            'user' => $image->user->name,
                            'image_id' => $image->image_id,
                            'images' => $imageSet
                        ];
                    }
                }
            } else {
                Log::error('Error fetching image from API: ' . $response->body());
            }
        }

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

            $existingImages = json_decode($request->input('existing_images'), true);

            DB::beginTransaction();

            $observation = Observation::findOrFail($id);

            $observation->time = $validatedData['time'];
            $observation->species_id = $validatedData['species_id'];
            $observation->waypoint = $validatedData['waypoint'];
            $observation->in_flight = $validatedData['in_flight'] ?? false;
            $observation->distance_under_300m = $validatedData['distance_under_300m'] ?? false;
            $observation->number_of_individuals = $validatedData['number_of_individuals'];
            $observation->notes = $validatedData['notes'];
            $observation->save();

            DB::table('departure_observations')
                ->where('observation_id', $id)
                ->update(['departure_id' => $validatedData['departure_id']]);

            $existingImageIds = array_column($existingImages, 'image_id');

            if (isset($validatedData['image_file'])) {
                foreach ($validatedData['image_file'] as $imageId => $file) {

                    $response = Http::withHeaders([
                        'Accept' => 'application/json',
                        'APP-TOKEN' => config('services.api.token'),
                    ])->attach(
                        'image', file_get_contents($file), $file->getClientOriginalName()
                    )->post(config('services.api.url') . "/api/V1/images/{$imageId}");

                    if (!$response->successful()) {
                        Log::error('Error updating image: ' . $response->body());
                        throw new \Exception('Error updating image.');
                    }
                }
            }

            if (isset($validatedData['image_file_new'])) {
                foreach ($validatedData['image_file_new'] as $index => $file) {

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
                            'observation_id' => $observation->id,
                            'user_id' => $validatedData['image_user_new'][$index],
                            'photography_number' => $validatedData['image_number_new'][$index],
                        ]);
                    } else {
                        Log::error('Error uploading new image: ' . $response->body());
                        throw new \Exception('Error uploading new image.');
                    }
                }
            }

            DB::commit();

            return redirect()->route('observations.index', ['language' => $language])->with('status', 'Observación actualizada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating observation: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al actualizar la observación: ' . $e->getMessage());
        }
    }

    public function deleteImage(Request $request, $language, $observationId)
    {

        $imageId = $request->input('image_id');

        DB::beginTransaction();

        try {

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'APP-TOKEN' => config('services.api.token'),
            ])->delete(config('services.api.url') . "/api/V1/images/{$imageId}");

            if ($response->successful()) {
                ImageObservation::where('image_id', $imageId)->where('observation_id', $observationId)->delete();
                DB::commit();

                return redirect()->route('observations.edit', ['language' => $language, 'observation' => $observationId])->with('status', 'Imagen eliminada correctamente.');
            } else {
                Log::error('Error deleting image: ' . $response->body());
                throw new \Exception('Error al eliminar la imagen.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting image: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al eliminar la imagen: ' . $e->getMessage());
        }
    }

    public function show($language = null, $id)
    {

        $observation = Observation::findOrFail($id);
        $departures = Departure::all();
        $species = Specie::all();

        $departureObservation = DB::table('departure_observations')
            ->where('observation_id', $observation->id)
            ->first();

        $departureId = $departureObservation ? $departureObservation->departure_id : null;

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

        $imageUrls = [];
        foreach ($observation->images as $image) {

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'APP-TOKEN' => config('services.api.token'),
            ])->get(config('services.api.url') . "/api/V1/images/{$image->image_id}");

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['optimized_images']) && is_array($data['optimized_images'])) {
                    $imageSet = [];
                    foreach ($data['optimized_images'] as $optimizedImage) {
                        if (isset($optimizedImage['version']) && isset($optimizedImage['url'])) {
                            $absoluteUrl = config('services.api.url') . $optimizedImage['url'];
                            $imageSet[$optimizedImage['version']] = $absoluteUrl;
                        }
                    }
                    if (!empty($imageSet)) {
                        $imageUrls[] = [
                            'user' => $image->user->name,
                            'images' => $imageSet
                        ];
                    }
                }
            } else {
                Log::error('Error fetching image from API: ' . $response->body());
            }
        }

        return view('pages.observationsPages.show', compact('observation', 'departures', 'species', 'imageUrls', 'departureId'));
    }

    public function destroy(Request $request, $language, $id)
    {

        try {
            $observation = Observation::find($id);

            if (!$observation) {
                Log::warning('No se encontró la observación con ID: ' . $id);
                return redirect()->back()->with('error', 'No se encontró la observación.');
            }

            $observation->deleteWithRelations();

            return redirect()->back()->with('status', 'La observación se ha eliminado con éxito.');
        } catch (\Exception $e) {
            Log::error('Error al intentar eliminar la observación: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
