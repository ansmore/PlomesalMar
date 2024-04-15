<?php

namespace App\Models;

use App\Models\Departure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Boat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'registration_number',
    ];

    public function departure()
    {
        return $this->hasMany(Departure::class);
    }
}
