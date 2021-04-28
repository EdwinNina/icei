<?php

namespace App\Http\Livewire;

use App\Models\Carrera;
use App\Models\Modulo;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class ModuloComponent extends Component
{
    use WithPagination;

    public $showModalDelete = false;
    public $modalShowVisible = false;
    public $search = '', $moduloId, $carrera_id = '';
    public $estadoRegistro = 0, $mensaje;
    public $titulo, $version, $temario, $cargaHoraria, $carrera, $portada;

    public function mount() {
        $this->resetPage();
    }

    public function render()
    {
        $carreras = Carrera::select('id','titulo')->get();

        $modulos = Modulo::busqueda($this->search)->filtro($this->carrera_id);

        $modulos = $modulos->orderBy('carrera_id','desc')->paginate(10);

        return view('livewire.modulo-component', ['modulos' => $modulos, 'carreras' => $carreras ]);
    }

    protected $listeners = ['deshabilitarRegistro','habilitarRegistro','verificacion'];

    public function verificacion($id){
        $modulo = Modulo::where('id',$id)->first();
        if(count($modulo->planificaciones)){
            $this->emit('exist',1);
        }else{
            $this->deshabilitarRegistro($id);
        }
    }

    public function deshabilitarRegistro($id){
        $this->estado = Modulo::where('id',$id)->update([
            'estado' => 0
        ]);
        if($this->estado == 1){
            $this->emit('customMessage','Registro deshabilitado correctamente');
        }else{
            $this->emit('messageFailed');
        }
    }

    public function habilitarRegistro($id){
        $this->estado = Modulo::where('id',$id)->update([
            'estado' => 1
        ]);
        if($this->estado == 1){
            $this->emit('customMessage','Se anuló la deshabilitación correctamente');
        }else{
            $this->emit('messageFailed');
        }
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
        $this->mensaje = '¿Desea eliminar el registro?';
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
