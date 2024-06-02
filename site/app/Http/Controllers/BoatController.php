<?php

namespace App\Http\Controllers;

use App\Models\Boat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BoatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of boats.
     */
    public function index(Request $request, $language = null)
    {
        $boats = Boat::getFilteredBoats($request);
        return view('pages.boats', ['language' => $language, 'boats' => $boats]);
    }

    /**
     * Store a newly created boat in storage.
     */
    public function store(Request $request, $language = null)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => 'required|string|max:5'
        ]);

        try {
            $boat = Boat::createFromRequest($request);
            return redirect()->back()->with('status', 'El vaixell ha estat creat amb èxit a la base de dades.');
        } catch (\Exception $e) {
            Log::error('Error en intentar crear un nou vaixell a la base de dades: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No s\'ha pogut registrar el vaixell a la base de dades. Si us plau, revisi els detalls i intenti-ho de nou.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $language , $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => 'required|string|max:5'
        ]);

        try {
            $success = Boat::updateFromRequest($request, $id);
            if ($success) {
                return redirect()->back()->with('status', 'El vaixell ha estat actualitzat amb èxit a la base de dades.');
            } else {
                return redirect()->back()->with('error', 'L\'actualització del vaixell ha fallat. No s\'han trobat canvis o el vaixell no existeix.');
            }
        } catch (\Exception $e) {
            Log::error('Error en actualitzar el vaixell a la base de dades: ' . $e->getMessage());
            return redirect()->back()->with('error', 'S\'ha produït un error en intentar actualitzar el vaixell. Si us plau, intenti-ho de nou.');
        }
    }
}
