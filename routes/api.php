<?php

use App\Http\Controllers\ResultadosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/resultados', [ResultadosController::class, 'index']);
Route::get('/resultados/loterias', [ResultadosController::class, 'loterias']);
Route::get('/resultados/triplefacil', [ResultadosController::class, 'tripleFacil']);
Route::get('/resultados/granjaplus', [ResultadosController::class, 'granjaPlus']);
Route::get('/resultados/tuazaranimalitos', [ResultadosController::class, 'tuAzarAnimalitos']);
Route::get('/resultados/tuazartriples', [ResultadosController::class, 'tuAzarTriples']);