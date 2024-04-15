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
}
