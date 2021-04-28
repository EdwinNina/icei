<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use App\Models\Inscripcion;
use App\Models\Nota;
use App\Models\PlanificacionModulo;
use Illuminate\Http\Request;

class NotasController extends Controller
{
    public function inscritosPlanificacion($id){
        $verificacion = Nota::join('estudiantes as es','notas.estudiante_id','=','es.id')
            ->select('notas.*')
            ->where('planificacion_modulo_id',$id)
            ->orderBy('es.paterno','asc')
            ->get();
        $configuracion = Configuracion::select('nota_minima_aprobacion')->first();
        $planificacionModulo = PlanificacionModulo::where('id',$id)->first();
        if(count($verificacion) > 0){
            return view('admin.notas.edit', compact('verificacion','configuracion','planificacionModulo'));
        }else{
            $inscritos = Inscripcion::join('estudiantes as es','inscripcions.estudiante_id','=','es.id')
                ->where([
                    ['planificacion_carrera_id','=', $planificacionModulo->planificacion_carrera_id],
                    ['modulo_id','=',$planificacionModulo->modulo_id],
                    ['congelacion','=',0],
                    ['saldo','=',0],
                ])->orderBy('es.paterno','asc')->get();

            return view('admin.notas.create', compact('inscritos','planificacionModulo','configuracion'));
        }
    }

    public function store(Request $request){
        $configuracion = Configuracion::select('nota_minima_aprobacion')->first();
        if($request->planificacion_modulo_id){
            foreach ($request->registros as $registro) {
                Nota::updateOrCreate([
                    'planificacion_modulo_id' => $request->planificacion_modulo_id,
                    'estudiante_id' => $registro['estudiante_id'],
                    'nota_1' => $registro['nota_1'],
                    'nota_2' => $registro['nota_2'],
                    'nota_final' => $registro['nota_final'],
                    'estado' => $registro['nota_final'] >= $configuracion->nota_minima_aprobacion ? '1' : '2',
                ]);
            }
            return redirect()->back()->with('message', 'Agregado de notas realizada con exito');;
        }else{
            foreach ($request->registros as $registro) {
                Nota::where('id', $registro['id'])->update([
                    'planificacion_modulo_id' => $registro['planificacion_modulo_id'],
                    'estudiante_id' => $registro['estudiante_id'],
                    'nota_1' => $registro['nota_1'],
                    'nota_2' => $registro['nota_2'],
                    'nota_final' => $registro['nota_final'],
                    'estado' => $registro['nota_final'] >= $configuracion->nota_minima_aprobacion ? '1' : '2',
                ]);
            }
            return redirect()->back()->with('message', 'Edición de notas realizada con exito');;
        }
    }
}
