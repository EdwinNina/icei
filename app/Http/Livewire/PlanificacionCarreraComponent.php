<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PlanificacionCarrera;
use App\Models\PlanificacionModulo;

class PlanificacionCarreraComponent extends Component
{
    use WithPagination;

    public $modalFormVisible = false;
    public $showModalDelete = false;
    public $search;
    public $estadoRegistro = 0, $titulo, $mensaje;
    public $planificacionId;

    public function mount() {
        $this->resetPage();
    }

    public function render()
    {
        $planificaciones = PlanificacionCarrera::simplePaginate();

        return view('livewire.planificacion-carrera-component',['planificaciones' => $planificaciones]);
    }


    public function enableItem($id){
        $this->planificacionId = $id;
        $this->showModalDelete = true;
        $this->estadoRegistro = 1;
        $this->titulo = 'Habilitación del registro';
        $this->mensaje = '¿Desea habilitar nuevamente el registro?';
    }

    public function openDelete($id){
        $this->planificacionId = $id;
        $this->showModalDelete = true;
        $this->estadoRegistro = 0;
        $this->titulo = 'Deshabilitar';
        $existe = PlanificacionModulo::where('planificacion_carrera_id', $this->planificacionId)->first();
        if ($existe) {
            $this->mensaje = 'Estas seguro de volver inactivo esta planificacion porque ya contiene planificaciones de los módulos';
        }else{
            $this->mensaje = 'Estas seguro de volver inactivo esta planificacion? Aún no cuenta con planificaciones de los módulos';
        }
    }

    public function delete(){
        PlanificacionCarrera::where('id', $this->planificacionId)->update(['estado' => 0]);
        $this->showModalDelete = false;
        $this->resetPage();
        $this->emit('deleteItem');
    }

    public function enable(){
        PlanificacionCarrera::where('id', $this->planificacionId)->update(['estado' => 1]);
        $this->showModalDelete = false;
        $this->resetPage();
        $this->emit('deleteItem');
    }
}
