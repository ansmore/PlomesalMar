<?php

namespace App\Models;

use App\Models\User;
use App\Models\Observation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImageObservation extends Model
{
    use HasFactory;

    protected $table = "observation_image";

    protected $fillable = [
        'photography_number',
        'observation_id',
        'user_id',
        'image_id'
    ];

    public function observation()
    {
        return $this->belongsTo(Observation::class, 'observation_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getUrl($size = 'medium')
    {
        return config('services.api.url') . "/api/V1/optimized-images/{$this->image_id}/{$size}";
    }

    public function getUrlSmall()
    {
        return $this->getUrl('small');
    }

    public function getUrlMedium()
    {
        return $this->getUrl('medium');
    }

    public function getUrlLarge()
    {
        return $this->getUrl('large');
    }
}
