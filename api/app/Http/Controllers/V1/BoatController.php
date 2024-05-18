<?php

namespace App\Http\Controllers\V1;

use App\Models\Boat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BoatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boats = Boat::all();
        return response()->json($boats);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'registration_number' => 'required|string|max:5|unique:boats'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $boat = Boat::create($validator->validated());

        return response()->json([
            'message' => 'Success',
            'boat' => $boat
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $boat = Boat::findOrFail($id);
        return response()->json($boat);
    }

}