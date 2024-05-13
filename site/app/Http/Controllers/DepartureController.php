<?php

namespace App\Http\Controllers;

use App\Models\Departure;
use Illuminate\Http\Request;

class DepartureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->language = Session::get('language', config('app.fallback_locale', 'ca'));
    }

    /**
     * Display a listing of departures.
     */
    public function index(Request $request, $language = null)
    {
        $departures = Departure::getFilteredDepartures($request);
        return view('pages.departures', ['language' => $language, 'departures' => $departures]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Departure $departures)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departure $departures)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Departure $departures)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departure $departures)
    {
        //
    }
}
