<?php

namespace App\Models;

use App\Models\Departure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Boat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'registration_number',
    ];

    /**
     * Relación con Departures.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departures()
    {
        return $this->hasMany(Departure::class);
    }

    /**
     * Busca barcos basados en el término de búsqueda proporcionado.
     * 
     * @param Builder $query
     * @param string|null $search Término de búsqueda
     * @return Builder
     */
    public function scopeSearch(Builder $query, $search): Builder
    {
        if (!empty($search)) {
            return $query->where(function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('registration_number', 'like', '%' . $search . '%');
            });
        }
        return $query;
    }

    /**
     * Recupera barcos filtrados según los criterios de búsqueda y ordenación almacenados en la sesión.
     * 
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getFilteredBoats(Request $request)
    {
        $orderByField = $request->input('orderByField', 'id');
        $orderByDirection = $request->input('orderByDirection', 'asc');

        $perPage = config('app.per_page');

        return static::search($request->search)
                     ->orderBy($orderByField, $orderByDirection)
                     ->paginate($perPage);
    }

    /**
     * Crea un nuevo barco a partir de los datos proporcionados en la solicitud.
     * 
     * @param Request $request
     * @return Boat
     */
    public static function createFromRequest(Request $request): Boat
    {
        $newBoat = self::create([
            'name' => $request->input('name'),
            'registration_number' => $request->input('registration_number'),
        ]);

        Log::info('Boat created from request:', [
            'name' => $newBoat->name,
            'registration_number' => $newBoat->registration_number
        ]);

        return $newBoat;
    }

    /**
     * Actualiza un barco existente con los datos proporcionados en la solicitud.
     * 
     * @param Request $request
     * @param int $id Identificador del barco a actualizar.
     * @return bool
     */
    public static function updateFromRequest(Request $request, $id): bool
    {
        $boat = self::find($id);
        if ($boat) {
            $boat->update($request->all());
            return true;
        }
        return false;
    }

    /**
     * Elimina un barco basado en el ID proporcionado.
     * 
     * @param int $id El ID del barco a eliminar.
     * @return bool
     */
    public static function deleteById($id): bool
    {
        $boat = self::with('departures')->find($id);
        if ($boat) {
            if ($boat->departures->isNotEmpty()) {
                return false;
            }
            $boat->delete();
            return true;
        }
        return false;
    }

}
