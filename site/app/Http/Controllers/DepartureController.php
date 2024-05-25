<?php

namespace App\Http\Controllers;

use App\Models\Boat;
use App\Models\Transect;
use App\Models\Departure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        // Validar los datos del formulario
        $validated = $request->validate([
            'boat_id' => 'required|exists:boats,id',
            'transect_id' => 'required|exists:transects,id',
            'date' => 'required|date',
            'users' => 'required|array',
            'users.*' => 'exists:users,id'
        ]);

        try {
            // Llama al método del modelo para crear la salida
            $departure = Departure::createIfNotExists($validated);

            if ($departure) {
                return redirect()->back()->with('status', "La salida se ha creado con éxito.");
            } else {
                return redirect()->back()->with('status', "La salida ya existe.");
            }
        } catch (\Exception $e) {
            Log::error('Error al intentar crear una nueva salida en la base de datos: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No se pudo registrar la salida en la base de datos. Por favor, revise los detalles e intente de nuevo.');
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
            'users' => 'required|array',
            'users.*' => 'exists:users,id'
        ]);

        try {
            $success = Departure::updateFromRequest($request, $id);
            if ($success) {
                return redirect()->back()->with('status', "La salida se ha actualizado con éxito.");
            } else {
                return redirect()->back()->with('error', 'La actualización de la salida falló. No se encontraron cambios o la salida no existe.');
            }
        } catch (\Exception $e) {
            Log::error('Error al actualizar la salida en la base de datos: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al intentar actualizar la salida. Por favor, intente de nuevo.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departure $departures)
    {
        //
    }
}
