<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Specie extends Model
{
    use HasFactory;

    protected $fillable = ['scientific_name', 'common_name'];

    public function observations()
    {
        return $this->hasMany(Observation::class, 'species_id');
    }

    /**
     * Busca especies basadas en el término de búsqueda proporcionado.
     *
     * @param Builder $query
     * @param string|null $search Término de búsqueda
     * @return Builder
     */
    public function scopeSearch(Builder $query, $search): Builder
    {
        if (!empty($search)) {
            return $query->where('common_name', 'like', '%' . $search . '%')
				->orWhere('scientific_name', 'like', '%' . $search . '%');
        }
        return $query;
    }

    /**
     * Recupera especies filtradas según los criterios de búsqueda y ordenación almacenados en la sesión.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getFilteredSpecies(Request $request)
    {
        $orderByField = $request->input('orderByField', 'id');
        $orderByDirection = $request->input('orderByDirection', 'asc');

        $perPage = config('app.per_page');

        return static::search($request->search)
                    ->orderBy($orderByField, $orderByDirection)
                    ->paginate($perPage);
    }

    /**
     * Crea una nueva especie a partir de los datos proporcionados en la solicitud.
     *
     * @param Request $request
     * @return Specie
     */
    public static function createFromRequest(Request $request): Specie
    {
        $newSpecie = self::create([
            'common_name' => $request->input('common_name'),
            'scientific_name' => $request->input('scientific_name'),
        ]);

        Log::info('Specie created from request:', [
            'common_name' => $newSpecie->common_name,
            'scientific_name' => $newSpecie->scientific_name
        ]);

        return $newSpecie;
    }

    /**
     * Actualiza una especie existente con los datos proporcionados en la solicitud.
     *
     * @param Request $request
     * @param int $id Identificador de la especie a actualizar.
     * @return bool
     */
    public static function updateFromRequest(Request $request, $id): bool
    {
        $species = self::find($id);
        if ($species) {
            $species->update($request->all());
            return true;
        }
        return false;
    }
}
