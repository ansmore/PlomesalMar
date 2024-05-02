<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Observation;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ObservationImage>
 */
class ImageObservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $observation = Observation::query()->inRandomOrder()->first() ?? Observation::factory()->create();
        $user = User::query()->inRandomOrder()->first() ?? User::factory()->create();
        
        $photography_number = $this->faker->unique()->numberBetween(1000, 9999);

        return [
            'observation_id' => $observation->id,
            'user_id' => $user->id,
            'photography_number' => $photography_number
        ];
    }
}
