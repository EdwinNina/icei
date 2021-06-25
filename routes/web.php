<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotasController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\KardexEstudianteController;
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
Route::get('/curso/{carrera}', [InicioController::class, 'detalleCurso'])->name('detalleCurso');

Route::get('/perfil/{perfil}', [PerfilDocenteController::class,'show'])->name('docente.perfil.show');

Route::get('notas-estudiantes', function(){
    return view('admin.notas.index');
})->middleware('can:docente.notas.index')->name('docente.notas.index');

Route::get('historial-academico', [KardexEstudianteController::class,'academico'])->middleware('can:estudiante.kardex.academico')->name('estudiante.kardex.academico');
Route::get('historial-economico', [KardexEstudianteController::class,'economico'])->middleware('can:estudiante.kardex.economico')->name('estudiante.kardex.economico');

Route::get('/notas-estudiantes/inscritos-planificacion/{id}',[NotasController::class,'inscritosPlanificacion'])->name('admin.notas.inscritos.planificacion');
Route::post('/notas-estudiantes/inscritos-planificacion/',[NotasController::class,'store'])->name('admin.notas.inscritos.store');
