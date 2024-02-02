<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ConsultancyController extends Controller
{
    public function consultancy()
    {
        $language = Session::get('language',  config('app.fallback_locale', 'es'));

        return view('consultancy', ['language' => $language]);
    }

    public function consultancySection($section = null)
    {
        $language = Session::get('language',  config('app.fallback_locale', 'es'));

        return view('consultancy', ['section' => $section, 'language' => $language]);
    }
}
