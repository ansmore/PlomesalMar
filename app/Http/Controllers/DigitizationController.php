<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DigitizationController extends Controller
{
    public function digitalizacion()
    {
        $language = Session::get('language',  'tu');

        return view('digitalizacion', [ 'language' => $language]);
    }

    public function digitalizacionSection($section = null)
    {
        $language = Session::get('language',  'tu');

        return view('digitalizacion', ['section' => $section, 'language' => $language]);
    }
}
