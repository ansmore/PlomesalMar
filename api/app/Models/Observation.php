<?php

namespace App\Models;

use App\Models\Specie;
use App\Models\ImageObservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        return $this->belongsTo(Specie::class);
    }
    
    public function observationImages(){
        return $this->hasMany(ImageObservation::class);
    }
}
