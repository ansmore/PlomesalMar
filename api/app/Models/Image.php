<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

	protected $fillable = [
        'photography_number',
    ];

	public function observations()
    {
        return $this->belongsToMany(Observation::class, 'image_observation', 'image_id', 'observation_id');
    }

}
