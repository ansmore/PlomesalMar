<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Specie extends Model
{
    use HasFactory;

    protected $fillable = [
        'scientific_name',
        'common_name',
    ];

    /**
     * Define el ámbito de la consulta para incluir solo especies que coincidan con el término de búsqueda.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string|null  $search Término de búsqueda
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $search): Builder
    {
        if (empty($search)) {
            return $query;
        }

        return $query->where('common_name', 'like', '%' . $search . '%')
                     ->orWhere('scientific_name', 'like', '%' . $search . '%');
    }

    /**
     * Obtiene las especies basadas en los parámetros de la solicitud (consulta de búsqueda, campo y dirección de ordenación).
     *
     * @param \Illuminate\Http\Request $request
     * @return LengthAwarePaginator
     */
    public static function getSpeciesBasedOnRequest(Request $request)
    {
        $search = $request->search;
        $orderByField = $request->input('orderByField', 'id');
        $orderByDirection = $request->input('orderByDirection', 'asc');

        return static::search($search)
            ->orderBy($orderByField, $orderByDirection)
            ->paginate(8);
    }

    /**
     * Crea una nueva especie a partir de los datos proporcionados en la solicitud.
     *
     * @param Illuminate\Http\Request $request
     * @return Specie
     */
    public static function createFromRequest(Request $request): Specie
    {
        $newSpecie = self::create([
            'common_name' => $request->input('nombre_comun'),
            'scientific_name' => $request->input('nombre_cientifico'),
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
     * @param Illuminate\Http\Request $request
     * @param int $id Identificador de la especie a actualizar.
     * @return bool
     */
    public static function updateFromRequest(Request $request, $id): bool
    {
        $species = self::find($id);

        if (!$species) {
            return false;
        }

        $species->common_name = $request->input('nombre_comun');
        $species->scientific_name = $request->input('nombre_cientifico');
        return $species->save();
    }

    /**
     * Elimina una especie basada en el ID proporcionado.
     *
     * @param int $id El ID de la especie a eliminar.
     */
    public static function deleteById($id)
    {
        Log::info('ID recibido en el modelo para eliminación:', ['id' => $id]);

        $species = self::find($id);

        if ($species) {
            Log::info('Especie encontrada y eliminada:', ['id' => $id]);
            $species->delete();
        } else {
            Log::info('Especie no encontrada para eliminar:', ['id' => $id]);
        }
    }
}
