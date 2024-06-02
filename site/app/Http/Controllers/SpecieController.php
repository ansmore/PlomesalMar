<?php

namespace App\Http\Controllers;

use App\Models\Specie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SpecieController extends Controller
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
        $species = Specie::getFilteredSpecies($request);
        return view('pages.species', ['language' => $language, 'species' => $species]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $language = null)
    {
        $validated = $request->validate([
            'common_name' => 'required|string|max:255',
            'scientific_name' => 'required|string|max:255'
        ]);

        try {
            $specie = Specie::createFromRequest($request);
            return redirect()->back()->with('status', 'L\'espècie ha estat creada amb èxit a la base de dades.');
        } catch (\Exception $e) {
            Log::error('Error en intentar crear una nova espècie a la base de dades: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No s\'ha pogut registrar l\'espècie a la base de dades. Si us plau, revisi els detalls i intenti-ho de nou.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $language, $id)
    {
        $validated = $request->validate([
            'common_name' => 'required|string|max:255',
            'scientific_name' => 'required|string|max:255'
        ]);

        try {
            $success = Specie::updateFromRequest($request, $id);
            if ($success) {
                return redirect()->back()->with('status', 'L\'espècie ha estat actualitzada amb èxit a la base de dades.');
            } else {
                return redirect()->back()->with('error', 'L\'actualització de l\'espècie ha fallat. No s\'han trobat canvis o l\'espècie no existeix.');
            }
        } catch (\Exception $e) {
            Log::error('Error en actualitzar l\'espècie a la base de dades: ' . $e->getMessage());
            return redirect()->back()->with('error', 'S\'ha produït un error en intentar actualitzar l\'espècie. Si us plau, intenti-ho de nou.');
        }
    }
}
