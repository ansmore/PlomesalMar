<?php

namespace App\Models;

use App\Models\Specie;
use Illuminate\Http\Request;
use App\Models\ImageObservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Observation extends Model
{
    use HasFactory;

    protected $fillable = [
        'waypoint',
        'species_id',
        'time',
        'number_of_individuals',
        'in_flight',
        'distance_under_300m',
        'notes',
        'is_validated'
    ];

    public function species()
    {
        return $this->belongsTo(Specie::class);
    }
    
    public function images()
    {
        return $this->hasMany(ImageObservation::class, 'observation_id');
    }

    public function departure()
    {
        return $this->belongsToMany(Departure::class, 'departure_observations', 'observation_id', 'departure_id');
    }

    public static function getSpeciesDataByYear($speciesId, $year)
    {
        return DB::table('observations')
            ->join('departure_observations', 'observations.id', '=', 'departure_observations.observation_id')
            ->join('departures', 'departure_observations.departure_id', '=', 'departures.id')
            ->select(DB::raw('MONTH(departures.date) as month'), DB::raw('SUM(observations.number_of_individuals) as total'))
            ->whereYear('departures.date', $year)
            ->where('observations.species_id', $speciesId)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');
    }

    public static function getYears()
    {
        return DB::table('departures')
            ->select(DB::raw('YEAR(date) as year'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
    }

    /**
     * Busca observacions basades en el terme de cerca proporcionat.
     *
     * @param Builder $query
     * @param string|null $search Terme de cerca
     * @return Builder
     */
    public function scopeSearch(Builder $query, $search): Builder
    {
        if (!empty($search)) {
            return $query->where('time', 'like', '%' . $search . '%')
				->orWhere('waypoint', 'like', '%' . $search . '%')
                ->orWhere('number_of_individuals')
                ->orWhere('in_flight')
                ->orWhere('distance_under_300m')
                ->orWhere('notes', 'like', '%' . $search . '%');
        }
        return $query;
    }

    /**
     * Recupera observacions filtrades segons els criteris de cerca i ordenació proporcionats en la sol·licitud.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getFilteredObservations(Request $request)
    {
        $orderByField = $request->input('orderByField', 'id');
        $orderByDirection = $request->input('orderByDirection', 'asc');
        $validated = $request->input('validated');
        $perPage = 5;
    
        $query = self::query();
    
        if ($request->filled('search')) {
            $query->search($request->search);
        }
    
        if ($validated === 'null') {
            $query->whereNull('is_validated');
        }
    
        return $query->orderBy($orderByField, $orderByDirection)->paginate($perPage);
    }    

    public static function createObservation(array $data)
    {

        $observationId = DB::table('observations')->insertGetId([
            'species_id' => $data['species_id'],
            'time' => $data['time'],
            'waypoint' => $data['waypoint'],
            'number_of_individuals' => $data['number_of_individuals'],
            'in_flight' => $data['in_flight'] ?? false,
            'distance_under_300m' => $data['distance_under_300m'] ?? false,
            'notes' => $data['notes'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $observationId;
    }

    public function deleteWithRelations()
    {
        $images = $this->images()->get();
        if ($images->isEmpty()) {
        } else {
            foreach ($images as $imageObservation) {
                try {
                    $this->deleteImageFromApi($imageObservation->image_id);
                } catch (\Exception $e) {
                    Log::error('Error en eliminar la imatge amb ID: ' . $imageObservation->image_id . ': ' . $e->getMessage());
                }
                $imageObservation->delete();
            }
        }

        DB::table('departure_observations')->where('observation_id', $this->id)->delete();

        $this->delete();
    }

    protected function deleteImageFromApi($imageId)
    {
        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'APP-TOKEN' => config('services.api.token'),
            ])->delete(config('services.api.url') . "/api/V1/images/{$imageId}");

            if (!$response->successful()) {
                throw new \Exception('Error en eliminar la imatge a través de l\'API');
            }
        } catch (\Exception $e) {
            Log::error('Error en eliminar la imatge: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getImageUrls()
    {
        $imageUrls = [];
        foreach ($this->images as $image) {
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
                Log::error('Error en obtenir la imatge de l\'API: ' . $response->body());
            }
        }
        return $imageUrls;
    }

    public function updateObservation(array $data)
    {
        $this->time = $data['time'];
        $this->species_id = $data['species_id'];
        $this->waypoint = $data['waypoint'];
        $this->in_flight = $data['in_flight'] ?? false;
        $this->distance_under_300m = $data['distance_under_300m'] ?? false;
        $this->is_validated = $data['is_validated'] ?? false;
        $this->number_of_individuals = $data['number_of_individuals'];
        $this->notes = $data['notes'];
        $this->save();

        DB::table('departure_observations')
            ->where('observation_id', $this->id)
            ->update(['departure_id' => $data['departure_id']]);
    }

    public function updateImages(array $imageFiles)
    {
        foreach ($imageFiles as $imageId => $file) {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'APP-TOKEN' => config('services.api.token'),
            ])->attach(
                'image', file_get_contents($file), $file->getClientOriginalName()
            )->post(config('services.api.url') . "/api/V1/images/{$imageId}");

            if (!$response->successful()) {
                Log::error('Error en actualitzar la imatge: ' . $response->body());
                throw new \Exception('Error en actualitzar la imatge.');
            }
        }
    }

    public function addNewImages(array $newImageFiles, array $newImageUsers, array $newImageNumbers)
    {
        foreach ($newImageFiles as $index => $file) {
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
                    'observation_id' => $this->id,
                    'user_id' => $newImageUsers[$index],
                    'photography_number' => $newImageNumbers[$index],
                ]);
            } else {
                Log::error('Error en pujar una nova imatge: ' . $response->body());
                throw new \Exception('Error en pujar una nova imatge.');
            }
        }
    }

    public function deleteImage($imageId)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'APP-TOKEN' => config('services.api.token'),
        ])->delete(config('services.api.url') . "/api/V1/images/{$imageId}");

        if ($response->successful()) {
            ImageObservation::where('image_id', $imageId)->where('observation_id', $this->id)->delete();
        } else {
            Log::error('Error en eliminar la imatge: ' . $response->body());
            throw new \Exception('Error en eliminar la imatge.');
        }
    }

    public function getDepartureObservation()
    {
        return DB::table('departure_observations')
            ->where('observation_id', $this->id)
            ->first();
    }

    public function getObserverUsers($departure)
    {
        if (is_string($departure->observers)) {
            $observerNames = explode(',', $departure->observers);
        } else {
            $observerNames = $departure->observers;
        }

        $observerNames = array_map('trim', $observerNames);
        return User::whereIn('name', $observerNames)->get(['id', 'name']);
    }

    public function firstImage()
    {
        return $this->hasOne(ImageObservation::class, 'observation_id')->oldest();
    }
}
