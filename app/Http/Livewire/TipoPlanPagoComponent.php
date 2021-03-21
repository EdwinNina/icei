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
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion
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
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion
        ]);
        if($tipo){
            $this->emit('messageSuccess','update');
        }else{
            $this->emit('messageFailed');
        }
        $this->resetInputs();
        $this->closeModal();
    }

    public function openDelete($id){
        $this->tipoPagoId = $id;
        $this->showModalDelete = true;
        $this->titulo = 'Eliminar';
        $this->mensaje = '¿Desea eliminar este registro?';
    }

    public function delete(){
        TipoPlanPago::where('id', $this->tipoPagoId)->delete();
        $this->showModalDelete = false;
        $this->resetPage();
        $this->emit('deleteItem');
    }

    public function resetInputs(){
        $this->tipoPagoId = '';
        $this->nombre = '';
        $this->descripcion = '';
    }
}
