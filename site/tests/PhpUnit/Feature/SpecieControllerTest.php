<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Specie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Log;

class SpecieControllerTest extends TestCase
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
     * Comprueba que la página de índice de especies se carga correctamente para un usuario autenticado.
     *
     * @return void
     */
    public function test_authenticated_user_can_view_species_index()
    {
        $language = 'ca';

        $response = $this->get("/$language/species");

        $response->assertStatus(200);
        $response->assertViewIs('pages.species');
    }

    /**
     * Comprueba que un usuario no autenticado es redirigido a la página de login cuando intenta acceder a la página de índice de especies.
     *
     * @return void
     */
    public function test_guest_is_redirected_to_login_when_viewing_species_index()
    {
        auth()->logout();
        $language = 'ca';

        $response = $this->get("/$language/species");

        $response->assertRedirect("/$language/login");
    }

    /**
     * Comprueba que un usuario autenticado puede crear una especie correctamente.
     *
     * @return void
     */
    public function test_authenticated_user_can_create_specie()
    {
        $data = [
            'common_name' => $this->faker->word,
            'scientific_name' => $this->faker->word,
            '_token' => csrf_token()
        ];

        $language = 'ca';

        $response = $this->post(route('species.store', ['language' => $language]), $data);

        $response->assertRedirect();
        $response->assertSessionHas('status', "L'espècie ha estat creada amb èxit a la base de dades.");

        $this->assertDatabaseHas('species', ['common_name' => $data['common_name']]);
    }

    /**
     * Comprueba que un usuario no autenticado no puede crear una especie.
     *
     * @return void
     */
    public function test_guest_cannot_create_specie()
    {
        auth()->logout();

        $data = [
            'common_name' => $this->faker->word,
            'scientific_name' => $this->faker->word,
            '_token' => csrf_token()
        ];

        $language = 'ca';

        $response = $this->post(route('species.store', ['language' => $language]), $data);

        $response->assertRedirect("/$language/login");
        $this->assertDatabaseMissing('species', ['common_name' => $data['common_name']]);
    }

    /**
     * Comprueba que un usuario autenticado puede actualizar una especie correctamente.
     *
     * @return void
     */
    public function test_authenticated_user_can_update_specie()
    {
        $specie = Specie::factory()->create();

        $data = [
            'common_name' => $this->faker->word,
            'scientific_name' => $this->faker->word,
            '_token' => csrf_token()
        ];

        $language = 'ca';

        $response = $this->put(route('species.update', ['language' => $language, 'species' => $specie->id]), $data);

        $response->assertRedirect();
        $response->assertSessionHas('status', "L'espècie ha estat actualitzada amb èxit a la base de dades.");
        $this->assertDatabaseHas('species', ['id' => $specie->id, 'common_name' => $data['common_name']]);
    }

    /**
     * Comprueba que un usuario no autenticado no puede actualizar una especie.
     *
     * @return void
     */
    public function test_guest_cannot_update_specie()
    {
        auth()->logout();

        $specie = Specie::factory()->create();

        $data = [
            'common_name' => $this->faker->word,
            'scientific_name' => $this->faker->word,
            '_token' => csrf_token()
        ];

        $language = 'ca';

        $response = $this->put(route('species.update', ['language' => $language, 'species' => $specie->id]), $data);

        $response->assertRedirect("/$language/login");
        $this->assertDatabaseMissing('species', ['species' => $specie->id, 'common_name' => $data['common_name']]);
    }
}
