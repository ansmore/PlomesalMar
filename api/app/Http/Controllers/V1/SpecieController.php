<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller; 
use App\Models\Specie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SpecieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $species = Specie::all();
        $speciesWithoutTimestamps = $species->map(function ($specie) {
            return $specie->only(['id', 'scientific_name', 'common_name']);
        });
        return response()->json($speciesWithoutTimestamps);
        return response()->json($species);
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
    public function show(string $id)
    {
        $specie = Specie::findorFail($id);
        return response()->json($specie);
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
