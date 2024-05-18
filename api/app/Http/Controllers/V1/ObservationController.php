<?php

namespace App\Http\Controllers\V1;

use App\Models\Observation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ObservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $observations = Observation::all();
        return response()->json($observations);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $observation = Observation::findOrFail($id);
        return response()->json($observation);
    }

}
