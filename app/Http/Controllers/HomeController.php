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
    public function index()
    {
        $language = Session::get('language',  config('app.fallback_locale', 'es'));

        return Redirect::to("/$language/home");
    }

    public function home($language = null)
    {

        // // Obtener la dirección IP del cliente
        // $ipAddress = $_SERVER['REMOTE_ADDR'];

        // // Determinar la ubicación geográfica
        // $reader = new Reader('/path/to/geoip/database.mmdb');
        // $record = $reader->city($ipAddress);

        // $city = $record->city->name;
        // $country = $record->country->name;

        // // Guardar la información en el log
        // Log::info('Usuario con IP ' . $ipAddress . ' desde ' . $city . ', ' . $country . ' visitó la página de inicio');


        $language = Session::get('language',  config('app.fallback_locale', 'es'));

        return view('home', ['language' => $language]);
    }

    public function indexSection($language = null, $section = null)
    {

        $language = Session::get('language',  config('app.fallback_locale', 'es'));

        return view('home', ['section' => $section,'language' => $language ]);
    }

    public function homeSection($language = null, $section = null)
    {

        $language = Session::get('language',  config('app.fallback_locale', 'es'));

        return view('home', ['section' => $section,'language' => $language ]);
    }

    public function privacyPolicy($language = null)
    {
        $language = Session::get('language',  config('app.fallback_locale', 'es'));

        return view('privacyPolicy',['language' => $language]);
    }

    public function termsOfUse()
    {

        $language = Session::get('language',  config('app.fallback_locale', 'es'));

        return view('termsOfUse',['language' => $language]);
    }
}
