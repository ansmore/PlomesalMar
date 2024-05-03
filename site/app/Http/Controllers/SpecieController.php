<?php

namespace App\Http\Controllers;

use App\Models\Specie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

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
    public function store(Request $request, $language = null)
    {
        $validated = $request->validate([
            'nombre_comun' => 'required|string|max:255',
            'nombre_cientifico' => 'required|string|max:255'
        ]);
        
        Log::info('Validated data:', $validated);

        $specie = Specie::createFromRequest($request);
        
        Log::info('New specie created:', [
            'id' => $specie->id,
            'common_name' => $specie->common_name,
            'scientific_name' => $specie->scientific_name
        ]);

        $language = Session::get('language', config('app.fallback_locale', 'ca'));
        Session::flash('toast_message', trans('messages.species_saved', [], $language));
        
        return redirect()->back()->with('language', $language);
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
    public function update(Request $request, $language, $id)
    {
        Specie::updateFromRequest($request, $id);
        return redirect()->back()->with('language', $language);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($language, $id)
    {
        Log::info('ID y lenguaje recibidos en el controlador:', ['id' => $id, 'language' => $language]);

        Session::put('language', $language);

        Specie::deleteById($id);

        return redirect()->back()->with('language', $language);
    }

}
