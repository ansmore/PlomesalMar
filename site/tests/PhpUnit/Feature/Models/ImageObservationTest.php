<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\ImageObservation;
use App\Models\Observation;
use App\Models\User;

class ImageObservationTest extends TestCase
{
    use RefreshDatabase;

    public function testImageObservationCreation(): void
    {
        $observation = Observation::factory()->create();
        $user = User::factory()->create();

        ImageObservation::factory()->create([
            'photography_number' => 1,
            'observation_id' => $observation->id,
            'user_id' => $user->id,
            'image_id' => 123
        ]);

        $this->assertDatabaseHas('observation_image', [
            'photography_number' => 1,
            'observation_id' => $observation->id,
            'user_id' => $user->id,
            'image_id' => 123
        ]);
    }

    public function testObservationRelation(): void
    {
        $observation = Observation::factory()->create();
        $imageObservation = ImageObservation::factory()->create([
            'observation_id' => $observation->id
        ]);

        $this->assertEquals($observation->id, $imageObservation->observation->id);
    }

    public function testUserRelation(): void
    {
        $user = User::factory()->create();
        $imageObservation = ImageObservation::factory()->create([
            'user_id' => $user->id
        ]);

        $this->assertEquals($user->id, $imageObservation->user->id);
    }

    public function testGetUrl(): void
    {
        $imageObservation = ImageObservation::factory()->create([
            'image_id' => 123
        ]);

        $baseUrl = config('services.api.url') . "/api/V1/optimized-images/123/";

        $this->assertEquals($baseUrl . 'medium', $imageObservation->getUrl('medium'));
        $this->assertEquals($baseUrl . 'small', $imageObservation->getUrl('small'));
        $this->assertEquals($baseUrl . 'large', $imageObservation->getUrl('large'));
    }

    public function testGetUrlSmall(): void
    {
        $imageObservation = ImageObservation::factory()->create([
            'image_id' => 123
        ]);

        $baseUrl = config('services.api.url') . "/api/V1/optimized-images/123/small";

        $this->assertEquals($baseUrl, $imageObservation->getUrlSmall());
    }

    public function testGetUrlMedium(): void
    {
        $imageObservation = ImageObservation::factory()->create([
            'image_id' => 123
        ]);

        $baseUrl = config('services.api.url') . "/api/V1/optimized-images/123/medium";

        $this->assertEquals($baseUrl, $imageObservation->getUrlMedium());
    }

    public function testGetUrlLarge(): void
    {
        $imageObservation = ImageObservation::factory()->create([
            'image_id' => 123
        ]);

        $baseUrl = config('services.api.url') . "/api/V1/optimized-images/123/large";

        $this->assertEquals($baseUrl, $imageObservation->getUrlLarge());
    }
}
