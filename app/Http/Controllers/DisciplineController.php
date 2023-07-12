<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use App\Models\DisciplineClasse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Resources\DisciplineResource;


class DisciplineController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Discipline::all("libelle_discipline");
        //
    }


    public function getDisciplineByClasse(Request $request)
    {
        // dd("doucouré");
        $classe = \App\Models\Classe::find($request->id);

        // $tableau = DisciplineClasse::where("classe_id", $request->id)->get();
        // for ($i = 0; $i < count($tableau); $i++) {
        //     # code...
        //     array_push($disciplines, Discipline::find($tableau[$i]->discipline_id));
        // }
        // "associations" => $tableau
        // return ["disc" => DisciplineResource::collection($disciplines)];
        $classe->load("DisciplineClasse.Discipline");
        return $classe;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // DB::beginTransaction();

        $discipline = new Discipline();
        // $discipline = Discipline::firstOrCreate([
        //     "libelle_discipline " => $request->discipline
        // ]);
        // $id_discipline = -2;
        $existe = $discipline->disciplineExiste($request->discipline);
        if (count($existe) == 0) {
            $discipline->libelle_discipline = $request->discipline;
            $discipline->save();
            $id_discipline = $discipline->id;

        } else {
            $id_discipline = $existe[0]->id;
            // return [
            //     "message" => "cette discipline existe déjà"
            // ];
        }

        $disciplineClasse = new DisciplineClasse();
        if (count($disciplineClasse->disciplineExisteInClasse($id_discipline, $request->id)) != 0) {
            return ["message " => "Cette discipline existe déja pour cette classe"];
        }
        $disciplineClasse->annne_scolaire_id = 1;
        $disciplineClasse->classe_id = $request->id;
        $disciplineClasse->evaluation_id = $request->evaluation;
        $disciplineClasse->note_maximale = $request->note;
        $disciplineClasse->discipline_id = $id_discipline;
        $disciplineClasse->semestre_id = 1;
        $disciplineClasse->save();
        return ["discipline" => $discipline, "asso" => $disciplineClasse];
        return ["discipline" => $discipline, "message" => "Insertion reussi"];
        /* 
            "evaluation" : 1,
            "note" : 20,
            "discipline" : "Dictée"
        */
    }

    /**
     * Display the specified resource.
     */
    public function show(Discipline $discipline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discipline $discipline)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discipline $discipline)
    {
        //
    }
}
