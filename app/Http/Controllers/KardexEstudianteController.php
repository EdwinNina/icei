<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Estudiante;
use App\Models\Inscripcion;
use App\Models\InscripcionTaller;
use App\Models\Servicio;
use App\Models\Taller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KardexEstudianteController extends Controller
{
    public function academico()
    {
        $estudiante_id_activo = Auth::user()->usuarioGeneral->generable_id;
        $carreras = Carrera::select('id', 'titulo')->get();
        $estudiante = Estudiante::where('id', $estudiante_id_activo)->first();

        return view('admin.kardex.index', compact('carreras','estudiante','estudiante_id_activo'));
    }

    public function economico()
    {
        $estudiante_id_activo = Auth::user()->usuarioGeneral->generable_id;
        $estudiante = Estudiante::where('id', $estudiante_id_activo)->first();
        $inscripciones = Inscripcion::where('estudiante_id',$estudiante->id)->get();
        $servicios = Servicio::where('estudiante_id',$estudiante->id)->get();
        $talleres = InscripcionTaller::where('estudiante_id',$estudiante->id)->get();

        return view('admin.kardex.detalle-economico', compact('inscripciones','servicios','talleres'));
    }
}
