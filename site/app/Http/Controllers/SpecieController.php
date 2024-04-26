<?php

namespace App\Http\Controllers;

use App\Models\Specie;
use Illuminate\Http\Request;

class SpecieController extends Controller
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
        $species = Specie::getSpeciesBasedOnRequest($request);

        if ($request->has('search')) {
            return view('partials.speciesTable', ['species' => $species])->render();
        }
        
        return view('pages.species', ['language' => $language, 'species' => $species ]);
    }

	/**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Specie $specie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specie $specie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Specie $specie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specie $specie)
    {
        //
    }
}
