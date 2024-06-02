<?php

namespace Database\Factories;

use App\Models\Departure;
use App\Models\Boat;
use App\Models\Transect;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartureFactory extends Factory
{
    protected $model = Departure::class;

    public function definition()
    {
        return [
            'boat_id' => Boat::factory(),
            'transect_id' => Transect::factory(),
            'date' => $this->faker->date(),
            'observers' => $this->faker->name,
        ];
    }
}
