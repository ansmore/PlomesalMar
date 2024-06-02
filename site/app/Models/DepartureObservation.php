<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartureObservation extends Model
{
    use HasFactory;

    protected $fillable = ['departure_id', 'observation_id'];

    public function departure()
    {
        return $this->belongsTo(Departure::class);
    }

    public function observation()
    {
        return $this->belongsTo(Observation::class);
    }
    
    public static function createRelations($departureId, $observationId)
    {
            self::create([
                'departure_id' => $departureId,
                'observation_id' => $observationId
            ]);
    }
}
