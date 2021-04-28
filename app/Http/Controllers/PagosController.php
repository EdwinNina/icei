<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\PlanificacionModulo;

class PagosController extends Controller
{
    public function inscritosPlanificacion($id){

        $planificacionModulo = PlanificacionModulo::where('id',$id)->first();

        $inscritos = Inscripcion::leftJoin('estudiantes as es','inscripcions.estudiante_id','=','es.id')
        ->select('inscripcions.*')
        ->where([
            ['planificacion_carrera_id','=', $planificacionModulo->planificacion_carrera_id],
            ['modulo_id','=',$planificacionModulo->modulo_id],
            ['congelacion','=',0],
        ])->orderBy('es.paterno','asc')->paginate();

        return view('admin.pagos.estudiantes-inscritos-planificacion', compact('inscritos'));
    }
    public function pagosEstudiante(Inscripcion $inscripcion){
        return view('admin.pagos.pagos-estudiante', compact('inscripcion'));
    }
}
