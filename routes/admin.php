<?php

use App\Models\Nota;
use App\Models\Modulo;
use App\Models\Carrera;
use App\Models\Estudiante;
use App\Models\Inscripcion;
use Illuminate\Support\Facades\DB;
use App\Models\PlanificacionModulo;
use App\Models\PlanificacionCarrera;
use App\Models\AnterioresEstudiantes;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\NotasController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\CertificadoController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\PerfilDocenteController;
use App\Http\Controllers\ServiciosVariosController;
use App\Http\Controllers\CertificadoFinalController;
use App\Http\Controllers\InscripcionTallerController;
use App\Http\Controllers\RegistroEconomicoController;
use App\Http\Controllers\CertificadoTalleresController;
use App\Http\Controllers\InscripcionTalleresController;
use App\Http\Controllers\PlanificacionModuloController;
use App\Http\Controllers\PlanificacionTallerController;
use App\Http\Controllers\PlanificacionCarreraController;
use App\Http\Controllers\AnterioresEstudiantesController;

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
})->middleware('can:admin.categorias.index')->name('admin.categorias.index');

Route::get('horarios', function(){
    return view('admin.horarios.index');
})->middleware('can:admin.horarios.index')->name('admin.horarios.index');

Route::get('estudiantes', function(){
    return view('admin.estudiantes.index');
})->middleware('can:admin.estudiantes.index')->name('admin.estudiantes.index');

Route::get('docentes', function(){
    return view('admin.docentes.index');
})->middleware('can:admin.docentes.index')->name('admin.docentes.index');

Route::get('carreras', function(){
    return view('admin.carreras.index');
})->middleware('can:admin.carreras.index')->name('admin.carreras.index');

Route::get('modulos', function(){
    return view('admin.modulos.index');
})->middleware('can:admin.modulos.index')->name('admin.modulos.index');

Route::get('tipo-pagos', function(){
    return view('admin.tipoPagos.index');
})->middleware('can:admin.tipoPagos.index')->name('admin.tipoPagos.index');

Route::get('tipo-plan-pagos', function(){
    return view('admin.tipoPlanPagos.index');
})->middleware('can:admin.tipoPlanPagos.index')->name('admin.tipoPlanPagos.index');

Route::get('tipo-razones', function(){
    return view('admin.tipoRazon.index');
})->middleware('can:admin.tipoRazon.index')->name('admin.tipoRazon.index');

Route::get('usuarios', function(){
    return view('admin.usuarios.index');
})->middleware('can:admin.usuarios.index')->name('admin.usuarios.index');

Route::get('planificaciones-carrera', function(){
    return view('admin.planificacionCarrera.index');
})->middleware('can:admin.planificacionCarrera.index')->name('admin.planificacionCarrera.index');

Route::get('inscripciones', function(){
    return view('admin.inscripciones.index');
})->middleware('can:admin.inscripciones.index')->name('admin.inscripciones.index');

Route::get('aulas', function(){
    return view('admin.aulas.index');
})->middleware('can:admin.aulas.index')->name('admin.aulas.index');

Route::get('busqueda-planificacion-modulo', function(){
    return view('admin.busquedaPorPlanificacion.index');
})->middleware('can:admin.busquedaPorPlanificacion.index')->name('admin.busquedaPorPlanificacion.index');

Route::get('categoria-servicios-varios', function(){
    return view('admin.categoriaServiciosVarios.index');
})->middleware('can:admin.categoriaServiciosVarios.index')->name('admin.categoriaServiciosVarios.index');

Route::get('servicios-varios', function(){
    return view('admin.serviciosVarios.index');
})->middleware('can:admin.serviciosVarios.index')->name('admin.serviciosVarios.index');

Route::get('configuraciones', function(){
    return view('admin.configuraciones.index');
})->middleware('can:admin.configuraciones.index')->name('admin.configuraciones.index');

Route::get('talleres', function(){
    return view('admin.talleres.index');
})->name('admin.talleres.index');

Route::get('planificacion-talleres', function(){
    return view('admin.planificacionTaller.index');
})->name('admin.planificacionTaller.index');

Route::get('inscripcion-talleres', function(){
    return view('admin.inscripcionesTalleres.index');
})->name('admin.inscripcionesTalleres.index');

Route::get('anteriores-estudiantes', function(){
    return view('admin.anterioresEstudiantes.index');
})->middleware('can:admin.anterioresEstudiantes.index')->name('admin.anterioresEstudiantes.index');


Route::get('/perfil/{user}/edit', [PerfilDocenteController::class,'edit'])->middleware('can:docente.perfil.edit')->name('docente.perfil.edit');
Route::put('/perfil/{perfil}',[PerfilDocenteController::class,'update'])->name('docente.perfil.update');

Route::get('/carreras/create', [CarreraController::class,'create'])->name('admin.carreras.create');
Route::post('/carreras', [CarreraController::class,'store'])->name('admin.carreras.store');
Route::get('/carreras/{carrera}/edit', [CarreraController::class,'edit'])->name('admin.carreras.edit');
Route::put('/carreras/{carrera}', [CarreraController::class,'update'])->name('admin.carreras.update');

Route::get('/modulo/create', [ModuloController::class,'create'])->name('admin.modulos.create');
Route::post('/modulo', [ModuloController::class,'store'])->name('admin.modulos.store');
Route::get('/modulo/{modulo}/edit', [ModuloController::class,'edit'])->name('admin.modulos.edit');
Route::put('/modulo/{modulo}', [ModuloController::class,'update'])->name('admin.modulos.update');

Route::get('/inscripciones/create', [InscripcionController::class,'create'])->name('admin.inscripciones.create');
Route::post('/inscripciones', [InscripcionController::class,'store'])->name('admin.inscripciones.store');
Route::get('/inscripciones/{inscripcion}/edit', [InscripcionController::class,'edit'])->name('admin.inscripciones.edit');
Route::put('/inscripciones/{inscripcion}', [InscripcionController::class,'update'])->name('admin.inscripciones.update');
Route::get('/inscripciones/reporte/{inscripcion}', [InscripcionController::class,'generarPDF'])->name('admin.inscripciones.generarPDF');
Route::post('/inscripciones/anular', [InscripcionController::class,'anularInscripcion'])->name('admin.inscripciones.anularInscripcion');
Route::post('/inscripciones/reporte-pago/', [InscripcionController::class,'generarPdfPago'])->name('admin.inscripciones.generarPdfPago');
Route::post('/inscripciones/habilitar2t', [InscripcionController::class,'habilitar2t'])->name('admin.inscripciones.habilitar2t');
Route::post('/inscripciones/deshabilitar2t', [InscripcionController::class,'deshabilitar2t'])->name('admin.inscripciones.deshabilitar2t');
Route::post('/inscripciones/habilitarCertificado', [InscripcionController::class,'habilitarCertificado'])->name('admin.inscripciones.habilitarCertificado');
Route::post('/inscripciones/deshabilitarCertificado', [InscripcionController::class,'deshabilitarCertificado'])->name('admin.inscripciones.deshabilitarCertificado');
Route::post('/inscripciones/detalle-pago-inscripcion/', [InscripcionController::class,'detallePagoInscripcion'])->name('admin.inscripciones.detallePagoInscripcion');
Route::post('/inscripciones/detalle-pago-examen/', [InscripcionController::class,'detallePagoExamen'])->name('admin.inscripciones.detallePagoExamen');
Route::get('/inscripciones/detalle-pago-certificado/', [InscripcionController::class,'detallePagoCertificado'])->name('admin.inscripciones.detallePagoCertificado');
Route::put('/inscripciones/cambiar-carrera/{inscripcion}', [InscripcionController::class,'cambiarCarrera'])->name('admin.inscripciones.cambiarCarrera');
Route::post('/inscripciones/cambiarEstadoPagoInscripcion/', [InscripcionController::class,'cambiarEstadoPagoInscripcion'])->name('admin.inscripciones.cambiarEstadoPagoInscripcion');


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

Route::get('estado-pagos/inscritos-planificacion/{id}',[PagosController::class,'inscritosPlanificacion'])->name('admin.pagos.inscritos.planificacion');
Route::get('estado-pagos/estudiante/{inscripcion}',[PagosController::class,'pagosEstudiante'])->name('admin.pagos.pagosEstudiante');

Route::get('/servicios-varios/create', [ServiciosVariosController::class,'create'])->name('admin.serviciosVarios.create');
Route::post('/servicios-varios', [ServiciosVariosController::class,'store'])->name('admin.serviciosVarios.store');
Route::get('/servicios-varios/{servicio}/edit', [ServiciosVariosController::class,'edit'])->name('admin.serviciosVarios.edit');
Route::put('/servicios-varios/{servicio}', [ServiciosVariosController::class,'update'])->name('admin.serviciosVarios.update');
Route::post('/servicios-varios/reporte-pago/', [ServiciosVariosController::class,'generarPdfPago'])->name('admin.serviciosVarios.generarPdfPago');
Route::post('/servicios-varios/cambiarEstadoPago', [ServiciosVariosController::class,'cambiarEstadoPago'])->name('admin.inscripciones.cambiarEstadoPago');

Route::get('/notas-estudiantes/inscritos-planificacion/{id}',[NotasController::class,'inscritosPlanificacion'])->name('admin.notas.inscritos.planificacion');
Route::post('/notas-estudiantes/inscritos-planificacion/',[NotasController::class,'store'])->name('admin.notas.inscritos.store');

Route::resource('/roles', RoleController::class)->names('admin.roles');

Route::get('/certificados/solicitudes', [CertificadoController::class,'solicitados'])->name('admin.certificados.solicitados');
Route::get('/certificados/entregados', [CertificadoController::class,'entregados'])->name('admin.certificados.entregados');
Route::post('/certificados/solicitarFotos', [CertificadoController::class,'solicitarFotos'])->name('admin.certificados.solicitarFotos');
Route::post('/certificados/cancelarSolicitarFotos', [CertificadoController::class,'cancelarSolicitarFotos'])->name('admin.certificados.cancelarSolicitarFotos');
Route::get('/certificados/generar-certificado/{certificado}', [CertificadoController::class,'generarCertificado'])->name('admin.certificados.generarCertificado');
Route::post('/certificados/desactivarImpresion', [CertificadoController::class,'desactivarImpresion'])->name('admin.certificados.desactivarImpresion');
Route::post('/certificados/activarImpresion', [CertificadoController::class,'activarImpresion'])->name('admin.certificados.activarImpresion');
Route::post('/certificados/entregaCertificado', [CertificadoController::class,'entregaCertificado'])->name('admin.certificados.entregaCertificado');


Route::get('/certificados-final', [CertificadoFinalController::class,'index'])->name('admin.certificadoFinal.index');
Route::post('/certificados-final/busqueda', [CertificadoFinalController::class,'busqueda'])->name('admin.certificadoFinal.busqueda');
Route::post('/certificados-final/guardarCertificado', [CertificadoFinalController::class,'guardarCertificado'])->name('admin.certificadoFinal.guardarCertificado');
Route::get('/certificados-final/estado/{certificado}', [CertificadoFinalController::class,'detalleCertificado'])->name('admin.certificadoFinal.detalleCertificado');
Route::put('/certificados-final/{certificado}', [CertificadoFinalController::class,'update'])->name('admin.certificadoFinal.update');
Route::post('/certificados-final/reporte-pago/', [CertificadoFinalController::class,'generarPdfPago'])->name('admin.certificadoFinal.generarPdfPago');
Route::get('/certificados-final/solicitudes', [CertificadoFinalController::class,'solicitados'])->name('admin.certificadoFinal.solicitados');
Route::get('/certificados-final/entregados', [CertificadoFinalController::class,'entregados'])->name('admin.certificadoFinal.entregados');
Route::post('/certificados-final/desactivarImpresion', [CertificadoFinalController::class,'desactivarImpresion'])->name('admin.certificadoFinal.desactivarImpresion');
Route::post('/certificados-final/activarImpresion', [CertificadoFinalController::class,'activarImpresion'])->name('admin.certificadoFinal.activarImpresion');
Route::post('/certificados-final/solicitarFotos', [CertificadoFinalController::class,'solicitarFotos'])->name('admin.certificadoFinal.solicitarFotos');
Route::post('/certificados-final/cancelarSolicitarFotos', [CertificadoFinalController::class,'cancelarSolicitarFotos'])->name('admin.certificadoFinal.cancelarSolicitarFotos');
Route::post('/certificados-final/entregaCertificado', [CertificadoFinalController::class,'entregaCertificado'])->name('admin.certificadoFinal.entregaCertificado');
Route::get('/certificados-final/generar-certificado/{certificado}', [CertificadoFinalController::class,'generarCertificado'])->name('admin.certificadoFinal.generarCertificado');
Route::post('/certificados-final/cancelarSolicitud', [CertificadoFinalController::class,'cancelarSolicitud'])->name('admin.certificadoFinal.cancelarSolicitud');
Route::post('/certificados-final/cambiarEstadoPago', [CertificadoFinalController::class,'cambiarEstadoPago'])->name('admin.certificadoFinal.cambiarEstadoPago');


Route::get('/certificados-talleres/solicitudes', [CertificadoTalleresController::class,'solicitados'])->name('admin.certificadosTalleres.solicitados');
Route::get('/certificados-talleres/entregados', [CertificadoTalleresController::class,'entregados'])->name('admin.certificadosTalleres.entregados');
Route::get('/certificados-talleres/generar-certificado/{certificado}', [CertificadoTalleresController::class,'generarCertificado'])->name('admin.certificadosTalleres.generarCertificado');
Route::post('/certificados-talleres/desactivarImpresion', [CertificadoTalleresController::class,'desactivarImpresion'])->name('admin.certificadosTalleres.desactivarImpresion');
Route::post('/certificados-talleres/activarImpresion', [CertificadoTalleresController::class,'activarImpresion'])->name('admin.certificadosTalleres.activarImpresion');
Route::post('/certificados-talleres/entregaCertificado', [CertificadoTalleresController::class,'entregaCertificado'])->name('admin.certificadosTalleres.entregaCertificado');

Route::post('/registroEconomico/anular', [RegistroEconomicoController::class,'anularPago'])->name('admin.registroEconomico.anularPago');

Route::get('/planificacion-talleres/create', [PlanificacionTallerController::class,'create'])->name('admin.planificacionTaller.create');
Route::post('/planificacion-talleres', [PlanificacionTallerController::class,'store'])->name('admin.planificacionTaller.store');
Route::get('/planificacion-talleres/{planificacion}/edit', [PlanificacionTallerController::class,'edit'])->name('admin.planificacionTaller.edit');
Route::put('/planificacion-talleres/{planificacion}', [PlanificacionTallerController::class,'update'])->name('admin.planificacionTaller.update');
Route::get('/planificacion-talleres/{planificacion}', [PlanificacionTallerController::class,'show'])->name('admin.planificacionTaller.show');

Route::get('/inscripcion-taller/create', [InscripcionTalleresController::class,'create'])->name('admin.inscripcionesTalleres.create');
Route::post('/inscripcion-taller', [InscripcionTalleresController::class,'store'])->name('admin.inscripcionesTalleres.store');
Route::get('/inscripcion-taller/{inscripcion}/edit', [InscripcionTalleresController::class,'edit'])->name('admin.inscripcionesTalleres.edit');
Route::put('/inscripcion-taller/{inscripcion}', [InscripcionTalleresController::class,'update'])->name('admin.inscripcionesTalleres.update');
Route::post('/inscripcion-taller/reporte-pago/', [InscripcionTalleresController::class,'generarPdfPago'])->name('admin.inscripcionesTalleres.generarPdfPago');
Route::post('/inscripcion-taller/habilitarCertificado', [InscripcionTalleresController::class,'habilitarCertificado'])->name('admin.inscripcionesTalleres.habilitarCertificado');
Route::post('/inscripcion-taller/deshabilitarCertificado', [InscripcionTalleresController::class,'deshabilitarCertificado'])->name('admin.inscripcionesTalleres.deshabilitarCertificado');

Route::get('/dashboard', [DashboardController::class,'index'])->middleware('can:admin.dashboard.index') ->name('admin.dashboard.index');
Route::post('/estado-certificados', [DashboardController::class,'estadoCertificados'])->name('admin.dashboard.estadoCertificados');
