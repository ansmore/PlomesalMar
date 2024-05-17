<?php

namespace App\Models;

use App\Models\Departure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transect extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function departure()
    {
        return $this->hasMany(Departure::class);
    }

    /**
     * Busca transectos basados en el término de búsqueda proporcionado.
     *
     * @param Builder $query
     * @param string|null $search Término de búsqueda
     * @return Builder
     */
    public function scopeSearch(Builder $query, $search): Builder
    {
        if (!empty($search)) {
            return $query->where('name', 'like', '%' . $search . '%');
        }
        return $query;
    }

    /**
     * Recupera transectos filtrados según los criterios de búsqueda y ordenación almacenados en la sesión.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getFilteredTransects(Request $request)
    {
        $orderByField = $request->input('orderByField', 'id');
        $orderByDirection = $request->input('orderByDirection', 'asc');

        $perPage = config('app.per_page');

        return static::search($request->search)
            ->orderBy($orderByField, $orderByDirection)
            ->paginate($perPage);
    }

    /**
     * Crea un nuevo transecto a partir de los datos proporcionados en la solicitud.
     *
     * @param Request $request
     * @return Transect
     */
    public static function createFromRequest(Request $request): Transect
    {
        $newTransect = self::create([
            'name' => $request->input('name'),
        ]);

        Log::info('Transect created from request:', [
            'name' => $newTransect->name,
        ]);

        return $newTransect;
    }

    /**
     * Actualiza un transecto existente con los datos proporcionados en la solicitud.
     *
     * @param Request $request
     * @param int $id Identificador del transecto a actualizar.
     * @return bool
     */
    public static function updateFromRequest(Request $request, $id): bool
    {
        $transect = self::find($id);
        if ($transect) {
            $transect->update($request->all());
            return true;
        }
        return false;
    }
}
