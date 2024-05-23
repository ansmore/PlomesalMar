<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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
    ];

    public function species()
    {
        return $this->belongsTo(Species::class);
    }
    
    public function observationImages(){
        return $this->hasMany(ObservationImage::class);
    }

    public static function getSpeciesDataByYear($speciesId, $year)
    {
        return DB::table('observations')
            ->join('departure_user_observations', 'observations.id', '=', 'departure_user_observations.observation_id')
            ->join('departures', 'departure_user_observations.departure_id', '=', 'departures.id')
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
                -orWhere('notes');
        }
        return $query;
    }

    /**
     * Recupera especies filtradas según los criterios de búsqueda y ordenación almacenados en la sesión.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getFilteredObservations(Request $request)
    {
        $orderByField = $request->input('orderByField', 'id');
        $orderByDirection = $request->input('orderByDirection', 'asc');

        $perPage = config('app.per_page');

        return static::search($request->search)
                    ->orderBy($orderByField, $orderByDirection)
                    ->paginate($perPage);
    }

    public static function createObservation(array $data)
    {
        return DB::table('observations')->insertGetId([
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
    }
}