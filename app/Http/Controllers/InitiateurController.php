<?php

namespace App\Http\Controllers;

use App\Http\Resources\InitiateurResource;
use App\Models\Initiateur;
use App\Traits\JoinQueryParams;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon as SupportCarbon;

class InitiateurController extends Controller
{
    use JoinQueryParams;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Initiateur::all('nom_initiateur');
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
    public function show(Initiateur $initiateur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Initiateur $initiateur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Initiateur $initiateur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Initiateur $initiateur)
    {
        //
    }

    public function carbo()
    {
      $this->test();
        
        return SupportCarbon::now()->addDay();
    }
}
