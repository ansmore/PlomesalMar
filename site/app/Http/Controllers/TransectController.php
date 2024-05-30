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
			Log::info('Peticio rebuda: ', $request->all());
            $transect = Transect::createFromRequest($request);
            return redirect()->back()->with('status', 'El transecto ha sido creado exitosamente en la base de datos.');
        } catch (\Exception $e) {
            Log::error('Error al intentar crear un nuevo transecto en la base de datos: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No se pudo registrar el transecto en la base de datos. Por favor, revise los detalles e intente de nuevo.');
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
                return redirect()->back()->with('status', 'El transecto ha sido actualizado exitosamente en la base de datos.');
            } else {
                return redirect()->back()->with('error', 'La actualización del transecto falló. No se encontraron cambios o el transecto no existe.');
            }
        } catch (\Exception $e) {
            Log::error('Error al actualizar el transecto en la base de datos: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al intentar actualizar el transecto. Por favor, intente de nuevo.');
        }
    }
}
