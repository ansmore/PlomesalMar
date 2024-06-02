<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Boat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class BoatControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    /**
     * Test to verify that the index view is loaded correctly.
     */
    public function test_index_view_is_loaded()
    {
        $language = 'ca';
        $response = $this->get("/$language/boats");

        $response->assertStatus(200);
        $response->assertViewIs('pages.boats');
        $response->assertViewHas('language', $language);
        $response->assertViewHas('boats');
    }

    /**
     * Test to verify that a boat can be stored correctly.
     */
    public function test_store_boat()
    {
        $language = 'ca';

        $data = [
            'name' => $this->faker->name,
            'registration_number' => $this->faker->bothify('??###')
        ];

        $response = $this->post(route('boats.store', ['language' => $language]), $data);

        $response->assertRedirect();
        $response->assertSessionHas('status', 'El vaixell ha estat creat amb èxit a la base de dades.');

        $this->assertDatabaseHas('boats', ['name' => $data['name'], 'registration_number' => $data['registration_number']]);
    }

    /**
     * Test to verify that a boat can be updated correctly.
     */
    public function test_update_boat()
    {
        $language = 'ca';

        $boat = Boat::factory()->create();

        $data = [
            'name' => 'Updated Boat Name',
            'registration_number' => 'AB123'
        ];

        $response = $this->put(route('boats.update', ['language' => $language, 'boat' => $boat->id]), $data);

        $response->assertRedirect();
        $response->assertSessionHas('status', 'El vaixell ha estat actualitzat amb èxit a la base de dades.');

        $this->assertDatabaseHas('boats', ['id' => $boat->id, 'name' => $data['name'], 'registration_number' => $data['registration_number']]);
    }
}
