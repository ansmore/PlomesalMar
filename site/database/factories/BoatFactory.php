<?php

namespace Database\Factories;

use App\Models\Boat;
use Illuminate\Database\Eloquent\Factories\Factory;

class BoatFactory extends Factory
{
    protected $model = Boat::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'registration_number' => $this->faker->regexify('[A-Z0-9]{5}')
        ];
    }
}
