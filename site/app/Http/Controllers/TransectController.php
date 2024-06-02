<?php

namespace App\Http\Controllers;

use App\Models\Transect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    /**
     * Store a newly created transect in storage.
     */
    public function store(Request $request, $language = null)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            Log::info('Petició rebuda: ', $request->all());
            $transect = Transect::createFromRequest($request);
            return redirect()->back()->with('status', 'El transsecte ha estat creat amb èxit a la base de dades.');
        } catch (\Exception $e) {
            Log::error('Error en intentar crear un nou transsecte a la base de dades: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No s\'ha pogut registrar el transsecte a la base de dades. Si us plau, revisi els detalls i intenti-ho de nou.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $language, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $success = Transect::updateFromRequest($request, $id);
            if ($success) {
                return redirect()->back()->with('status', 'El transsecte ha estat actualitzat amb èxit a la base de dades.');
            } else {
                return redirect()->back()->with('error', 'L\'actualització del transsecte ha fallat. No s\'han trobat canvis o el transsecte no existeix.');
            }
        } catch (\Exception $e) {
            Log::error('Error en actualitzar el transsecte a la base de dades: ' . $e->getMessage());
            return redirect()->back()->with('error', 'S\'ha produït un error en intentar actualitzar el transsecte. Si us plau, intenti-ho de nou.');
        }
    }
}
