<?php

namespace Database\Factories;

use App\Models\Transect;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransectFactory extends Factory
{
    protected $model = Transect::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
