<?php

namespace Database\Factories;

use App\Models\Specie;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecieFactory extends Factory
{
    protected $model = Specie::class;

    public function definition()
    {
        return [
            'scientific_name' => $this->faker->word,
            'common_name' => $this->faker->word,
        ];
    }
}
