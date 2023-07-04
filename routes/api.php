<?php

use App\Http\Controllers\NiveauController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\AnnneScolaireController;
use App\Models\Eleve;
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
Route::get("/classe/{id}/eleve", [ClasseController::class, "getEleveById"]);


Route::get("/eleve/liste/", [EleveController::class, "getNumero"]);
// Route::get("/eleve/liste/{num}", [EleveController::class, "getLastOut"]);



Route::resource("/niveaux", NiveauController::class);


Route::apiResource("/eleves", EleveController::class)->only(["store"]);



// Route::resource("/breukh-api/classe", ClasseController::class);