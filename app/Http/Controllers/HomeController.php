<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use GeoIp2\Database\Reader;
// use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($language = null, $section = null)
    {
        $language = Session::get('language',  config('app.fallback_locale', 'ca'));

        // return Redirect::to("/$language/home");
		return view('pages.home', ['section' => $section,'language' => $language ]);
    }

	public function indexSection($language = null, $section = null)
	{

		$language = Session::get('language',  config('app.fallback_locale', 'ca'));

		return view('pages.home', ['section' => $section,'language' => $language ]);
	}

	public function homeMain($language = null, $section = null)
    {
        $language = Session::get('language',  config('app.fallback_locale', 'ca'));

        // return Redirect::to("/$language/home");
		return view('pages.home', ['section' => $section,'language' => $language ]);
    }

    public function home($language = null)
    {

        $language = Session::get('language',  config('app.fallback_locale', 'ca'));

        return view('pages.home', ['language' => $language]);
    }

    public function homeSection($language = null, $section = null)
    {

        $language = Session::get('language',  config('app.fallback_locale', 'ca'));

        return view('pages.home', ['section' => $section,'language' => $language ]);
    }

	public function login($language = null)
    {
        $language = Session::get('language',  config('app.fallback_locale', 'ca'));

        return view('pages.login',['language' => $language]);
    }


    public function privacyPolicy($language = null)
    {
        $language = Session::get('language',  config('app.fallback_locale', 'ca'));

        return view('pages.privacyPolicy',['language' => $language]);
    }

    public function termsOfUse()
    {

        $language = Session::get('language',  config('app.fallback_locale', 'ca'));

        return view('pages.termsOfUse',['language' => $language]);
    }
}
