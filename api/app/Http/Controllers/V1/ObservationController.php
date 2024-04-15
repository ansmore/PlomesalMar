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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $observation = Observation::findOrFail($id);
        return response()->json($observation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
