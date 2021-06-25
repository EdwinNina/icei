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
    protected $paginationTheme = 'bootstrap';

    public function mount() {
        $this->resetPage();
    }

    public function render()
    {
        $horarios = Horario::where('dias','like', '%' . $this->search . '%')->paginate(5);

        return view('livewire.horario-component', ['horarios' => $horarios]);
    }

    protected $listeners = ['deshabilitarRegistro','habilitarRegistro','verificacion'];

    public function verificacion($id){
        $horario = Horario::where('id',$id)->first();
        if(count($horario->planificacionCarrera)){
            $this->emit('exist',1);
        }else{
            $this->deshabilitarRegistro($id);
        }
    }

    public function deshabilitarRegistro($id){
        $this->estado = Horario::where('id',$id)->update([
            'estado' => 0
        ]);
        if($this->estado == 1){
            $this->emit('customMessage','Registro deshabilitado correctamente');
        }else{
            $this->emit('messageFailed');
        }
    }

    public function habilitarRegistro($id){
        $this->estado = Horario::where('id',$id)->update([
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
        $this->hora_inicio = $horario->hora_inicio->format('H:i');
        $this->hora_fin = $horario->hora_fin->format('H:i');
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

    public function resetInputs(){
        $this->horarioId = '';
        $this->dias = '';
        $this->hora_inicio = '';
        $this->hora_fin = '';
        $this->turno = '';
    }
}
