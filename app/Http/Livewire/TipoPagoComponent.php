<?php

namespace App\Http\Livewire;

use App\Models\TipoPago;
use Livewire\Component;
use Livewire\WithPagination;

class TipoPagoComponent extends Component
{
    use WithPagination;

    public $modalFormVisible = false;
    public $showModalDelete = false;
    public $search;
    public $nombre, $descripcion, $tipoPagoId;

    public function mount() {
        $this->resetPage();
    }

    public function render()
    {
        $tipoPagos = TipoPago::where('nombre','like', '%' . $this->search . '%')
            ->orderBy('id','DESC')->paginate(5);

        return view('livewire.tipo-pago-component', ['tipoPagos' => $tipoPagos]);
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
        $tipo = TipoPago::create([
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

    public function edit(TipoPago $tipo){
        $this->resetValidation();
        $this->tipoPagoId = $tipo->id;
        $this->nombre = $tipo->nombre;
        $this->descripcion = $tipo->descripcion;
        $this->modalFormVisible = true;
    }

    public function update(){
        $this->validate();
        $tipo = TipoPago::where('id', $this->tipoPagoId)->update([
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
    }

    public function delete(){
        TipoPago::where('id', $this->tipoPagoId)->delete();
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
