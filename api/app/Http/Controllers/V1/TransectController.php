<?php

namespace App\Http\Controllers\V1;

use App\Models\Transect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transects = Transect::all();
        return response()->json($transects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $transect = Transect::create($validator->validated());

        return response()->json([
            'message' => 'Transect created successfully',
            'transect' => $transect
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transect = Transect::findOrFail($id);
        return response()->json($transect);
    }

}
