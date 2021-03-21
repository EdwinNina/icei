<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\PerfilDocenteController;
use App\Http\Controllers\PlanificacionCarreraController;
use App\Http\Controllers\PlanificacionModuloController;

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
})->name('admin.categorias.index');

Route::get('horarios', function(){
    return view('admin.horarios.index');
})->name('admin.horarios.index');

Route::get('estudiantes', function(){
    return view('admin.estudiantes.index');
})->name('admin.estudiantes.index');

Route::get('docentes', function(){
    return view('admin.docentes.index');
})->name('admin.docentes.index');

Route::get('carreras', function(){
    return view('admin.carreras.index');
})->name('admin.carreras.index');

Route::get('modulos', function(){
    return view('admin.modulos.index');
})->name('admin.modulos.index');

Route::get('tipo-pagos', function(){
    return view('admin.tipoPagos.index');
})->name('admin.tipoPagos.index');

Route::get('tipo-plan-pagos', function(){
    return view('admin.tipoPlanPagos.index');
})->name('admin.tipoPlanPagos.index');

Route::get('usuarios', function(){
    return view('admin.usuarios.index');
})->name('admin.usuarios.index');

Route::get('planificaciones-carrera', function(){
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
Route::get('/inscripciones/reporte/{inscripcion}', [InscripcionController::class,'generarPDF'])->name('admin.inscripciones.generarPDF');

Route::get('/modulosInscritos/{estudiante}', [EstudianteController::class, 'modulosInscritos'])->name('admin.estudiantes.modulosInscritos');
Route::get('/modulosInscritos/generarPdf/{estudiante}', [EstudianteController::class, 'generarPdfModulosInscritos'])->name('admin.estudiantes.generarPdfModulosInscritos');

Route::get('/planificaciones-carrera/create', [PlanificacionCarreraController::class,'create'])->name('admin.planificacionCarrera.create');
Route::post('/planificaciones-carrera', [PlanificacionCarreraController::class,'store'])->name('admin.planificacionCarrera.store');
Route::get('/planificaciones-carrera/{planificacion}/edit', [PlanificacionCarreraController::class,'edit'])->name('admin.planificacionCarrera.edit');
Route::put('/planificaciones-carrera/{planificacion}', [PlanificacionCarreraController::class,'update'])->name('admin.planificacionCarrera.update');

Route::get('/planificaciones-modulo/{id}/create', [PlanificacionModuloController::class,'create'])->name('admin.planificacionModulo.create');
Route::post('/planificaciones-modulo', [PlanificacionModuloController::class,'store'])->name('admin.planificacionModulo.store');
Route::get('/planificaciones-modulo/{planificacion}/edit', [PlanificacionModuloController::class,'edit'])->name('admin.planificacionModulo.edit');
Route::put('/planificaciones-modulo/{planificacion}', [PlanificacionModuloController::class,'update'])->name('admin.planificacionModulo.update');
