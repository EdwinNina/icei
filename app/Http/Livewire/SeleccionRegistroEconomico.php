<?php

namespace App\Http\Livewire;

use App\Models\Configuracion;
use Livewire\Component;

class SeleccionRegistroEconomico extends Component
{
    public $opcionSeleccionada;
    public $inscripcion, $estudiante;
    public $nota_minima_aprobacion;

    public function render()
    {
        $configuracion = Configuracion::select('nota_minima_aprobacion')->first();
        $this->nota_minima_aprobacion = $configuracion->nota_minima_aprobacion;
        return view('livewire.seleccion-registro-economico');
    }

    public function seleccionarVista($opcion){
        switch ($opcion) {
            case 'inscripcion':
                $this->opcionSeleccionada = '';
                $this->opcionSeleccionada = $opcion;
            break;
            case 'examen':
                $this->opcionSeleccionada = '';
                $this->opcionSeleccionada = $opcion;
            break;
            case 'certificado':
                $this->opcionSeleccionada = '';
                $this->opcionSeleccionada = $opcion;
            break;
        }
    }
}
