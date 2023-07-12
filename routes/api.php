<?php

use App\Http\Controllers\NiveauController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\AnnneScolaireController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\InitiateurController;
use App\Http\Controllers\NoteController;
use App\Models\Discipline;
use App\Models\Eleve;
use App\Models\Evaluation;
use App\Models\Niveau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/niveaux/{id}", [NiveauController::class, "getClasseById"]);
Route::get("/classes/{id}/eleves", [ClasseController::class, "getEleveById"]);


// Route::get("/eleve/liste/", [EleveController::class, "getNumero"]);
// Route::get("/eleve/liste/{num}", [EleveController::class, "getLastOut"]);



Route::resource("/niveaux", NiveauController::class);


Route::apiResource("/eleves", EleveController::class)->only(["store"]);

Route::get("/classes/{id}/coef", [DisciplineController::class, "getDisciplineByClasse"]);

Route::post("/classes/{id}/coef", [DisciplineController::class, "store"]);


// Route::get("/aly", [eleveController::class, "getNumeroDoAly"]);

Route::apiResource("/disciplines", DisciplineController::class)->only(["store", "index"]);

Route::apiResource("/evaluations", EvaluationController::class)->only(["store", "index"]);
// Route::post("/nabouta", [DisciplineController::class, "disciplineExiste"]);


Route::post("/classes/{classe}/disciplines/{discipline}/evals/{eval}", [NoteController::class, "addNote"]);

Route::put("/eleves/sortie", [EleveController::class, "sortie"]);

Route::get("/evenements", [EvenementController::class, "index"]);

Route::post("/evenements", [EvenementController::class, "store"]);

////


Route::get("/initiateurs", [InitiateurController::class, "index"]);

Route::post("/initiateurs", [InitiateurController::class, "store"]);

Route::post("/evenement/{id}/participations", [EvenementController::class, "addParticipation"]);


Route::put("/classes/{classe}/disciplines/{discipline}/evals/{eval}/eleve/{eleve}", [NoteController::class, "updateNote"]);




Route::get("/classes/{classe}/disciplines/{discipline}/note", [ClasseController::class, "getNoteBydiscipline"]);


Route::get("/classes/{classe}/notes", [ClasseController::class, "getNoteByClasse"]);



Route::get("/classes/{classe}/notes/eleves/{eleve}", [ClasseController::class, "getNoteStudent"]);



Route::get("/test", [InitiateurController::class, "carbo"]);


// Route::resource("/breukh-api/classe", CmangerlasseController::class);