<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Carrera;
use App\Models\Horario;
use Livewire\Component;
use App\Models\Modalidad;
use App\Models\Modulo;
use App\Models\PlanificacionModulo;
use App\Models\PlanificacionCarrera;

class FiltroPlanificacionComponent extends Component
{
    public $verificarPlanificacion = false, $modalShowVisible = false, $showComponent = false;
    public $planificaciones, $planificacion_id;
    public $modulos, $planificacionModulos, $nombreModulo;
    public $modulo_id, $carrera_id, $horario_id, $modalidad_id;

    public function render()
    {
        $horarios = Horario::get();
        $carreras = Carrera::get();
        $modalidades = Modalidad::get();
        return view('livewire.filtro-planificacion-component',[
            'horarios' => $horarios,
            'carreras' => $carreras,
            'modalidades' => $modalidades
        ]);
    }

    public function buscarPlanificacion(){
        $this->planificaciones = PlanificacionCarrera::where([
            ['carrera_id', '=', $this->carrera_id],
            ['horario_id', '=', $this->horario_id],
            ['modalidad_id', '=', $this->modalidad_id],
            ['estado',1]
        ])->get();
    }

    public function consultarPlanificacionModulos($id){
        $this->planificacionModulos = PlanificacionModulo::where('planificacion_carrera_id', $id)->get();
        $this->modalShowVisible = true;
    }

    public function updatedplanificacionId($planificacion_id){
        $this->modulos = PlanificacionModulo::where('planificacion_carrera_id', $planificacion_id)->get();
        $planificacion = PlanificacionCarrera::where('id', $planificacion_id)->first();
        $this->emit('costoModulo', $planificacion->costo_modulo);
    }

    public function updatedModuloId($id){
        if ($id != null || $id != '') {
            $modulo = Modulo::where('id', $id)->first();
            $this->nombreModulo = $modulo->titulo_completo;
            if($this->nombreModulo != null){
                $this->emitTo('carrito-pagos-component','mostrarCarrito');
            }
        }else{
            $this->emitTo('carrito-pagos-component','errorMostrarCarrito');
        }
    }
}
