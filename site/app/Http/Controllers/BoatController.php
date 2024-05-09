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
        // $this->language = Session::get('language', config('app.fallback_locale', 'ca'));
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
            return redirect()->back()->with('status', 'El barco ha sido creado exitosamente en la base de datos.');
        } catch (\Exception $e) {
            Log::error('Error al intentar crear un nuevo barco en la base de datos: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No se pudo registrar el barco en la base de datos. Por favor, revise los detalles e intente de nuevo.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $language, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => 'required|string|max:5'
        ]);

        try {
            $success = Boat::updateFromRequest($request, $id);
            if ($success) {
                return redirect()->back()->with('status', 'El barco ha sido actualizado exitosamente en la base de datos.');
            } else {
                return redirect()->back()->with('error', 'La actualización del barco falló. No se encontraron cambios o el barco no existe.');
            }
        } catch (\Exception $e) {
            Log::error('Error al actualizar el barco en la base de datos: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al intentar actualizar el barco. Por favor, intente de nuevo.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($language, $id)
    {
        try {
            $success = Boat::deleteById($id);
            if ($success) {
                return redirect()->back()->with('status', 'El barco ha sido eliminado exitosamente de la base de datos.');
            } else {
                return redirect()->back()->with('error', 'No se pudo eliminar el barco de la base de datos porque tiene salidas asociadas.');
            }
        } catch (\Exception $e) {
            Log::error('Error al eliminar el barco de la base de datos: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar el barco. Por favor, asegúrese de que no está vinculado a salidas importantes.');
        }
    }

}
