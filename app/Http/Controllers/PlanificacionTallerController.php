<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Horario;
use App\Models\Modalidad;
use App\Models\PlanificacionTaller;
use App\Models\Taller;
use Illuminate\Http\Request;

class PlanificacionTallerController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $docentes = Docente::where('estado',1)->select('nombre','paterno','materno','id')->get();
        $horarios = Horario::where('estado',1)->get();
        $modalidades = Modalidad::get();
        $talleres = Taller::where('estado',1)->get();
        return view('admin.planificacionTaller.create', compact('docentes','horarios','talleres','modalidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'costo' => 'required|numeric|min:2',
            'duracion' => 'required|numeric',
            'carga_horaria' => 'required|numeric',
            'requisitos' => 'required',
            'docente'=> 'required',
            'horario' => 'required',
            'taller' => 'required',
            'modalidad' => 'required',
        ]);
        $planificacion = PlanificacionTaller::create([
            'fecha_inicio' => $validation['fecha_inicio'],
            'fecha_fin' => $validation['fecha_fin'],
            'costo' => $validation['costo'],
            'duracion' => $validation['duracion'],
            'carga_horaria' => $validation['carga_horaria'],
            'requisitos' => mb_strtolower($validation['requisitos']),
            'docente_id'=> $validation['docente'],
            'horario_id' => $validation['horario'],
            'taller_id' => $validation['taller'],
            'modalidad_id' => $validation['modalidad']
        ]);
        if($planificacion){
            return redirect()->route('admin.planificacionTaller.show', $planificacion->id)->with('message','good');
        }else{
            return redirect()->route('admin.planificacionTaller.index')->with('message','bad');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PlanificacionTaller $planificacion)
    {
        return view('admin.planificacionTaller.show', compact('planificacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PlanificacionTaller $planificacion)
    {
        $docentes = Docente::where('estado',1)->select('nombre','paterno','materno','id')->get();
        $horarios = Horario::where('estado',1)->get();
        $talleres = Taller::where('estado',1)->get();
        $modalidades = Modalidad::get();
        return view('admin.planificacionTaller.edit', compact('docentes','horarios','talleres','planificacion','modalidades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlanificacionTaller $planificacion)
    {
        $validation = $request->validate([
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'costo' => 'required|numeric|min:2',
            'duracion' => 'required|numeric',
            'carga_horaria' => 'required|numeric',
            'requisitos' => 'required',
            'docente'=> 'required',
            'horario' => 'required',
            'taller' => 'required',
            'modalidad' => 'required',
        ]);

        $planificacion->fecha_inicio = $validation['fecha_inicio'];
        $planificacion->fecha_fin = $validation['fecha_fin'];
        $planificacion->costo = $validation['costo'];
        $planificacion->duracion = $validation['duracion'];
        $planificacion->carga_horaria = $validation['carga_horaria'];
        $planificacion->requisitos = mb_strtolower($validation['requisitos']);
        $planificacion->docente_id = $validation['docente'];
        $planificacion->horario_id = $validation['horario'];
        $planificacion->taller_id = $validation['taller'];
        $planificacion->modalidad_id = $validation['modalidad'];
        $planificacion->save();

        if($planificacion){
            return redirect()->route('admin.planificacionTaller.show', $planificacion->id)->with('message','good');
        }else{
            return redirect()->route('admin.planificacionTaller.index')->with('message','bad');
        }
    }

}
