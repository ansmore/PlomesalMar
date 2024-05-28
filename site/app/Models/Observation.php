<?php

namespace App\Models;

use App\Models\Specie;
use Illuminate\Http\Request;
use App\Models\ImageObservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Observation extends Model
{
    use HasFactory;

    protected $fillable = [
        'waypoint',
        'specie_id',
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
     * Busca observaciones basadas en el término de búsqueda proporcionado.
     *
     * @param Builder $query
     * @param string|null $search Término de búsqueda
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
     * Recupera observaciones filtradas según los criterios de búsqueda y ordenación proporcionados en la solicitud.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getFilteredObservations(Request $request)
    {
        $orderByField = $request->input('orderByField', 'id');
        $orderByDirection = $request->input('orderByDirection', 'asc');
        $validated = $request->input('validated');
        $perPage = 6;
    
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
                    Log::error('Error al eliminar la imagen con ID: ' . $imageObservation->image_id . ': ' . $e->getMessage());
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
                throw new \Exception('Error al eliminar la imagen a través de la API');
            }
        } catch (\Exception $e) {
            Log::error('Error al eliminar la imagen: ' . $e->getMessage());
            throw $e;
        }
    }

    public function firstImage()
    {
        return $this->hasOne(ImageObservation::class, 'observation_id')->oldest();
    }
}
