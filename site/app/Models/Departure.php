<?php

namespace App\Models;

use App\Models\Boat;
use App\Models\Transect;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departure extends Model
{
    use HasFactory;

    protected $fillable = ['boat_id', 'transect_id', 'date', 'time'];

    public function boat()
    {
        return $this->belongsTo(Boat::class);
    }

    public function transect()
    {
        return $this->belongsTo(Transect::class);
    }

    /**
     * Busca salidas basadas en el término de búsqueda proporcionado.
     * 
     * @param Builder $query
     * @param string|null $search Término de búsqueda
     * @return Builder
     */
    public function scopeSearch(Builder $query, $search): Builder
    {
        if (!empty($search)) {
            return $query->where(function($query) use ($search) {
                $query->where('boat_id', '=', $search)
                    ->orWhere('transect_id', '=', $search)
                    ->orWhere('date', 'like', '%' . $search . '%')
                    ->orWhere('time', 'like', $search . '%');
            });
        }
        return $query;
    }

    /**
     * Recupera departures filtrados según los criterios de búsqueda y ordenación almacenados en la sesión.
     * 
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getFilteredDepartures(Request $request)
    {
        $orderByField = $request->input('orderByField', 'id');
        $orderByDirection = $request->input('orderByDirection', 'asc');
        $perPage = config('app.per_page');

        return static::with(['boat', 'transect'])
                    ->search($request->search)
                    ->orderBy($orderByField, $orderByDirection)
                    ->paginate($perPage);
    }

}
