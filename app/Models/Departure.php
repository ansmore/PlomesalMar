<?php

namespace App\Models;

use App\Models\Boat;
use App\Models\Transect;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departure extends Model
{
    use HasFactory;

    protected $fillable = ['boat_id', 'transect_id', 'date', 'time'];

    public function boat()
    {
        return $this->belongsTo(Boat::class);
    }

    public function transect()
    {
        return $this->belongsTo(Transect::class);
    }
}
