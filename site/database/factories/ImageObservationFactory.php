<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Observation;
use App\Models\User;
use GuzzleHttp\Client;

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
        $client = new Client();

        $response = $client->request('POST', config('services.api.url').'/api/V1/images', [
            'headers' => [
                'Accept' => 'application/json',
                'APP-TOKEN' => config('services.api.token'),
            ],
            'multipart' => [
                [
                    'name'     => 'image',
                    'contents' => fopen(public_path('img/default.jpg'), 'r'),
                ],
            ],
        ]);

        $data = json_decode($response->getBody()->getContents(), true);
        $imageId = $data['imageId'];

        $observation = Observation::query()->inRandomOrder()->first() ?? Observation::factory()->create();
        $user = User::query()->inRandomOrder()->first() ?? User::factory()->create();
        
        $photography_number = $this->faker->unique()->numberBetween(1000, 9999);

        return [
            'observation_id' => $observation->id,
            'user_id' => $user->id,
            'photography_number' => $photography_number,
            'image_id' => $imageId,
        ];
    }
}
