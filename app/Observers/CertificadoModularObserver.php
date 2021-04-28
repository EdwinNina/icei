<?php

namespace App\Observers;

use App\Models\Certificado;

class CertificadoModularObserver
{
    /**
     * Handle the Certificado "created" event.
     *
     * @param  \App\Models\Certificado  $certificado
     * @return void
     */
    public function created(Certificado $certificado)
    {
        $certificado->codigo = date('y') . '-' .str_pad($certificado->id, 6, "0", STR_PAD_LEFT);
        $certificado->save();
    }
}
