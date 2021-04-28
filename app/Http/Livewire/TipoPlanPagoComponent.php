<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TipoPlanPago;
use Livewire\WithPagination;

class TipoPlanPagoComponent extends Component
{
    use WithPagination;

    public $modalFormVisible = false;
    public $showModalDelete = false;
    public $search;
    public $estadoRegistro = 0, $titulo, $mensaje;
    public $nombre, $descripcion, $tipoPagoId;

    public function mount() {
        $this->resetPage();
    }

    public function render()
    {
        $tipoPlanPagos = TipoPlanPago::where('nombre','like', '%' . $this->search . '%')
            ->orderBy('id','DESC')->paginate(5);

        return view('livewire.tipo-plan-pago-component', ['tipoPlanPagos' => $tipoPlanPagos]);
    }

    protected $listeners = ['deshabilitarRegistro','habilitarRegistro','verificacion'];

    public function verificacion($id){
        $tipos = TipoPlanPago::where('id',$id)->first();
        if($tipos->inscripcion){
            $this->emit('exist',1);
        }else{
            $this->deshabilitarRegistro($id);
        }
    }

    public function deshabilitarRegistro($id){
        $this->estado = TipoPlanPago::where('id',$id)->update([
            'estado' => 0
        ]);
        if($this->estado == 1){
            $this->emit('customMessage','Registro deshabilitado correctamente');
        }else{
            $this->emit('messageFailed');
        }
    }

    public function habilitarRegistro($id){
        $this->estado = TipoPlanPago::where('id',$id)->update([
            'estado' => 1
        ]);
        if($this->estado == 1){
            $this->emit('customMessage','Se anuló la deshabilitación correctamente');
        }else{
            $this->emit('messageFailed');
        }
    }

    public function create(){
        $this->resetInputs();
        $this->resetValidation();
        $this->modalFormVisible = true;
    }

    public function closeModal(){
        $this->modalFormVisible = false;
    }

    public function rules(){
        return [
            'nombre' => 'required',
            'descripcion' => 'required',
        ];
    }

    public function save(){
        $this->validate();
        $tipo = TipoPlanPago::create([
            'nombre' => mb_strtolower($this->nombre),
            'descripcion' => mb_strtolower($this->descripcion)
        ]);
        $this->resetInputs();
        $this->closeModal();
        if($tipo){
            $this->emit('messageSuccess','create');
        }else{
            $this->emit('messageFailed');
        }
    }

    public function edit(TipoPlanPago $tipo){
        $this->resetValidation();
        $this->tipoPagoId = $tipo->id;
        $this->nombre = $tipo->nombre;
        $this->descripcion = $tipo->descripcion;
        $this->modalFormVisible = true;
    }

    public function update(){
        $this->validate();
        $tipo = TipoPlanPago::where('id', $this->tipoPagoId)->update([
            'nombre' => mb_strtolower($this->nombre),
            'descripcion' => mb_strtolower($this->descripcion)
        ]);
        if($tipo){
            $this->emit('messageSuccess','update');
        }else{
            $this->emit('messageFailed');
        }
        $this->resetInputs();
        $this->closeModal();
    }

    public function resetInputs(){
        $this->tipoPagoId = '';
        $this->nombre = '';
        $this->descripcion = '';
    }
}
