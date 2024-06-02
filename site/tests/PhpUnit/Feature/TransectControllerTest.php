<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Transect;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransectControllerTest extends TestCase
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
     * Comprueba que la página de índice de transectos se carga correctamente para un usuario autenticado.
     *
     * Dado un usuario autenticado,
     * Cuando accede a la ruta /transects,
     * Entonces debería ver la página de transectos con el código de estado 200.
     */
    public function test_authenticated_user_can_view_transects_index()
    {
        $language = 'ca';
        $response = $this->get("/$language/transects");

        $response->assertStatus(200);
        $response->assertViewIs('pages.transects');
    }

    /**
     * Comprueba que un usuario no autenticado es redirigido a la página de login cuando intenta acceder a la página de índice de transectos.
     *
     * Dado un usuario no autenticado,
     * Cuando intenta acceder a la ruta /transects,
     * Entonces debería ser redirigido a la página de login.
     */
    public function test_guest_is_redirected_to_login_when_viewing_transects_index()
    {
        auth()->logout();
        $language = 'ca';

        $response = $this->get("/$language/transects");

        $response->assertRedirect("/$language/login");
    }

    /**
     * Comprueba que un transecto se crea correctamente por un usuario autenticado.
     *
     * Dado un usuario autenticado,
     * Cuando envía una petición POST a /transects con datos válidos,
     * Entonces el transecto debería ser creado y redirigido con un mensaje de éxito.
     */
    public function test_authenticated_user_can_create_transect()
    {
        $data = [
            'name' => $this->faker->word,
            '_token' => csrf_token()
        ];

        $language = 'ca';

        $response = $this->post(route('transects.store', ['language' => $language]), $data);

        $response->assertRedirect();
        $response->assertSessionHas('status', 'El transsecte ha estat creat amb èxit a la base de dades.');

        $this->assertDatabaseHas('transects', ['name' => $data['name']]);
    }

    /**
     * Comprueba que se produce un error al intentar crear un transecto con datos no válidos.
     *
     * Dado un usuario autenticado,
     * Cuando envía una petición POST a /transects con datos no válidos,
     * Entonces debería recibir errores de validación.
     */
    public function test_authenticated_user_cannot_create_transect_with_invalid_data()
    {
        $data = [
            'name' => '',
        ];

        $language = 'ca';

        $response = $this->post(route('transects.store', ['language' => $language]), $data);

        $response->assertSessionHasErrors('name');
    }

    /**
     * Comprueba que un transecto se puede actualizar correctamente por un usuario autenticado.
     *
     * Dado un usuario autenticado,
     * Cuando envía una petición PUT a /transects/{id} con datos válidos,
     * Entonces el transecto debería ser actualizado y redirigido con un mensaje de éxito.
     */
    public function test_authenticated_user_can_update_transect()
    {
        $transect = Transect::factory()->create();
        $data = [
            'name' => $this->faker->word,
        ];

        $language = 'ca';

        $response = $this->put(route('transects.update', ['language' => $language, 'transect' => $transect->id]), $data);

        $response->assertRedirect();
        $response->assertSessionHas('status', 'El transsecte ha estat actualitzat amb èxit a la base de dades.');
        $this->assertDatabaseHas('transects', ['id' => $transect->id, 'name' => $data['name']]);
    }

    /**
     * Comprueba que se produce un error al intentar actualizar un transecto con datos no válidos.
     *
     * Dado un usuario autenticado,
     * Cuando envía una petición PUT a /transects/{id} con datos no válidos,
     * Entonces debería recibir errores de validación.
     */
    public function test_authenticated_user_cannot_update_transect_with_invalid_data()
    {
        $transect = Transect::factory()->create();
        $data = [
            'name' => '',
        ];

        $language = 'ca';

        $response = $this->put(route('transects.update', ['language' => $language, 'transect' => $transect->id]), $data);

        $response->assertSessionHasErrors('name');
    }
}
