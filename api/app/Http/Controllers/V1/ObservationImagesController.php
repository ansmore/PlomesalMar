<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Models\ImageObservation;
use App\Http\Controllers\Controller;

class ImageObservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = ImageObservation::all();
        return response()->json($images);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $image = ImageObservation::findOrFail($id);
        return response()->json($image);
    }

}