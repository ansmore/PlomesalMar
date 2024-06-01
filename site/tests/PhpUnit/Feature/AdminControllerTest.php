<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Log;

class AdminControllerTest extends TestCase
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
     * Comprova que la pàgina d'index d'usuaris es carrega correctament per a un usuari autenticat amb el rol d'administrador.
     *
     * @return void
     */
    public function test_authenticated_admin_user_can_view_users_management_index()
    {
        $language = 'ca';

        $this->user = User::factory()->create();
        $role = Role::factory()->create(['role' => 'admin']);
        $this->user->roles()->attach($role);

        $this->actingAs($this->user);

        $response = $this->get("/$language/admin/users");

        $response->assertStatus(200);
        $response->assertViewIs('admin.users.list');
    }

    /**
     * Comprova que un usuari no autenticat és redirigit a la pàgina de login quan intenta accedir a la pàgina d'index d'usuaris.
     *
     * @return void
     */
    public function test_guest_is_redirected_to_login_when_viewing_users_management_index()
    {
        auth()->logout();
        $language = 'ca';

        $response = $this->get("/$language/admin/management");

        $response->assertRedirect("/$language/login");
    }

    /**
     * Comprova que un usuari autenticat amb el rol d'administrador pot crear un usuari correctament.
     *
     * @return void
     */
    public function test_authenticated_admin_user_can_create_user()
    {
        $this->user = User::factory()->create();
        $role = Role::factory()->create(['role' => 'admin']);
        $this->user->roles()->attach($role);

        $this->actingAs($this->user);

        $data = [
            'name' => $this->faker->name,
            'surname' => $this->faker->lastName,
            'surnameSecond' => $this->faker->lastName,
            'email' => $this->faker->safeEmail,
            'password' => 'password123',
            '_token' => csrf_token()
        ];

        $language = 'ca';

        $response = $this->post(route('admin.user.store', ['language' => $language]), $data);

        $response->assertRedirect();
        $response->assertSessionHas('status', "L'usuari ha estat creat correctament a la base de dades.");

        $this->assertDatabaseHas('users', ['email' => $data['email']]);
    }

    /**
     * Comprova que un usuari autenticat sense el rol d'administrador no pot crear un usuari.
     *
     * @return void
     */
    public function test_authenticated_non_admin_user_cannot_create_user()
    {
        $data = [
            'name' => $this->faker->name,
            'surname' => $this->faker->lastName,
            'surnameSecond' => $this->faker->lastName,
            'email' => $this->faker->safeEmail,
            'password' => 'password123',
            '_token' => csrf_token()
        ];

        $language = 'ca';

        $this->post(route('admin.user.store', ['language' => $language]), $data);
        $this->assertDatabaseMissing('users', ['email' => $data['email']]);
    }

    /**
     * Comprova que un usuari no autenticat no pot crear un usuari.
     *
     * @return void
     */
    public function test_guest_cannot_create_user()
    {
        auth()->logout();

        $data = [
            'name' => $this->faker->name,
            'surname' => $this->faker->lastName,
            'surnameSecond' => $this->faker->lastName,
            'email' => $this->faker->safeEmail,
            'password' => 'password123',
            '_token' => csrf_token()
        ];

        $language = 'ca';

        $response = $this->post(route('admin.user.store', ['language' => $language]), $data);

        $response->assertRedirect("/$language/login");
        $this->assertDatabaseMissing('users', ['email' => $data['email']]);
    }

    /**
     * Comprova que un usuari autenticat amb el rol d'administrador pot actualitzar un usuari correctament.
     *
     * @return void
     */
    public function test_authenticated_admin_user_can_update_user()
    {
        $this->user = User::factory()->create();
        $role = Role::factory()->create(['role' => 'admin']);
        $this->user->roles()->attach($role);

        $this->actingAs($this->user);

        $user = User::factory()->create();
        $data = [
            'name' => $this->faker->name,
            'surname' => $this->faker->lastName,
            'surnameSecond' => $this->faker->lastName,
            'email' => $this->faker->safeEmail,
        ];

        $language = 'ca';

        $response = $this->put(route('admin.user.update', ['user' => $user->id, 'language' => $language]), $data);

        $response->assertRedirect();
        $response->assertSessionHas('status', "L'usuari ha estat actualitzat correctament a la base de dades.");
        $this->assertDatabaseHas('users', ['id' => $user->id, 'email' => $data['email']]);
    }

    /**
     * Comprova que un usuari autenticat sense el rol d'administrador no pot actualitzar un usuari.
     *
     * @return void
     */
    public function test_authenticated_non_admin_user_cannot_update_user()
    {
        $user = User::factory()->create();
        $data = [
            'name' => $this->faker->name,
            'surname' => $this->faker->lastName,
            'surnameSecond' => $this->faker->lastName,
            'email' => $this->faker->safeEmail,
        ];

        $language = 'ca';

        $this->put(route('admin.user.update', ['user' => $user->id, 'language' => $language]), $data);
        $this->assertDatabaseMissing('users', ['id' => $user->id, 'email' => $data['email']]);
    }

    /**
     * Comprova que un usuari no autenticat no pot actualitzar un usuari.
     *
     * @return void
     */
    public function test_guest_cannot_update_user()
    {
        auth()->logout();

        $user = User::factory()->create();
        $data = [
            'name' => $this->faker->name,
            'surname' => $this->faker->lastName,
            'surnameSecond' => $this->faker->lastName,
            'email' => $this->faker->safeEmail,
        ];

        $language = 'ca';

        $response = $this->put(route('admin.user.update', ['user' => $user->id, 'language' => $language]), $data);

        $response->assertRedirect("/$language/login");
        $this->assertDatabaseMissing('users', ['id' => $user->id, 'email' => $data['email']]);
    }
}
