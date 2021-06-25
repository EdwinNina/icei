<?php

use App\Http\Controllers\CarreraController;
use App\Http\Controllers\EstudianteLoginApiController;
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


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/estudiante-info', [EstudianteLoginApiController::class, 'estudianteInfo']);
    Route::post('/informacion-academica', [EstudianteLoginApiController::class,'academico']);
    Route::post('/logout', [EstudianteLoginApiController::class,'logout']);
});

Route::post('/login', [EstudianteLoginApiController::class, 'login']);


Route::post('/obtenerCarreras', [CarreraController::class, 'getCarreras']);

