<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\InscripcionController;
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
})->name('admin.categoria.index');

Route::get('horarios', function(){
    return view('admin.horarios.index');
})->name('admin.horario.index');

Route::get('estudiantes', function(){
    return view('admin.estudiantes.index');
})->name('admin.estudiante.index');

Route::get('docentes', function(){
    return view('admin.docentes.index');
})->name('admin.docente.index');

Route::get('carreras', function(){
    return view('admin.carreras.index');
})->name('admin.carreras.index');

Route::get('modulos', function(){
    return view('admin.modulos.index');
})->name('admin.modulo.index');

Route::get('tipo-pagos', function(){
    return view('admin.tipoPagos.index');
})->name('admin.tipoPagos.index');

Route::get('usuarios', function(){
    return view('admin.usuarios.index');
})->name('admin.usuarios.index');

Route::get('planificaciones', function(){
    return view('admin.planificacionCarrera.index');
})->name('admin.planificacionCarrera.index');

Route::get('inscripciones', function(){
    return view('admin.inscripciones.index');
})->name('admin.inscripciones.index');

Route::get('/perfil/{user}/edit', [PerfilDocenteController::class,'edit'])->name('docente.perfil.edit');
Route::put('/perfil/{perfil}',[PerfilDocenteController::class,'update'])->name('docente.perfil.update');

Route::get('/carreras/create', [CarreraController::class,'create'])->name('admin.carreras.create');
Route::post('/carreras', [CarreraController::class,'store'])->name('admin.carreras.store');
Route::get('/carreras/{carrera}/edit', [CarreraController::class,'edit'])->name('admin.carreras.edit');
Route::put('/carreras/{carrera}', [CarreraController::class,'update'])->name('admin.carreras.update');

Route::get('/modulo/create', [ModuloController::class,'create'])->name('admin.modulos.create');
Route::post('/modulo', [ModuloController::class,'store'])->name('admin.modulos.store');
Route::get('/modulo/{modulo}/edit', [ModuloController::class,'edit'])->name('admin.modulos.edit');
Route::put('/modulo/{modulo}', [ModuloController::class,'update'])->name('admin.modulos.update');

Route::get('/inscripciones/estudiante/{estudiante}', [InscripcionController::class,'create'])->name('admin.inscripciones.create');
Route::post('/inscripciones', [InscripcionController::class,'store'])->name('admin.inscripciones.store');
Route::get('/inscripciones/{inscripcion}/edit', [InscripcionController::class,'edit'])->name('admin.inscripciones.edit');
Route::put('/inscripciones/{inscripcion}', [InscripcionController::class,'update'])->name('admin.inscripciones.update');
