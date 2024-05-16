<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
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
        return $this->belongsTo(Species::class);
    }
    
    public function observationImages(){
        return $this->hasMany(ObservationImage::class);
    }

    public static function getSpeciesDataByYear($speciesId, $year)
    {
        return DB::table('observations')
            ->join('departure_user_observations', 'observations.id', '=', 'departure_user_observations.observation_id')
            ->join('departures', 'departure_user_observations.departure_id', '=', 'departures.id')
            ->select(DB::raw('MONTH(departures.date) as month'), DB::raw('SUM(observations.number_of_individuals) as total'))
            ->whereYear('departures.date', $year)
            ->where('observations.species_id', $speciesId)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');
    }

    public static function getYears()
    {
        return DB::table('departures')
            ->select(DB::raw('YEAR(date) as year'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
    }
}
