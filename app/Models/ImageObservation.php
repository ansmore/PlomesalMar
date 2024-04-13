<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageObservation extends Model
{
    use HasFactory;

	protected $table = "image_observation";

	protected $fillable = [
		'image_id',
		'observation_id'
	];

	public function images()
    {
        return $this->belongsTo(Image::class);
    }

    public function observations()
    {
        return $this->belongsTo(Observation::class);
    }
}
