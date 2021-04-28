<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PlanificacionTaller;

class PlanificacionTallerComponent extends Component
{
    use WithPagination;

    public $search;
    public $estado = '';

    public function mount() {
        $this->resetPage();
    }

    public function render()
    {
        $planificaciones = PlanificacionTaller::busqueda($this->search)->filtro($this->estado);
        $planificaciones = $planificaciones->paginate();
        return view('livewire.planificacion-taller-component', ['planificaciones' => $planificaciones]);
    }

    protected $listeners = ['deshabilitarRegistro','habilitarRegistro','verificacion'];

    public function verificacion($id){
        $planificaciones = PlanificacionTaller::where('id',$id)->first();
        if(count($planificaciones->inscripciones)){
            $this->emit('exist',1);
        }else{
            $this->deshabilitarRegistro($id);
        }
    }

    public function deshabilitarRegistro($id){
        $this->estado = PlanificacionTaller::where('id',$id)->update([
            'estado' => 0
        ]);
        if($this->estado == 1){
            $this->emit('customMessage','Registro deshabilitado correctamente');
        }else{
            $this->emit('messageFailed');
        }
    }

    public function habilitarRegistro($id){
        $this->estado = PlanificacionTaller::where('id',$id)->update([
            'estado' => 1
        ]);
        if($this->estado == 1){
            $this->emit('customMessage','Se anuló la deshabilitación correctamente');
        }else{
            $this->emit('messageFailed');
        }
    }
}
