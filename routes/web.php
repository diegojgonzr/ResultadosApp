<?php

use App\Http\Controllers\ResultadosController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/configurar-cache', function() {
    //probaria esto primero
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
    //si no funciona el anterior probaria este
    //$exitCode = Artisan::call('key:generate');
});

Route::get('/resultados/prueba', [ResultadosController::class, 'prueba']);