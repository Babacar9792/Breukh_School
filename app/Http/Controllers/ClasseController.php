<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClasseRequest;
use App\Http\Requests\UpdateClasseRequest;
use App\Http\Resources\ClasseResource;
use App\Models\Classe;
use App\Models\Discipline;
use App\Models\DisciplineClasse;
use App\Models\Eleve;
use App\Models\Evaluation;
use App\Models\Inscription;
use App\Models\Note;
use Symfony\Component\HttpFoundation\Request;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreClasseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Classe $classe)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classe $classe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClasseRequest $request, Classe $classe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $classe)
    {
        //
    }

    public function getEleveById(Classe $id)
    {

        //  $inscriptions = $id->load("Inscriptions")->inscriptions;
        // //  return $inscriptions;

        // $tab = [];
        // for ($i=0; $i < count($inscriptions); $i++) { 
        //     array_push($tab, Eleve::find($inscriptions[$i]->eleve_id));
        // }
        // // return Eleve::find($id->load("Inscriptions")->inscriptions[1]->eleve_id);
        // // return $id->load("Inscriptions")->inscriptions;
        // return response()->json(["eleves" => $tab, "libelle_classe" => $id->load("Inscriptions")->libelle_classe]);
        // return new ClasseResource($id);
        return new ClasseResource($id);
    }

    // public function getNoteBydiscipline(Request $request, Classe $classe)
    // {
    //     // ["classe" => $classe] = $request;
    //     ["discipline" => $discipline] = $request;
    //     // return $classe;
    //     $disciplineInClasse =  DisciplineClasse::where([
    //         "classe_id" => $classe->id,
    //         "discipline_id" => $discipline,
    //         "annne_scolaire_id" => 1,
    //         "semestre_id" => 1
    //     ])->get();
    //     if (count($disciplineInClasse) == 0) {
    //         return [__("messages.missing discipline")];
    //     } else {
    //         $tab = [];
    //         $inscriptions = $classe->load("Inscriptions")->inscriptions;
    //         for ($i = 0; $i < count($inscriptions); $i++) {
    //             $elewe = Note::where([
    //                 "discipline_classe_id" => $disciplineInClasse[0]->id,
    //                 "inscription_id" => $inscriptions[$i]->id
    //             ])->get();
    //             $newNote = null;
    //             if (count($elewe) != 0) {
    //                 $newNote = $elewe[0]->note_eleve;
    //             }
    //             array_push($tab, [
    //                 "eleve" => Eleve::find($inscriptions[$i]->eleve_id),
    //                 "type note" => Evaluation::where(["id" => $disciplineInClasse[0]->evaluation_id])->first("libelle_evaluation"),
    //                 "note" => $newNote
    //             ]);
    //         }
    //         return $tab;
    //     }
    //     // return $; 

    // }


    public function getNoteBydiscipline(Classe $classe, Discipline $discipline)
    {
        //Classe $classe, Discipline $discipline

        // $collection = collect([1, 2, 3, 4, 5]);


        $inscriptions = $classe->load('Inscriptions')->inscriptions;
        //  echo json_encode($inscriptions);
        echo "***************";
        $ponderations = DisciplineClasse::where(["classe_id" => $classe->id, "discipline_id" => $discipline->id, "semestre_id" => 1])->pluck("id");
      return $inscriptions->map(function ($item, $key) use ($ponderations) {

            // $keys = [];
            return ["eleve" => $item, "notes" => Note::whereIn("inscription_id", $ponderations)->get()];
           // return $keys;
        });
        // return $multiplied;
        // return $multiplied->all(); // [2, 4, 6, 8, 10]

        // $eleves = [];
        // foreach ($inscriptions as $value) {
        //     $note = [];
        //     for ($i=0; $i <count($ponderations) ; $i++) { 
        //         array_push($note, Note::where(["discipline_classe_id" => $ponderations[$i], "inscription_id" => $value->id])->first());
        //         # code...
        //     }
        //     $eleve = ["eleve" => $value, "notes" => $note];
        //     array_push($eleves, $eleve);
        //     // return $note;    
        //     # code...
        // }
        // return $eleves;
        // return $ponderations;
    }

    // public function getNoteByClasse(Classe $classe)
    // {
    //     $inscriptions = $classe->load("Inscriptions")->inscriptions;

    //     $disciplineClasse =  DisciplineClasse::where([
    //         "classe_id" => $classe->id
    //     ])->get();
    //     if (count($disciplineClasse) == 0) {
    //         return [__("messages.no disciplines for this classe")];
    //     } else {
    //         $table = [];
    //         $tab = [];
    //         array_push($table, ["classe" => $classe->libelle_classe]);
    //         for ($i = 0; $i < count($inscriptions); $i++) {

    //             $eleve = Eleve::where([
    //                 "id" => $inscriptions[$i]->eleve_id
    //             ])->first();


    //             for ($j = 0; $j < count($disciplineClasse); $j++) {

    //                 # code..

    //                 $noteEleve = Note::where([
    //                     "inscription_id" => $inscriptions[$i]->id,
    //                     "discipline_classe_id" => $disciplineClasse[$j]->id
    //                 ])->get();
    //                 $newnote = null;
    //                 if (count($noteEleve) != 0) {
    //                     // array_push($tab, $noteEleve);
    //                     $newnote = $noteEleve[0]->note_eleve;
    //                 }
    //                 $objet = [
    //                     "eleve" => $eleve,
    //                     "type de note" => Evaluation::where([
    //                         "id" => $disciplineClasse[$j]->evaluation_id,
    //                     ])->first()->libelle_evaluation,
    //                     "note" => $newnote,
    //                     "discipline" => Discipline::where([
    //                         "id" => $disciplineClasse[$j]->discipline_id
    //                     ])->first()->libelle_discipline


    //                 ];
    //                 array_push($tab, $objet);
    //             }
    //         }
    //         array_push($table, ["data" => $tab]);
    //         return $table;
    //         return $disciplineClasse;
    //     }
    // }


    public function getNoteStudent(Request $request, Classe $classe)
    {
        $idClasseInInscription = Inscription::where(["id" => $request["eleve"]])->first();
        if ($classe->id != $idClasseInInscription->classe_id) {
            return [__("messages.Student does not in classe")];
        }
        $disciplineInClasse =  DisciplineClasse::where(["classe_id" => $classe->id])->get();
        if (count($disciplineInClasse) == 0) {
            return [__("messages.no disciplines for this classe")];
        }
        $tab = [];
        for ($i = 0; $i < count($disciplineInClasse); $i++) {
            $note =  Note::where([
                "discipline_classe_id" => $disciplineInClasse[$i]->id,
                "inscription_id" => $request["eleve"]
            ])->get();
            if (count($note) != 0) {
                $objet = [
                    "eleve" => Eleve::find($idClasseInInscription->eleve_id),
                    "discipline" => Discipline::where([
                        "id" => DisciplineClasse::where([
                            "id" => $disciplineInClasse[$i]->id
                        ])->first()->discipline_id,

                    ])->first()->libelle_discipline,
                    "type de note" => Evaluation::where([
                        "id" => DisciplineClasse::where([
                            "id" => $disciplineInClasse[$i]->id
                        ])->first()->evaluation_id,

                    ])->first()->libelle_evaluation,
                    "note" => $note[0]->note_eleve
                ];

                array_push($tab, $objet);
            }
            # code...
        }
        return $tab;
        return $classe->id;
    }
}
