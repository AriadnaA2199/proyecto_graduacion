<?php

namespace App\Http\Controllers;

use App\Models\Roster;
use Illuminate\Http\Request;

class rosterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'This your index page';
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
    public function show(Roster $roster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Roster $roster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Roster $roster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Roster $roster)
    {
        //
    }
}
