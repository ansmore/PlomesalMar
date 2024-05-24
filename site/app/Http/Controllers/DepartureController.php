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
		// dd($request);

		$validated = $request->validate([
			'boat_id' => 'required|exists:boats,id',
			'transect_id' => 'required|exists:transects,id',
			'date' => 'required|date',
			// 'usersIds' => 'required|array',
			// 'userdIds.*' => 'required|exists:users,id'
		]);

		// dd($validated);


		try{
			$departure = Departure::createFromRequest($request);
			return redirect()->back()->with('status', "La sortida s'ha creat amb exit. ");
		} catch(\Exception $e){
			Log::error('Error al intentar crear un nuevo barco en la base de datos: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No se pudo registrar el barco en la base de datos. Por favor, revise los detalles e intente de nuevo.');
		}
    }

	public function edit($id, $language = null)
	{
		$departure = Departure::findOrFail($id);
		$boats = Boat::all();
		$transects = Transect::all();

		return view('departures.edit', [
			'departure' => $departure,
			'boats' => $boats,
			'transects' => $transects,
			'language' => $language,
		]);
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
		]);

		try {
			// $departure = Departure::findOrFail($id);
        	// $departure->update($validated);
            $success = Departure::updateFromRequest($request, $id);
            if ($success) {
                return redirect()->back()->with('status', "La sortida s'ha actualitzat amb exit.");
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
    public function destroy(Departure $departures)
    {
        //
    }
}
