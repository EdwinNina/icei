<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Docente;
use App\Models\Horario;
use App\Models\Modalidad;
use App\Models\PlanificacionCarrera;
use Illuminate\Http\Request;

class PlanificacionCarreraController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.planificacionCarrera.create')->only('create','store');
        $this->middleware('can:admin.planificacionCarrera.edit')->only('edit','update');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carreras = Carrera::select('titulo','id')->get();
        $modalidades = Modalidad::get();
        $horarios = Horario::get();
        $docentes = Docente::select('nombre','paterno','materno','id')->get();
        $anio = date('Y');

        return view('admin.planificacionCarrera.create', compact('carreras','modalidades','horarios','docentes','anio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'carrera' => 'required',
            'docente' => 'required',
            'horario' => 'required',
            'modalidad' => 'required',
            'costo_carrera' => 'required',
            'costo_modulo' => 'required',
        ]);

        $codigo = "Plan-".date('Y');
        $planificacion = PlanificacionCarrera::create([
            'carrera_id' => $request->carrera,
            'docente_id' => $request->docente,
            'horario_id' => $request->horario,
            'modalidad_id' => $request->modalidad,
            'costo_carrera' => $request->costo_carrera,
            'costo_modulo' => $request->costo_modulo,
            'observaciones' => $request->observaciones,
            'gestion' => date('Y'),
            'codigo' => $codigo
        ]);

        return redirect()->route('admin.planificacionModulo.create', $planificacion->id);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PlanificacionCarrera $planificacion)
    {
        $carreras = Carrera::select('titulo','id')->get();
        $modalidades = Modalidad::get();
        $horarios = Horario::get();
        $docentes = Docente::select('nombre','paterno','id')->get();
        $anio = date('Y');

        return view('admin.planificacionCarrera.edit', compact('carreras','modalidades','horarios','docentes','anio','planificacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlanificacionCarrera $planificacion)
    {
        $planificacion->costo_carrera = $request->costo_carrera;
        $planificacion->carrera_id = $request->carrera;
        $planificacion->docente_id = $request->docente;
        $planificacion->horario_id = $request->horario;
        $planificacion->modalidad_id = $request->modalidad;
        $planificacion->costo_modulo = $request->costo_modulo;
        $planificacion->observaciones = $request->observaciones;
        $planificacion->save();
        return redirect()->route('admin.planificacionCarrera.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
