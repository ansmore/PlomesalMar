<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Boat;
use App\Models\Transect;
use App\Models\Departure;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class DepartureControllerTest extends TestCase
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
        $response = $this->get("/$language/departures");

        $response->assertStatus(200);
        $response->assertViewIs('pages.departures');
        $response->assertViewHas('language', $language);
        $response->assertViewHas('departures');
        $response->assertViewHas('boats');
        $response->assertViewHas('transects');
        $response->assertViewHas('users');
    }

    /**
     * Test to verify that a departure can be stored correctly.
     */
    public function test_store_departure()
    {
        $language = 'ca';

        $boat = Boat::factory()->create();
        $transect = Transect::factory()->create();
        $users = User::factory()->count(3)->create();

        $data = [
            'boat_id' => $boat->id,
            'transect_id' => $transect->id,
            'date' => $this->faker->date(),
            'users' => $users->pluck('id')->toArray(),
        ];

        $response = $this->post(route('departures.store', ['language' => $language]), $data);

        $response->assertRedirect();
        $response->assertSessionHas('status', "La sortida s'ha creat amb èxit.");

        $this->assertDatabaseHas('departures', [
            'boat_id' => $data['boat_id'],
            'transect_id' => $data['transect_id'],
            'date' => $data['date'],
        ]);
    }

    /**
     * Test to verify that a departure can be updated correctly.
     */
    public function test_update_departure()
    {
        $language = 'ca';

        $departure = Departure::factory()->create();
        $boat = Boat::factory()->create();
        $transect = Transect::factory()->create();
        $users = User::factory()->count(3)->create();

        $data = [
            'boat_id' => $boat->id,
            'transect_id' => $transect->id,
            'date' => $this->faker->date(),
            'users' => $users->pluck('id')->toArray(),
        ];

        $response = $this->put(route('departures.update', ['language' => $language, 'departure' => $departure->id]), $data);

        $response->assertRedirect();
        $response->assertSessionHas('status', "La sortida s'ha actualitzat amb èxit.");

        $this->assertDatabaseHas('departures', [
            'id' => $departure->id,
            'boat_id' => $data['boat_id'],
            'transect_id' => $data['transect_id'],
            'date' => $data['date'],
        ]);
    }

    /**
     * Test to verify that a departure can be destroyed correctly.
     */
    public function test_destroy_departure()
    {
        $language = 'ca';

        $departure = Departure::factory()->create();

        $response = $this->delete(route('departures.destroy', ['language' => $language, 'departure' => $departure->id]));

        $response->assertRedirect();
        $response->assertSessionHas('status', 'La sortida s\'ha eliminat amb èxit.');

        $this->assertDatabaseMissing('departures', ['id' => $departure->id]);
    }
}
