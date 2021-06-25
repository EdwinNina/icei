<?php

namespace App\Http\Controllers;

use App\Models\PlanificacionCarrera;
use Illuminate\Http\Request;
use App\Models\PlanificacionModulo;

class CalendarioPlanificacionController extends Controller
{
    public function index()
    {
        return view('admin.calendario.index');
    }

    public function show(PlanificacionModulo $planificacion)
    {
        $planificacion = PlanificacionCarrera::join('planificacion_modulos as plm', 'plm.planificacion_carrera_id','=','planificacion_carreras.id')
            ->join('modulos as mo', 'mo.id','=','plm.modulo_id')
            ->join('carreras', 'carreras.id','=','mo.carrera_id')
            ->selectRaw("UPPER(CONCAT('Carrera: ',carreras.titulo,' - ', CONCAT(mo.version,' ',mo.titulo))) as title, plm.fecha_inicio as start, DATE_FORMAT(plm.fecha_fin,'%Y-%m-%d %23:%59:%59') as end")
            ->where('plm.fecha_inicio','!=',null)
            ->where('plm.fecha_fin','!=',null)
            ->where('planificacion_carreras.estado',1)
            ->get();

        return response()->json($planificacion);
    }
}
