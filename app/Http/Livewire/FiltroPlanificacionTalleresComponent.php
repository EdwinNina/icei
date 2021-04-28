<?php

namespace App\Http\Livewire;

use App\Models\Taller;
use App\Models\Horario;
use Livewire\Component;
use App\Models\Modalidad;
use App\Models\PlanificacionTaller;

class FiltroPlanificacionTalleresComponent extends Component
{

    public $verificarPlanificacion = false, $modalShowVisible = false, $showComponent = false;
    public $planificaciones, $planificacion_taller_id;
    public $modulos, $planificacionModulos, $nombreModulo;
    public $taller_id, $horario_id, $modalidad_id;

    public function render()
    {
        $horarios = Horario::get();
        $talleres = Taller::get();
        $modalidades = Modalidad::get();
        return view('livewire.filtro-planificacion-talleres-component',[
            'horarios' => $horarios,
            'talleres' => $talleres,
            'modalidades' => $modalidades
        ]);
    }

    public function buscarPlanificacion(){
        $this->planificaciones = PlanificacionTaller::where([
            ['taller_id', '=', $this->taller_id],
            ['horario_id', '=', $this->horario_id],
            ['modalidad_id', '=', $this->modalidad_id]
        ])->get();
    }

    public function updatedPlanificacionTallerId($id){
        $planificacion = PlanificacionTaller::where('id', $id)->first();
        $this->emit('costoModulo', $planificacion->costo);
        $this->emit('mostrarCarrito');
    }
}
