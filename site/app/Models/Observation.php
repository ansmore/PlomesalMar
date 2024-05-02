<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    use HasFactory;

    protected $fillable = [
        'waypoint',
        'specie_id',
        'number_of_individuals',
        'in_flight',
        'distance_under_300m',
        'notes',
    ];

    public function species()
    {
        return $this->belongsTo(Species::class);
    }
    
    public function observationImages(){
        return $this->hasMany(ObservationImage::class);
    }
}
