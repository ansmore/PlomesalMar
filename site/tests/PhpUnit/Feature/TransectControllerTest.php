<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Transect;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Log;

class TransectControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

	protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        // Crea un usuari i autèntica'l
       	$this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    /**
     * Comprova que la pàgina d'index de transectes es carrega correctament per a un usuari autenticat.
     *
     * Donat un usuari autenticat,
     * Quan accedeix a la ruta /transects,
     * Llavors hauria de veure la pàgina de transectes amb el codi d'estat 200.
     */
    public function test_authenticated_user_can_view_transects_index()
    {
		$language = 'ca';
        $response = $this->get("/$language/transects");

        $response->assertStatus(200);
        $response->assertViewIs('pages.transects');
    }

    /**
     * Comprova que un usuari no autenticat és redirigit a la pàgina de login quan intenta accedir a la pàgina d'index de transectes.
     *
     * Donat un usuari no autenticat,
     * Quan intenta accedir a la ruta /transects,
     * Llavors hauria de ser redirigit a la pàgina de login.
     */
    public function test_guest_is_redirected_to_login_when_viewing_transects_index()
    {
        auth()->logout();
		$language = 'ca';

		$response = $this->get("/$language/transects");

		$response->assertRedirect("/$language/login");
    }

    /**
     * Comprova que un transecte es crea correctament per un usuari autenticat.
     *
     * Donat un usuari autenticat,
     * Quan envia una petició POST a /transects amb dades vàlides,
     * Llavors el transecte hauria de ser creat i redirigit amb un missatge d'èxit.
     */
    public function test_authenticated_user_can_create_transect()
    {
		$user = User::factory()->create();
		$this->actingAs($user);

		$data = [
			'name' => $this->faker->word,
			'_token' => csrf_token()
		];

		$language = 'ca';

		$response = $this->post(route('transects.store', ['language' => $language]), $data);

		$response->assertRedirect();
		$response->assertSessionHas('status', 'El transecto ha sido creado exitosamente en la base de datos.');

		$this->assertDatabaseHas('transects', ['name' => $data['name']]);

	}

    // /**
    //  * Comprova que es produeix un error en intentar crear un transecte amb dades no vàlides.
    //  *
    //  * Donat un usuari autenticat,
    //  * Quan envia una petició POST a /transects amb dades no vàlides,
    //  * Llavors hauria de rebre errors de validació.
    //  */
    // public function test_authenticated_user_cannot_create_transect_with_invalid_data()
    // {
    //     $data = [
    //         'name' => '',
    //     ];

	// 	$language = 'ca';

    //     $response = $this->post(route('transects.store', ['language' => $language]), $data);

    //     $response->assertSessionHasErrors('name');
    // }

    // /**
    //  * Comprova que un transecte es pot actualitzar correctament per un usuari autenticat.
    //  *
    //  * Donat un usuari autenticat,
    //  * Quan envia una petició PUT a /transects/{id} amb dades vàlides,
    //  * Llavors el transecte hauria de ser actualitzat i redirigit amb un missatge d'èxit.
    //  */
    // public function test_authenticated_user_can_update_transect()
    // {
    //     $transect = Transect::factory()->create();
    //     $data = [
    //         'name' => $this->faker->word,
    //     ];

    //     $response = $this->put("/transects/{$transect->id}", $data);

    //     $response->assertRedirect();
    //     $response->assertSessionHas('status', 'El transecto ha sido actualizado exitosamente en la base de datos.');
    //     $this->assertDatabaseHas('transects', ['id' => $transect->id, 'name' => $data['name']]);
    // }

    // /**
    //  * Comprova que es produeix un error en intentar actualitzar un transecte amb dades no vàlides.
    //  *
    //  * Donat un usuari autenticat,
    //  * Quan envia una petició PUT a /transects/{id} amb dades no vàlides,
    //  * Llavors hauria de rebre errors de validació.
    //  */
    // public function test_authenticated_user_cannot_update_transect_with_invalid_data()
    // {
    //     $transect = Transect::factory()->create();
    //     $data = [
    //         'name' => '', // Nom invàlid
    //     ];

    //     $response = $this->put("/transects/{$transect->id}", $data);

    //     $response->assertSessionHasErrors('name');
    // }
}
