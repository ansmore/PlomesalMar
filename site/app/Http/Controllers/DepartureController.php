<?php

namespace App\Http\Controllers;

use App\Models\Boat;
use App\Models\User;
use App\Models\Transect;
use App\Models\Departure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class DepartureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of departures.
     */
    public function index(Request $request, $language = null)
    {
        $departures = Departure::getFilteredDepartures($request);
        $boats = Boat::all();
        $transects = Transect::all();
        $users = User::all();
        return view('pages.departures', [
            'language' => $language,
            'departures' => $departures,
            'boats' => $boats,
            'transects' => $transects,
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $language = null)
    {
        try {
            $validated = $request->validate([
                'boat_id' => 'required|exists:boats,id',
                'transect_id' => 'required|exists:transects,id',
                'date' => 'required|date',
                'users' => 'array',
                'users.*' => 'exists:users,id'
            ], [
                'date.required' => 'La data és obligatòria per crear una sortida.'
            ]);

        } catch (ValidationException $e) {
            Log::error('Error de validació.', ['errors' => $e->errors()]);
            $errorMessage = $e->validator->errors()->first('date') ?? 'Dades d\'entrada invàlides.';
            return redirect()->back()->with('error', $errorMessage)->withInput();
        }

        try {
            $departure = Departure::createIfNotExists($validated);

            if ($departure) {
                return redirect()->back()->with('status', "La sortida s'ha creat amb èxit.");
            } else {
                return redirect()->back()->with('status', "La sortida ja existeix.");
            }
        } catch (\Exception $e) {
            Log::error('Error en intentar crear una nova sortida a la base de dades: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No s\'ha pogut registrar la sortida a la base de dades. Si us plau, revisi els detalls i intenti-ho de nou.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $language, $id)
    {
        $validated = $request->validate([
            'boat_id' => 'required|exists:boats,id',
            'transect_id' => 'required|exists:transects,id',
            'date' => 'required|date',
            'users' => 'nullable|array',
            'users.*' => 'exists:users,id'
        ]);

        try {
            $success = Departure::updateFromRequest($request, $id);
            if ($success) {
                return redirect()->back()->with('status', "La sortida s'ha actualitzat amb èxit.");
            } else {
                return redirect()->back()->with('error', 'L\'actualització de la sortida ha fallat. No s\'han trobat canvis o la sortida no existeix.');
            }
        } catch (\Exception $e) {
            Log::error('Error en actualitzar la sortida a la base de dades: ' . $e->getMessage());
            return redirect()->back()->with('error', 'S\'ha produït un error en intentar actualitzar la sortida. Si us plau, intenti-ho de nou.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($language, $id)
    {
        try {
            $departure = Departure::findOrFail($id);

            $departure->deleteIfNoObservations();

            return redirect()->back()->with('status', 'La sortida s\'ha eliminat amb èxit.');
        } catch (\Exception $e) {
            Log::error('Error en intentar eliminar la sortida: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
