<?php

namespace App\Http\Livewire;

use App\Models\Aula;
use Livewire\Component;
use Livewire\WithPagination;

class AulasComponent extends Component
{

    use WithPagination;

    public $modalFormVisible = false, $showModalDelete = false;
    public $search, $aula, $piso, $aulaId;
    public $estadoRegistro = 0, $titulo, $mensaje;

    public function mount() {
        $this->resetPage();
    }

    public function render()
    {
        $aulas = Aula::where('piso','like',"%{$this->search}%")->paginate();
        return view('livewire.aulas-component', ['aulas' => $aulas]);
    }

    protected $listeners = ['deshabilitarRegistro','habilitarRegistro','verificacion'];

    public function verificacion($id){
        $aulas = Aula::where('id',$id)->first();
        if(count($aulas->planificacionModulos)){
            $this->emit('exist',1);
        }else{
            $this->deshabilitarRegistro($id);
        }
    }

    public function deshabilitarRegistro($id){
        $this->estado = Aula::where('id',$id)->update([
            'estado' => 0
        ]);
        if($this->estado == 1){
            $this->emit('customMessage','Registro deshabilitado correctamente');
        }else{
            $this->emit('messageFailed');
        }
    }

    public function habilitarRegistro($id){
        $this->estado = Aula::where('id',$id)->update([
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
        $aula = Aula::create([
            'aula' => mb_strtolower(trim($this->aula)),
            'piso' => trim($this->piso)
        ]);
        if($aula){
            $this->emit('successMessage','create');
        }else{
            $this->emit('messageFailed');
        }
        $this->modalFormVisible = false;
    }

    public function edit(Aula $aula){
        $this->resetValidation();
        $this->reset();
        $this->aulaId = $aula->id;
        $this->aula = $aula->aula;
        $this->piso = $aula->piso;
        $this->modalFormVisible = true;
    }

    public function update(){
        $aula = Aula::where('id', $this->aulaId)->update([
            'aula' => $this->aula,
            'piso' => $this->piso,
        ]);
        if($aula){
            $this->emit('successMessage','update');
        }else{
            $this->emit('messageFailed');
        }
        $this->modalFormVisible = false;
    }

    public function rules(){
        return [
            'aula' => 'required',
            'piso' => 'required',
        ];
    }
}
