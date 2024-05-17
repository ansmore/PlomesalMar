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
            return redirect()->back()->with('status', 'La especie ha sido creada exitosamente en la base de datos.');
        } catch (\Exception $e) {
            Log::error('Error al intentar crear una nueva especie en la base de datos: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No se pudo registrar la especie en la base de datos. Por favor, revise los detalles e intente de nuevo.');
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
                return redirect()->back()->with('status', 'La especie ha sido actualizada exitosamente en la base de datos.');
            } else {
                return redirect()->back()->with('error', 'La actualización de la especie falló. No se encontraron cambios o la especie no existe.');
            }
        } catch (\Exception $e) {
            Log::error('Error al actualizar la especie en la base de datos: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al intentar actualizar la especie. Por favor, intente de nuevo.');
        }
    }
}
