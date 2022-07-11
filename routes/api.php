<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PerfilController;
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
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    // Perfil
    Route::resource('perfil', PerfilController::class)->only([
        'show', 'store', 'update', 'destroy'
    ]);

});



/*
    Route::prefix('perfil')->group(function () {
        Route::get('/', function () {
            // Matches The "/admin/users" URL
        });
    });
*/