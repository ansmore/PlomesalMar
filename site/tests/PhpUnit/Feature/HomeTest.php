<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
	use RefreshDatabase, WithFaker;

	/**
     * Test the root route returns the home page with the session-specified language.
     *
     * Given the user is authenticated,
     * And a language is specified in the session,
     * When the root route is accessed,
     * Then the response should display the home page with the session language.
     */
    public function test_root_route_loads_home_page_with_session_language()
    {
        $user = User::factory()->create();
        $sessionLanguage = 'es';
        Session::put('language', $sessionLanguage);
        $response = $this->actingAs($user)->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('pages.home');
        $response->assertViewHas('language', $sessionLanguage);
    }

    /**
     * Test the root route returns the home page with the fallback language when no session language is set.
     *
     * Given the user is authenticated,
     * And no language is specified in the session,
     * When the root route is accessed,
     * Then the response should display the home page with the fallback language.
     */
    public function test_root_route_loads_home_page_with_fallback_language()
    {
        $user = User::factory()->create();
        Session::forget('language');
        $defaultLanguage = config('app.fallback_locale', 'ca');
        $response = $this->actingAs($user)->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('pages.home');
        $response->assertViewHas('language', $defaultLanguage);
    }

	/**
     * Test that the root route handles language parameter correctly.
     *
     * Given the user is authenticated,
     * When the root route is accessed with a language parameter,
     * Then the response should display the home page with the specified language.
     */
    public function test_root_route_with_language_parameter()
    {
        $user = User::factory()->create();
        $language = 'en';

        $response = $this->actingAs($user)->get("/$language");

        $response->assertStatus(200);
        $response->assertViewIs('pages.home');
        $response->assertViewHas('language', $language);
    }

    /**
     * Test that the /home route handles language parameter correctly.
     *
     * Given the user is authenticated,
     * When the /home route is accessed with a language parameter,
     * Then the response should display the home page with the specified language.
     */
    public function test_home_route_with_language_parameter()
    {
        $user = User::factory()->create();
        $language = 'en';

        $response = $this->actingAs($user)->get("/$language/home");

        $response->assertStatus(200);
        $response->assertViewIs('pages.home');
        $response->assertViewHas('language', $language);
    }
}
