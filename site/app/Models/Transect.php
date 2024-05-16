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
	 * Busca transectes basados en el término de búsqueda proporcionado.
	 *
	 * @param Builder $query
	 * @param string|null $search Término de búsqueda
	 * @return Builder
	 */
	public function scopeSearch(Builder $query, $search): Builder
	{
		if (!empty($search)) {
			return $query->where(function($query) use ($search) {
				$query->where('name', 'like', '%' . $search . '%');
			});
		}
		return $query;
	}

	/**
	 * Recupera tranectes filtrados según los criterios de búsqueda y ordenación almacenados en la sesión.
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

}
