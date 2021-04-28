<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Modulo;
use App\Models\PlanificacionCarrera;
use App\Models\PlanificacionModulo;
use Illuminate\Http\Request;

class PlanificacionModuloController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.planificacionModulo.create')->only('create','store');
        $this->middleware('can:admin.planificacionModulo.edit')->only('edit','update');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $verificacion = PlanificacionModulo::where('planificacion_carrera_id',$id)->get();
        $aulas = Aula::where('estado','1')->get();

        if(count($verificacion) > 0){
            return view('admin.planificacionModulo.edit', compact('verificacion','aulas'));
        }else{
            $planificacion = PlanificacionCarrera::where('id',$id)->first();

            $modulos = Modulo::where('carrera_id', $planificacion->carrera_id)->get();

            return view('admin.planificacionModulo.create', compact('modulos','planificacion','aulas'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* $rules = [
            'registros.*.fecha_inicio' => 'required',
            'registros.*.fecha_fin' => 'required',
        ];

        $messages = [
            'registros.*.fecha_inicio.required' => 'La fecha de inicio es requerida',
            'registros.*.fecha_fin.required' =>'La fecha de finalización es requerida',
        ]; */

/*         $this->validate($request, $rules, $messages); */
        if($request->planificacion_id){
            foreach ($request->registros as $registro) {
                PlanificacionModulo::updateOrCreate([
                    'planificacion_carrera_id' => $request->planificacion_id,
                    'modulo_id' => $registro['modulo_id'],
                    'aula_id' => $registro['aula_id'],
                    'fecha_inicio' => $registro['fecha_inicio'],
                    'fecha_fin' => $registro['fecha_fin'],
                    'observaciones' => $registro['observaciones'],
                ]);
            }
        }else{
            foreach ($request->registros as $registro) {
                PlanificacionModulo::where('id', $registro['id'])->update([
                    'planificacion_carrera_id' => $registro['planificacion_carrera_id'],
                    'modulo_id' => $registro['modulo_id'],
                    'aula_id' => $registro['aula_id'],
                    'habilitar_notas' => $registro['habilitar_notas'],
                    'fecha_inicio' => $registro['fecha_inicio'],
                    'fecha_fin' => $registro['fecha_fin'],
                    'observaciones' => $registro['observaciones'],
                ]);
            }
        }
        return redirect()->route('admin.planificacionCarrera.index')->with('message', 'Planificación realizada con exito');;
    }
}
