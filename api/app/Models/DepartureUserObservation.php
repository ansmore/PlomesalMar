<?php

namespace App\Models;

use App\Models\User;
use App\Models\Departure;
use App\Models\Observation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
