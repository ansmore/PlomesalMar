<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthRouteTest extends TestCase
{
	/**
     * Comprova que l'accés a /login redirigeix correctament a /idioma/login.
     *
     * Donat un usuari no autenticat,
     * Quan intenta accedir a la ruta /login,
     * Llavors hauria de ser redirigit a /idioma/login.
     */
    public function test_login_redirects_to_localized_login()
    {
        $response = $this->get('/login');
        $locale = app()->getLocale(); // Obté l'idioma de l'aplicació

        // Comprova que la redirecció va a la versió localitzada de la pàgina de login
        $response->assertRedirect("/$locale/login");
    }

	/**
     * Comprova que els usuaris no autenticats són redirigits primer a /login i després a /ca/login quan intenten accedir a /ca/home.
     *
     * Donat un usuari no autenticat,
     * Quan intenta accedir a la ruta /ca/home,
     * Llavors inicialment hauria de ser redirigit a /login,
     * I després immediatament redirigit a /ca/login.
     */
    public function test_home_redirects_non_authenticated_user_to_login()
    {
        $language = 'ca'; // Idioma d'exemple
		$response = $this->get("/$language/home");
		$response->assertRedirect('/login');
		$response = $this->get('/login');
		$response->assertRedirect("/$language/login");
    }
}
