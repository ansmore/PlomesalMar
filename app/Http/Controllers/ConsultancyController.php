<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ConsultancyController extends Controller
{
    public function consultoria()
    {
         $language = Session::get('language', 'ka');

        return view('consultoria', ['language' => $language]);
    }

    public function consultoriaSection($section = null)
    {
         $language = Session::get('language', 'ka');

        return view('consultoria', ['section' => $section, 'language' => $language]);
    }
}
