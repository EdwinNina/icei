<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\InscripcionTaller;

class InscripcionTalleresComponent extends Component
{
    use WithPagination;

    public $showModalDelete = false;
    public $estadoRegistro = 1, $titulo, $mensaje, $opcionBoton = false;
    public $search = '';
    public $inscripcion_id;
    protected $paginationTheme = 'bootstrap';

    public function mount() {
        $this->resetPage();
    }

    public function render()
    {
        $inscripciones = InscripcionTaller::leftJoin('estudiantes as es','inscripcion_tallers.estudiante_id','=','es.id')
            ->select('inscripcion_tallers.*')->busqueda($this->search);

        $inscripciones = $inscripciones->orderBy('es.paterno','asc')->paginate(10);
        return view('livewire.inscripcion-talleres-component',[
            'inscripciones' => $inscripciones
        ]);
    }

    public function enableItem($id){
        $this->inscripcion_id = $id;
        $this->showModalDelete = true;
        $this->estadoRegistro = 1;
        $this->titulo = 'Habilitacion';
        $this->mensaje = '¿Desea habilitar este registro?';
    }

    public function openDelete($id){
        $this->inscripcion_id = $id;
        $this->showModalDelete = true;
        $this->estadoRegistro = 0;
        $this->titulo = 'Anulación';
        $this->mensaje = '¿Desea anular este registro?';
    }

    public function delete(){
        InscripcionTaller::where('id', $this->inscripcion_id)->update(['estado' => 0]);
        $this->showModalDelete = false;
        $this->resetPage();
        $this->emit('deleteItem');
    }

    public function enable(){
        InscripcionTaller::where('id', $this->inscripcion_id)->update(['estado' => 1]);
        $this->showModalDelete = false;
        $this->resetPage();
        $this->emit('deleteItem');
    }

    public function limpiarFiltro(){
        $this->carrera_id = '';
        $this->modulo_id = '';
        $this->horario_id = '';
        $this->modalidad_id = '';
        $this->estado_congelacion = '';
    }
}
