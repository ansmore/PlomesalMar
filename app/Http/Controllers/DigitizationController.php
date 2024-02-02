<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DigitizationController extends Controller
{
    public function digitalization()
    {
        $language = Session::get('language',  config('app.fallback_locale', 'es'));

        return view('digitalization', [ 'language' => $language]);
    }

    public function digitalizationSection($section = null)
    {
        $language = Session::get('language',  config('app.fallback_locale', 'es'));

        return view('digitalization', ['section' => $section, 'language' => $language]);
    }
}
