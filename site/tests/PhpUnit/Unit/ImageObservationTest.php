<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Observation;
use App\Models\ImageObservation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImageObservationTest extends TestCase
{
    use RefreshDatabase;

    public function test_image_observation_belongs_to_observation()
    {
        $observation = Observation::factory()->create();
        $imageObservation = ImageObservation::factory()->create(['observation_id' => $observation->id]);

        $this->assertEquals($observation->id, $imageObservation->observation->id);
    }

    public function test_image_observation_belongs_to_user()
    {
        $user = User::factory()->create();
        $imageObservation = ImageObservation::factory()->create(['user_id' => $user->id]);

        $this->assertEquals($user->id, $imageObservation->user->id);
    }
}
