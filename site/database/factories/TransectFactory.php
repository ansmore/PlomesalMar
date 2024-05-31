<?php

namespace Database\Factories;

use App\Models\Transect;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transect>
 */
class TransectFactory extends Factory
{
    protected $model = Transect::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
