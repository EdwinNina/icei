<?php

namespace App\Observers;

use App\Models\RegistroEconomico;

class RegistroEconomicoObserver
{
    /**
     * Handle the RegistroEconomico "created" event.
     *
     * @param  \App\Models\RegistroEconomico  $registroEconomico
     * @return void
     */
    public function created(RegistroEconomico $registroEconomico)
    {
        $registroEconomico->numeroFactura = str_pad($registroEconomico->id, 10, "0", STR_PAD_LEFT);
        $registroEconomico->save();

    }

    /**
     * Handle the RegistroEconomico "updated" event.
     *
     * @param  \App\Models\RegistroEconomico  $registroEconomico
     * @return void
     */
    public function updated(RegistroEconomico $registroEconomico)
    {
        //
    }


    /**
     * Handle the RegistroEconomico "restored" event.
     *
     * @param  \App\Models\RegistroEconomico  $registroEconomico
     * @return void
     */
    public function restored(RegistroEconomico $registroEconomico)
    {
        //
    }

}
