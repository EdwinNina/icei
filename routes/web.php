<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\PerfilDocenteController;

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

Route::get('/', [InicioController::class, 'index'])->name('inicio');
Route::get('/cursos', [InicioController::class, 'cursos'])->name('cursos');
Route::get('/cursos/{curso}', [InicioController::class, 'detalleCurso'])->name('detalleCurso');

Route::get('/perfil/{perfil}', [PerfilDocenteController::class,'show'])->name('docente.perfil.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

