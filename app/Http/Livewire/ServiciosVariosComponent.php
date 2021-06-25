<?php

namespace App\Http\Livewire;

use App\Models\Servicio;
use Livewire\Component;
use Livewire\WithPagination;

class ServiciosVariosComponent extends Component
{
    use WithPagination;

    public $showModalDelete = false;
    public $estadoRegistro = 0, $titulo, $mensaje;
    public $servicio_id;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $servicios = Servicio::orderBy('id','asc')->paginate();

        return view('livewire.servicios-varios-component', [
            'servicios' => $servicios
        ]);
    }

    protected $listeners = ['deshabilitarRegistro','habilitarRegistro'];

    public function deshabilitarRegistro($id){
        $this->estado = Servicio::where('id',$id)->update([
            'estado' => 0
        ]);
        if($this->estado == 1){
            $this->emit('customMessage','Registro deshabilitado correctamente');
        }else{
            $this->emit('messageFailed');
        }
    }

    public function habilitarRegistro($id){
        $this->estado = Servicio::where('id',$id)->update([
            'estado' => 1
        ]);
        if($this->estado == 1){
            $this->emit('customMessage','Se anuló la deshabilitación correctamente');
        }else{
            $this->emit('messageFailed');
        }
    }
}
