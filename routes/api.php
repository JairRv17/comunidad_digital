<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CartaController;
use App\Http\Controllers\API\ColeccionController;
use App\Http\Controllers\API\PerfilController;
use App\Http\Controllers\API\PropiedadAdicionalController;
use App\Http\Controllers\API\RarezaController;
use App\Http\Controllers\API\TipoColeccionController;
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
// Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('login', [AuthController::class, 'index']);
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::resource('perfil', PerfilController::class)->only([
        'show', 'store', 'update', 'destroy'
    ]);
    Route::resource('coleccion', ColeccionController::class)->only([
        'show', 'store', 'update', 'destroy'
    ]);
    Route::resource('tipo-coleccion', TipoColeccionController::class)->only([
        'show', 'store', 'update', 'destroy'
    ]);
    Route::resource('carta', CartaController::class)->only([
        'show', 'store', 'update', 'destroy'
    ]);
    Route::resource('rareza', RarezaController::class)->only([
        'show', 'store', 'update', 'destroy'
    ]);
    Route::resource('propiedades-adicionales', PropiedadAdicionalController::class)->only([
        'show', 'store', 'update', 'destroy'
    ]);
    Route::get('coleccion/propiedades-adicionales/{coleccion_id}', [PropiedadAdicionalController::class, 'propiedadByColection']);
    Route::post('cartas/propiedades-adicionales', [CartaController::class, 'storePropiedadesAdicionales']);

});

// Test
// Route::get('test', function () {
//     return view('test');
// });

/*
    Route::prefix('perfil')->group(function () {
        Route::get('/', function () {
            // Matches The "/admin/users" URL
        });
    });
*/
