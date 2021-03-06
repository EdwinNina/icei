<?php

namespace App\Http\Livewire;

use App\Models\Carrera;
use App\Models\Planificaciones;
use Livewire\Component;
use Livewire\WithPagination;

class PlanificacionCarreraComponent extends Component
{
    use WithPagination;

    public $modalFormVisible = false;
    public $showModalDelete = false;
    public $search;
    public $codigo, $modalidad, $costo_carrera, $costo_modulo, $gestion, $fecha_inicio, $fecha_fin, $carrera_id, $planificacionId;
    public $modalidades = ['presencial' => 'Presencial','semi-presencial' => 'Semi presencial','virtual' =>'Virtual'];

    public function mount() {
        $this->resetPage();
    }

    public function render()
    {
        $carreras = Carrera::select('titulo','id')->get();
        $planificaciones = Planificaciones::where('modalidad','like', '%' . $this->search . '%')
                        ->where('gestion','like', '%' . $this->search . '%')
                        ->paginate(10);
        return view('livewire.planificacion-carrera-component',['planificaciones' => $planificaciones, 'carreras' => $carreras]);
    }

    public function create(){
        $this->resetInputs();
        $this->resetValidation();
        $this->gestion = date('Y');
        $this->codigo = 'PLANC-'.$this->gestion;
        $this->modalFormVisible = true;
    }

    public function closeModal(){
        $this->modalFormVisible = false;
    }

    public function rules(){
        return [
            'codigo' => 'required',
            'modalidad' => 'required',
            'costo_carrera' => 'required',
            'costo_modulo' => 'required',
            'gestion' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'carrera_id' => 'required'
        ];
    }

    public function save(){
        $this->validate();
        $planificacion = Planificaciones::create([
            'codigo' => $this->codigo,
            'modalidad' => $this->modalidad,
            'costo_carrera' => $this->costo_carrera,
            'costo_modulo' => $this->costo_modulo,
            'gestion' => $this->gestion,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'carrera_id' => $this->carrera_id
        ]);
        $this->resetInputs();
        $this->closeModal();
        if($planificacion){
            $this->emit('messageSuccess','create');
        }else{
            $this->emit('messageFailed');
        }
    }

    public function edit(Planificaciones $planificacion){
        $this->resetInputs();
        $this->resetValidation();
        $this->planificacionId = $planificacion->id;
        $this->modalidad = $planificacion->modalidad;
        $this->codigo = $planificacion->codigo;
        $this->costo_carrera = $planificacion->costo_carrera;
        $this->costo_modulo = $planificacion->costo_modulo;
        $this->gestion = $planificacion->gestion;
        $this->fecha_inicio = $planificacion->fecha_inicio;
        $this->fecha_fin = $planificacion->fecha_fin;
        $this->carrera_id = $planificacion->carrera_id;
        $this->modalFormVisible = true;
    }

    public function update(){
        $this->validate();
        Planificaciones::where('id', $this->planificacionId)->update([
            'codigo' => $this->codigo,
            'modalidad' => $this->modalidad,
            'costo_carrera' => $this->costo_carrera,
            'costo_modulo' => $this->costo_modulo,
            'gestion' => $this->gestion,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'carrera_id' => $this->carrera_id,
        ]);
        $this->emit('messageSuccess','update');
        $this->resetInputs();
        $this->closeModal();
    }

    public function openDelete($id){
        $this->planificacionId = $id;
        $this->showModalDelete = true;
    }

    public function delete(){
        Planificaciones::where('id', $this->planificacionId)->delete();
        $this->showModalDelete = false;
        $this->resetPage();
        $this->emit('deleteItem');
    }

    public function resetInputs(){
        $this->planificacionId = '';
        $this->codigo = '';
        $this->modalidad = '';
        $this->costo_carrera = '';
        $this->costo_modulo = '';
        $this->gestion = '';
        $this->fecha_inicio = '';
        $this->fecha_fin = '';
        $this->carrera_id = '';
    }
}

