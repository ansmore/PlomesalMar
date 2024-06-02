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

    protected $fillable = ['boat_id', 'transect_id', 'date', 'observers'];

    public function boat()
    {
        return $this->belongsTo(Boat::class);
    }

    public function transect()
    {
        return $this->belongsTo(Transect::class);
    }

    public function observations()
    {
        return $this->belongsToMany(Observation::class, 'departure_observations', 'departure_id', 'observation_id');
    }

    /**
     * Busca sortides basades en el terme de cerca proporcionat.
     *
     * @param Builder $query
     * @param string|null $search Terme de cerca
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
     * Recupera sortides filtrades segons els criteris de cerca i ordenació emmagatzemats a la sessió.
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
     * Crea una sortida si no existeix.
     *
     * @param array $data
     * @return Departure|null
     */
    public static function createIfNotExists(array $data)
    {
        $existingDeparture = self::where('boat_id', $data['boat_id'])
            ->where('transect_id', $data['transect_id'])
            ->where('date', $data['date'])
            ->first();

        if ($existingDeparture) {
            return null;
        }

        $userNames = User::whereIn('id', $data['users'] ?? [])->pluck('name')->toArray();
        $observers = implode(', ', $userNames);

        return self::create([
            'boat_id' => $data['boat_id'],
            'transect_id' => $data['transect_id'],
            'date' => $data['date'],
            'observers' => $observers
        ]);
    }

    /**
     * Actualitza una sortida a partir de les dades proporcionades a la sol·licitud.
     *
     * @param Request $request
     * @param int $id Identificador de la sortida a actualitzar.
     * @return bool
     */
    public static function updateFromRequest(Request $request, $id): bool
    {
        $departure = self::find($id);
        if ($departure) {
            $userNames = $request->has('users') ? User::whereIn('id', $request->input('users'))->pluck('name')->toArray() : [];
            $observers = implode(', ', $userNames);
    
            $departure->boat_id = $request->input('boat_id');
            $departure->transect_id = $request->input('transect_id');
            $departure->date = $request->input('date');
            $departure->observers = $observers;
    
            $departure->save();
            return true;
        }
    
        return false;
    }    

    public function deleteIfNoObservations()
    {
        if ($this->observations()->count() > 0) {
            throw new \Exception('No es pot eliminar la sortida perquè té observacions relacionades.');
        }

        return $this->delete();
    }

    public function getObserverUsers()
    {
        if (is_string($this->observers)) {
            $observerNames = explode(',', $this->observers);
        } else {
            $observerNames = $this->observers;
        }

        $observerNames = array_map('trim', $observerNames);
        return User::whereIn('name', $observerNames)->get(['id', 'name']);
    }

    public function getObserversAttribute($value)
    {
        return explode(',', $value);
    }
}
