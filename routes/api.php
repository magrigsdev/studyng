<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FraisController;
use App\Http\Controllers\NiveauxController;
use App\Http\Controllers\TypeEtablissement;
use App\Http\Controllers\DiplomesController;
use App\Http\Controllers\TypeFraisController;
use App\Http\Controllers\FormationsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//getItem type etablissement
Route::get('typeEtab_getData', [TypeEtablissement::class,'getData']);
Route::get('typeEtab_getItem/{id}', [TypeEtablissement::class,'getItem']);

//getItem type Niveau
Route::get('niv_getData', [NiveauxController::class,'getData']);
Route::get('niv_getItem/{id}', [NiveauxController::class,'getItem']);

//diplomes
Route::get('dip_getData', [DiplomesController::class,'getData']);
Route::get('dip_getItem/{id}', [DiplomesController::class,'getItem']);

//Frais
Route::get('fra_getData', [FraisController::class,'getData']);
Route::get('fra_getItem/{id}', [FraisController::class,'getItem']);

//Formation
Route::get('for_getData', [FormationsController::class,'getData']);
Route::get('for_getItem/{id}', [FormationsController::class,'getItem']);

//Frais type 
Route::get('typ_fra_getData', [TypeFraisController::class,'getData']);
Route::get('typ_fra_getItem/{id}', [TypeFraisController::class,'getItem']);