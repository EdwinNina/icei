<?php

namespace App\Http\Livewire;

use App\Models\Horario;
use Livewire\Component;
use App\Models\Schedule;
use Livewire\WithPagination;

class HorarioComponent extends Component
{
    use WithPagination;

    public $modalFormVisible = false;
    public $showModalDelete = false;
    public $search;
    public $estadoRegistro = 0,  $titulo, $mensaje;
    public $dias, $hora_inicio, $hora_fin, $turno, $horarioId;

    public function mount() {
        $this->resetPage();
    }

    public function render()
    {
        $horarios = Horario::where('dias','like', '%' . $this->search . '%')->paginate(5);

        return view('livewire.horario-component', ['horarios' => $horarios]);
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
            'dias' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'turno' => 'required',
        ];
    }

    public function save(){
        $this->validate();
        $horario = Horario::create([
            'dias' => $this->dias,
            'hora_inicio' => $this->hora_inicio,
            'hora_fin' => $this->hora_fin,
            'turno' => $this->turno,
        ]);
        $this->resetInputs();
        $this->closeModal();
        if($horario){
            $this->emit('messageSuccess');
        }else{
            $this->emit('messageFailed');
        }
    }

    public function edit(Horario $horario){
        $this->resetValidation();
        $this->horarioId = $horario->id;
        $this->dias = $horario->dias;
        $this->hora_inicio = $horario->hora_inicio;
        $this->hora_fin = $horario->hora_fin;
        $this->turno = $horario->turno;
        $this->modalFormVisible = true;
    }

    public function update(){
        $this->validate();
        Horario::where('id', $this->horarioId)->update([
            'dias' => $this->dias,
            'hora_inicio' => $this->hora_inicio,
            'hora_fin' => $this->hora_fin,
            'turno' => $this->turno
        ]);
        $this->resetInputs();
        $this->closeModal();
    }

    public function openDelete($id){
        $this->horarioId = $id;
        $this->showModalDelete = true;
        $this->titulo = 'Eliminar';
        $this->mensaje = '¿Desea eliminar este registro?';
    }

    public function delete(){
        Horario::where('id', $this->horarioId)->delete();
        $this->showModalDelete = false;
        $this->resetPage();
        $this->emit('deleteItem');
    }

    public function resetInputs(){
        $this->horarioId = '';
        $this->dias = '';
        $this->hora_inicio = '';
        $this->hora_fin = '';
        $this->turno = '';
    }
}
