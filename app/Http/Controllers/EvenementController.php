<?php

namespace App\Http\Controllers;

use App\Http\Resources\EvenementResource;
use App\Models\Classe;
use App\Models\ClasseEvenement;
use App\Models\Eleve;
use App\Models\Evenement;
use Illuminate\Http\Request;
use App\Console\Commands\SendMailCommand;
use App\Mail\SendMail;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class EvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return EvenementResource::collection(Evenement::all());
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
    public function store(HttpFoundationRequest $request)
    {
        //
        /* 
        {
            "initiateur" : 1,
            "evenement" : "devoir" 
        }
        */
        ["initiateur" => $initiateur] = $request;
        ["evenement" => $evenement] = $request;
        // return $initiateur;
        $newEvenement =  Evenement::insert(
            [
                "libelle_evenement" => $evenement,
                "initiateur_id" => $initiateur
            ]
        );
        // return $newEvenement["id"];
        return EvenementResource::collection(Evenement::all());
    }

    public function addParticipation(HttpFoundationRequest $request, Classe $id)
    {
        ["evenement" => $evenement] = $request;
        // ["id" => $classe] = $request;
        ["date_evenement" => $dateEvent] = $request;
        /* 
            "evenement" : 1,
            "date_evenement" :  2023-10-10
        */
        // ClasseEvenement::insert([
        //     "evenement_id" => $evenement,
        //     "classe_id" => $id->id,
        //     "date_evenement" => $dateEvent
        // ]);

        $inscription =  $id->load("Inscriptions")->inscriptions;
        $tab = [];
        foreach ($inscription as $value) {
            array_push($tab, Eleve::where(["id" => $value->eleve_id])->first());
            # code...
        }
        return $tab;
        $mail = new SendMailCommand();
        // $mail->handle($tab);
        return $tab;
    }

    /**
     * Display the specified resource.
     */
    public function show(Evenement $evenement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evenement $evenement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evenement $evenement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evenement $evenement)
    {
        //
    }
}
