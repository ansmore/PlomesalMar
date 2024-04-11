<?php

namespace Database\Factories;

use App\Models\Transecte;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransecteFactory extends Factory
{
    protected $model = Transecte::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
