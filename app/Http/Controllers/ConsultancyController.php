<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConsultancyController extends Controller
{
    public function consultoria()
    {
        return view('consultoria');
    }

    public function consultoriaSection($section = null)
    {
        return view('consultoria', ['section' => $section]);
    }
}
