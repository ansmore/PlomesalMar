<?php

namespace App\Http\Controllers;

use App\Models\Transect;
use Illuminate\Http\Request;

class TransectController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

	/**
     * Display a listing of the resource.
     */
    public function index(Request $request, $language = null)
    {
        $transects = Transect::getFilteredTransects($request);
        return view('pages.transects', ['language' => $language, 'transects' => $transects]);
    }

}
