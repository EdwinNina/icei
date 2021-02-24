<?php

namespace App\Http\Livewire;

use App\Models\Carrera;
use App\Models\Docente;
use Livewire\Component;
use App\Models\Categoria;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;
use Livewire\WithFileUploads;

class CarreraComponent extends Component
{
    use WithPagination;

    public $showModalDelete = false;
    public $modalShowVisible = false;
    public $search;
    public $titulo, $descripcion, $requisitos, $cargaHoraria, $portada, $carreraId;
    public $categoria, $docenteNombre, $docentePaterno;

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

    public function openModalShow(Carrera $carrera){
        $this->titulo = $carrera->titulo;
        $this->descripcion = $carrera->descripcion;
        $this->requisitos = $carrera->requisitos;
        $this->cargaHoraria = $carrera->cargaHoraria;
        $this->portada = $carrera->portada;
        $this->categoria = $carrera->categoria->nombre;
        $this->docenteNombre = $carrera->docente->nombre;
        $this->docentePaterno = $carrera->docente->paterno;
        $this->modalShowVisible = true;
    }


    public function openDelete($id){
        $this->carreraId = $id;
        $this->showModalDelete = true;
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

}