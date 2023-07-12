<?php

namespace App\Http\Controllers;

use App\Http\Requests\EleveRequest as RequestsEleveRequest;
use App\Http\Requests\SortieRequest;
use App\Models\Eleve;
use Illuminate\Http\Request;
use Illuminate\Http\Requests\EleveRequest;
// use Illuminate\Http\Requests\Request;
use App\Models\AnnneScolaire;
use App\Models\Inscription;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class EleveController extends Controller
{
    public function getNumeroDoAly()
    {
        $eleve = new Eleve();
        $numero = $eleve->orderByDesc("numero");
        return $numero;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RequestsEleveRequest $request)
    {
        DB::beginTransaction();
        try {
            //code...
            $eleve = new Eleve();
            $eleve->prenom = $request->prenom;
            $eleve->nom = $request->nom;
            $eleve->date_naissance = $request->date_naissance;
            $eleve->lieu_naissance = $request->lieu_naissance;
            $eleve->profil = $request->profil;
            $eleve->sexe = $request->sexe;
            if ($request->profil == 0) {
                $eleve->numero = null;
            }
            $eleve->save();

            $inscription = new Inscription();
            $inscription->classe_id = $request->classe;
            // $inscription->eleve_id =  $eleve->latest()->first()->id;
            $inscription->eleve_id =  $eleve->id;
            $inscription->annne_scolaire_id = AnnneScolaire::latest()->first()->id;
            $inscription->date_inscription = now();

            $inscription->save();
            DB::commit();
        } catch (\Throwable $th) {
            return [__("messages.Stident not register")];
            DB::rollBack();

            //throw $th;
        }

        /* 
            "prenom" : "Aly", 
            "nom" : "Niang",
            "date_naissance" : "2002-10-10",
            "lieu_naissance" : "dakar",
            "profil" : 1, 
            "classe" : 1,
            "sexe" : "masculin"
        
        */
        // L'éléve ne peut pas être agé de moins de 5ans
        // return $this->checkDate($eleve->date_naissance);

        // $id_eleve = $last_eleve->id;
        return response()->json($eleve->latest()->first());
        return;




        //
    }




    public function getNumero()
    {
        // les éléves ayant un etat 0 sont considérés comme exclus
        $eleve = DB::table('eleves')->whereRaw('etat = ? AND profil = ?', [0, 1])->get();
        if (count($eleve) == 0) {
            $num = DB::table('eleves')->max("numero");
            // $message = "aucun numero disponible pour une réattribution";

            return $num + 1;
        } else {
            $message = "des numéro sont dispo";
            $tab = [];
            for ($i = 0; $i < count($eleve); $i++) {
                # code...
                if (count($this->verifieIfOnly($eleve[$i]->numero)) == 0) {

                    array_push($tab, $eleve[$i]->numero);
                }
            }
            return min($tab);
        }
    }

    public function sortie(SortieRequest $request)
    {
        // ['id_eleves' => $eleves] = $request;
        // try {
            Eleve::whereIn('id', $request->ids)->update(['etat' => 0]);
        // } catch (\Throwable $th) {
        //     return [__("messages.Attemp type array")];
        //     //throw $th;
        // };

        return Eleve::whereIn("id", $request->ids)->get();
    }

    public function verifieIfOnly($numero)
    {
        return DB::table('eleves')->where('etat', 1)->where('numero', $numero)->get();
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

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
