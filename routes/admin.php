<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\CarreraController;
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

Route::get('categorias', function(){
    return view('admin.categorias.index');
})->name('categoria.index');

Route::get('horarios', function(){
    return view('admin.horarios.index');
})->name('horario.index');

Route::get('estudiantes', function(){
    return view('admin.estudiantes.index');
})->name('estudiante.index');

Route::get('docentes', function(){
    return view('admin.docentes.index');
})->name('docente.index');

Route::get('carreras', function(){
    return view('admin.carreras.index');
})->name('admin.carrera.index');

Route::get('modulos', function(){
    return view('admin.modulos.index');
})->name('admin.modulo.index');

Route::get('/perfil/{docente}', [PerfilDocenteController::class,'show'])->name('docente.perfil.show');
Route::get('/perfil/{perfil}/edit', [PerfilDocenteController::class,'edit'])->name('docente.perfil.edit');
Route::put('/perfil/{perfil}',[PerfilDocenteController::class,'update'])->name('docente.perfil.update');

Route::get('/carreras/create', [CarreraController::class,'create'])->name('admin.carrera.create');
Route::post('/carreras', [CarreraController::class,'store'])->name('admin.carrera.store');
Route::get('/carreras/{carrera}/edit', [CarreraController::class,'edit'])->name('admin.carrera.edit');
Route::put('/carreras/{carrera}', [CarreraController::class,'update'])->name('admin.carrera.update');
Route::get('/carreras/{carrera}', [CarreraController::class,'show'])->name('admin.carrera.show');

Route::get('/modulo/create', [ModuloController::class,'create'])->name('admin.modulo.create');
Route::post('/modulo', [ModuloController::class,'store'])->name('admin.modulo.store');
Route::get('/modulo/{modulo}/edit', [ModuloController::class,'edit'])->name('admin.modulo.edit');
Route::put('/modulo/{modulo}', [ModuloController::class,'update'])->name('admin.modulo.update');
