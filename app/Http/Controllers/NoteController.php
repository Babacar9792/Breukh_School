<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\DisciplineClasse;
use App\Models\Inscription;
use Illuminate\Http\Request;
// use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class NoteController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        //
    }


    public function addNote(HttpFoundationRequest $request)
    {

        ["classe" => $classe] = $request;
        ["discipline" => $discipline] = $request;
        ["eval" => $eval] = $request;
        ["note" => $note] = $request;
        ["semestre" => $semestre] = $request;
        // return $note;
        $disciplineClasse = DisciplineClasse::whereRaw("classe_id = ? AND discipline_id = ? AND evaluation_id = ? AND semestre_id = ?", [$classe, $discipline, $eval, 1])->get();
        if (count($disciplineClasse) == 0) {
            return "Les données passées sont incorrecte";
        }

        foreach ($note as  $value) {
            ["inscription_id" => $inscription_id] = $value;
            if ($value["note"] < $disciplineClasse[0]->note_maximale) {
                Note::updateOrInsert(
                    [
                        "inscription_id" => $value["inscription_id"],
                        "discipline_classe_id" => $disciplineClasse[0]->id
                    ],
                    ["note_eleve" => $value["note"]]
                );
            } else {

                echo json_encode([__("messages.bad note")]);
            }
        }


        /* 

        "note" : [
            {
                "inscription_id" : 2,
                "note" : 12
            }

        ] ,
         "semestre" : 1 */


        return ["message" => "Insertion réussi"];
    }


    public function updateNote(HttpFoundationRequest $request)
    {
        ["classe" => $classe] = $request;
        ["discipline" => $discipline] = $request;
        ["eval" => $evals] = $request;
        ["eleve" => $eleve] = $request;
        ["note" => $note] = $request;

        $classeDiscipline =  DisciplineClasse::where([
            "classe_id" => $classe,
            "discipline_id" => $discipline,
            "evaluation_id" => $evals,
            "annne_scolaire_id" => 1,
            "semestre_id" => 1
        ])->get();

        if (count($classeDiscipline) == 0) {
            return [__("messages.missing discipline")];
        } else {
            if ($note > $classeDiscipline[0]->note_maximale) {
                return [__("messages.Bad value of note")];
            }
            $noteEleve =  Note::where(
                [
                    "discipline_classe_id" => $classeDiscipline[0]->id,
                    "inscription_id" => $eleve
                ]
            )->get();
            if (count($noteEleve) == 0) {
                return [__("messages.missing Note")];
            } else {
                return Note::find($noteEleve[0]->id)->update([
                    "note_eleve" => $note
                ]);
            }
        }
        return $note;
    }
}
