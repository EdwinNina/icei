<?php

namespace App\Http\Livewire;

use App\Models\Taller;
use Livewire\Component;
use Livewire\WithPagination;

class TalleresComponent extends Component
{
    use WithPagination;

    public $modalFormVisible = false;
    public $search, $nombre, $descripcion, $tallerId;
    protected $paginationTheme = 'bootstrap';

    public function mount() {
        $this->resetPage();
    }

    public function render()
    {
        $talleres = Taller::where('nombre','like',"%{$this->search}%")->paginate();
        return view('livewire.talleres-component', ['talleres' => $talleres]);
    }


    protected $listeners = ['deshabilitarRegistro','habilitarRegistro','verificacion'];

    public function verificacion($id){
        $taller = Taller::where('id',$id)->first();
        if(count($taller->planificacionTalleres)){
            $this->emit('exist',1);
        }else{
            $this->deshabilitarRegistro($id);
        }
    }

    public function deshabilitarRegistro($id){
        $this->estado = Taller::where('id',$id)->update([
            'estado' => 0
        ]);
        if($this->estado == 1){
            $this->emit('customMessage','Registro deshabilitado correctamente');
        }else{
            $this->emit('messageFailed');
        }
    }

    public function habilitarRegistro($id){
        $this->estado = Taller::where('id',$id)->update([
            'estado' => 1
        ]);
        if($this->estado == 1){
            $this->emit('customMessage','Se anuló la deshabilitación correctamente');
        }else{
            $this->emit('messageFailed');
        }
    }

    public function create(){
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
    }

    public function save(){
        $this->validate();
        $taller = Taller::create([
            'nombre' => mb_strtolower(trim($this->nombre)),
            'descripcion' => mb_strtolower(trim($this->descripcion))
        ]);
        if($taller){
            $this->emit('successMessage','create');
        }else{
            $this->emit('messageFailed');
        }
        $this->modalFormVisible = false;
    }

    public function edit(Taller $taller){
        $this->resetValidation();
        $this->reset();
        $this->tallerId = $taller->id;
        $this->nombre = $taller->nombre;
        $this->descripcion = $taller->descripcion;
        $this->modalFormVisible = true;
    }

    public function update(){
        $taller = Taller::where('id', $this->tallerId)->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ]);
        if($taller){
            $this->emit('successMessage','update');
        }else{
            $this->emit('messageFailed');
        }
        $this->modalFormVisible = false;
    }

    public function rules(){
        return [
            'nombre' => 'required',
            'descripcion' => 'required',
        ];
    }
}
