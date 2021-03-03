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
})->name('admin.carrera.index');

Route::get('modulos', function(){
    return view('admin.modulos.index');
})->name('admin.modulo.index');

Route::get('tipo-pagos', function(){
    return view('admin.tipoPagos.index');
})->name('admin.tipoPagos.index');

Route::get('usuarios', function(){
    return view('admin.usuarios.index');
})->name('admin.usuarios.index');

Route::get('/perfil/{user}/edit', [PerfilDocenteController::class,'edit'])->name('docente.perfil.edit');
Route::put('/perfil/{perfil}',[PerfilDocenteController::class,'update'])->name('docente.perfil.update');

Route::get('/carreras/create', [CarreraController::class,'create'])->name('admin.carrera.create');
Route::post('/carreras', [CarreraController::class,'store'])->name('admin.carrera.store');
Route::get('/carreras/{carrera}/edit', [CarreraController::class,'edit'])->name('admin.carrera.edit');
Route::put('/carreras/{carrera}', [CarreraController::class,'update'])->name('admin.carrera.update');

Route::get('/modulo/create', [ModuloController::class,'create'])->name('admin.modulo.create');
Route::post('/modulo', [ModuloController::class,'store'])->name('admin.modulo.store');
Route::get('/modulo/{modulo}/edit', [ModuloController::class,'edit'])->name('admin.modulo.edit');
Route::put('/modulo/{modulo}', [ModuloController::class,'update'])->name('admin.modulo.update');
