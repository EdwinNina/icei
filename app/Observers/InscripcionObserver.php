<?php

namespace App\Observers;

use App\Models\Nota;
use App\Models\Inscripcion;
use App\Models\PlanificacionModulo;

class InscripcionObserver
{

    public function created(Inscripcion $inscripcion)
    {
        $estudiante = $inscripcion->estudiante->id;
        $verificacion = Nota::where('estudiante_id', $estudiante)->first();

        if(!$verificacion && $inscripcion->saldo == "0.00" || $inscripcion->saldo == "0"){
            $planificacionModulo = PlanificacionModulo::where([
                ['planificacion_carrera_id', '=', $inscripcion->planificacionCarrera->id],
                ['modulo_id', '=', $inscripcion->modulo_id],
            ])->first();
            Nota::create([
                'estudiante_id' => $estudiante,
                'planificacion_modulo_id' => $planificacionModulo->id
            ]);
        }
    }

    /**
     * Handle the Inscripcion "updated" event.
     *
     * @param  \App\Models\Inscripcion  $inscripcion
     * @return void
     */
    public function updated(Inscripcion $inscripcion)
    {
        $estudiante = $inscripcion->estudiante->id;
        $planificacionModulo = PlanificacionModulo::where([
            ['planificacion_carrera_id', '=', $inscripcion->planificacionCarrera->id],
            ['modulo_id', '=', $inscripcion->modulo_id],
        ])->first();

        $notaEncontrada = Nota::where('estudiante_id', $estudiante)->where('planificacion_modulo_id',$planificacionModulo->id)->first();

        if($inscripcion->saldo == "0.00" || $inscripcion->saldo == "0"){
            if ($notaEncontrada == null) {
                Nota::create([
                    'estudiante_id' => $estudiante,
                    'planificacion_modulo_id' => $planificacionModulo->id
                ]);
            }
        }else{
            if ($notaEncontrada != null) {
                Nota::where([
                    'estudiante_id' => $estudiante,
                    'planificacion_modulo_id' => $planificacionModulo->id
                ])->delete();
            }else{
                Nota::create([
                    'estudiante_id' => $estudiante,
                    'planificacion_modulo_id' => $planificacionModulo->id
                ]);
            }
        }
    }
}
