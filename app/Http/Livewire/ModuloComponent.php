<?php

namespace App\Http\Livewire;

use App\Models\Modulo;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class ModuloComponent extends Component
{
    use WithPagination;

    public $showModalDelete = false;
    public $modalShowVisible = false;
    public $search, $moduloId;
    public $titulo, $version, $temario, $cargaHoraria, $carrera, $portada;
    public function mount() {
        $this->resetPage();
    }

    public function render()
    {
        $modulos = Modulo::where('titulo', 'like', '%' . $this->search . '%')
                    ->orderBy('carrera_id','desc')
                    ->paginate(5);

        return view('livewire.modulo-component', ['modulos' => $modulos ]);
    }

    public function openModalShow(Modulo $modulo){
        $this->titulo = $modulo->titulo;
        $this->version = $modulo->version;
        $this->temario = $modulo->temario;
        $this->portada = $modulo->portada;
        $this->cargaHoraria = $modulo->cargaHoraria;
        $this->carrera = $modulo->carrera->titulo;
        $this->modalShowVisible = true;
    }

    public function openDelete($id){
        $this->moduloId = $id;
        $this->showModalDelete = true;
    }

    public function delete(){
        $modulo = Modulo::where('id', $this->moduloId)->first();
        $path = $path = public_path() . '/storage/moduloPortadas/' .  $modulo->portada;
        File::delete($path);
        $modulo->delete();
        $this->showModalDelete = false;
        $this->resetPage();
        $this->emit('deleteItem');
    }
}
