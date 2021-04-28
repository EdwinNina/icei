<?php

namespace App\Observers;

use App\Models\PlanificacionCarrera;

class PlanificacionCarreraObserver
{
    /**
     * Handle the PlanificacionCarrera "created" event.
     *
     * @param  \App\Models\PlanificacionCarrera  $planificacionCarrera
     * @return void
     */
    public function created(PlanificacionCarrera $planificacionCarrera)
    {
        $planificacionCarrera->codigo = 'PLAN-'. date('Y') .'-' .str_pad($planificacionCarrera->id, 8, "0", STR_PAD_LEFT);

        $planificacionCarrera->save();
    }
}
