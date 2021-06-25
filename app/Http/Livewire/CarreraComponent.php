<?php

namespace App\Http\Livewire;

use App\Models\Carrera;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class CarreraComponent extends Component
{
    use WithPagination;

    public $showModalDelete = false;
    public $modalShowVisible = false;
    public $search;
    public $estadoRegistro = 0, $mensaje, $titulo;
    public $tituloCarrera, $descripcion, $requisitos, $cargaHoraria, $portada, $carreraId;
    public $categoria;
    protected $paginationTheme = 'bootstrap';

    public function mount() {
        $this->resetPage();
    }

    public function render()
    {
        $carreras = Carrera::where('titulo', 'like', '%' . $this->search . '%')
                    ->orWhere('cargaHoraria', 'like', '%' . $this->search . '%')
                    ->orderBy('id','DESC')
                    ->paginate(5);

        return view('livewire.carrera-component', ['carreras' => $carreras]);
    }

    protected $listeners = ['deshabilitarRegistro','habilitarRegistro','verificacion'];

    public function verificacion($id){
        $carrera = Carrera::where('id',$id)->first();
        if(count($carrera->planificacionCarrera)){
            $this->emit('exist',1);
        }else{
            $this->deshabilitarRegistro($id);
        }
    }

    public function deshabilitarRegistro($id){
        $this->estado = Carrera::where('id',$id)->update([
            'estado' => 0
        ]);
        if($this->estado == 1){
            $this->emit('customMessage','Se deshabilitó el registro');
        }else{
            $this->emit('messageFailed');
        }
    }
    public function habilitarRegistro($id){
        $this->estado = Carrera::where('id',$id)->update([
            'estado' => 1
        ]);
        if($this->estado == 1){
            $this->emit('customMessage','Se habilitó nuevamente el registro');
        }else{
            $this->emit('messageFailed');
        }
    }

    public function openModalShow($id){
        $carrera = Carrera::where('id', $id)->first();
        $this->tituloCarrera = $carrera->titulo;
        $this->descripcion = $carrera->descripcion;
        $this->requisitos = $carrera->requisitos;
        $this->cargaHoraria = $carrera->cargaHoraria;
        $this->portada = $carrera->portada;
        $this->categoria = $carrera->categoria->nombre;
        $this->modalShowVisible = true;
    }


 /*    public function openDelete($id){
        $this->carreraId = $id;
        $this->showModalDelete = true;
        $this->titulo = 'Deshabilitar';
        $this->mensaje = '¿Está seguro de deshabilitar el registro? Porque ya tiene módulos asignados';
    }

    public function delete(){
        $carrera = Carrera::where('id', $this->carreraId)->first();
        $path = $path = public_path() . '/storage/carreraPortadas/' .  $carrera->portada;
        File::delete($path);
        $carrera->delete();
        $this->showModalDelete = false;
        $this->resetPage();
        $this->emit('deleteItem');
    }
 */

}
