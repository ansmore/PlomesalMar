<?php

namespace App\Http\Controllers;

use App\Models\Boat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class BoatController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');

		// $this->language = Session::get('language',  config('app.fallback_locale', 'ca'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $language = null)
    {
        $boats = Boat::getFilteredBoats($request);
        return view('pages.boats', ['language' => $language, 'boats' => $boats]);
    }

}
