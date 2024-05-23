<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartureUserObservation extends Model
{
    use HasFactory;

    protected $fillable = ['departure_id', 'user_id', 'observation_id', 'is_observer'];

    public function departure()
    {
        return $this->belongsTo(Departure::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function observation()
    {
        return $this->belongsTo(Observation::class);
    }
    
    public static function createRelations($departureId, $observationId, $userIds, $allUsers)
    {
        foreach ($allUsers as $user) {
            self::create([
                'departure_id' => $departureId,
                'user_id' => $user->id,
                'observation_id' => $observationId,
                'is_observer' => in_array($user->id, $userIds),
            ]);
        }
    }
}
