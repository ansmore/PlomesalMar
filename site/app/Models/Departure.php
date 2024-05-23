<?php

namespace App\Models;

use App\Models\Boat;
use App\Models\Transect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departure extends Model
{
    use HasFactory;

    protected $fillable = ['boat_id', 'transect_id', 'date'];

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
                    ->orWhere('date', 'like', '%' . $search . '%');
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

	/**
	 * Creem una sortida a partir de les dades proporcionades en la solicitut.
	 *
	 * @param Request $request
	 * @return Deperture
	 */
	public static function createFromRequest(Request $request): Departure
	{
		$newDeparture = self::create([
			'boat_id'=> $request->input('boat_id'),
			'transect_id'=> $request->input('transect_id'),
			'date'=> $request->input('date'),
		]);

		Log::info('Departure created from request:', [
			'boat_id' => $newDeparture->boat_id,
			'transect_id' => $newDeparture->transect_id,
			'date' => $newDeparture->date
		]);

		return $newDeparture;
	}

	/**
	 * Actualitzem una sortida a partir de les dades proporcionades en la solicitut.
	 *
	 * @param Request $request
	 * @param int $id Identificador de la sortida a actualizar.
	 * @return bool
	 */
	public static function updateFromRequest(Request $request, $id): bool
	{
		$departure = self::find($id);
		if($departure) {
			$departure->update($request->all());
			return true;
		}

		return false;
	}
}
