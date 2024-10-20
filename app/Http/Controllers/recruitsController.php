<?php

namespace App\Http\Controllers;

use App\Models\Recruits;
use Illuminate\Http\Request;

class recruitsController extends Controller
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
    public function show(Recruits $recruits)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recruits $recruits)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recruits $recruits)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recruits $recruits)
    {
        //
    }
}
