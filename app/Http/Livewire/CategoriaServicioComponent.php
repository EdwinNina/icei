<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CategoriaServicio;

class CategoriaServicioComponent extends Component
{

    use WithPagination;

    public $modalFormVisible = false;
    public $showModalDelete = false;
    public $search;
    public $estadoRegistro = 0,$titulo, $mensaje;
    public $nombre, $descripcion, $categoriaServicioId;

    public function mount() {
        $this->resetPage();
    }

    public function render()
    {
        $categorias = CategoriaServicio::where('nombre','like', '%' . $this->search . '%')
            ->orderBy('id','DESC')->paginate(5);
        return view('livewire.categoria-servicio-component',[
            'categorias' => $categorias
        ]);
    }

    protected $listeners = ['deshabilitarRegistro','habilitarRegistro','verificacion'];

    public function verificacion($id){
        $categoria = CategoriaServicio::where('id',$id)->first();
        if(count($categoria->servicios)){
            $this->emit('exist',1);
        }else{
            $this->deshabilitarRegistro($id);
        }
    }

    public function deshabilitarRegistro($id){
        $this->estado = CategoriaServicio::where('id',$id)->update([
            'estado' => 0
        ]);
        if($this->estado == 1){
            $this->emit('customMessage','Registro deshabilitado correctamente');
        }else{
            $this->emit('messageFailed');
        }
    }

    public function habilitarRegistro($id){
        $this->estado = CategoriaServicio::where('id',$id)->update([
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
        $tipo = CategoriaServicio::create([
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

    public function edit(CategoriaServicio $tipo){
        $this->resetValidation();
        $this->categoriaServicioId = $tipo->id;
        $this->nombre = $tipo->nombre;
        $this->descripcion = $tipo->descripcion;
        $this->modalFormVisible = true;
    }

    public function update(){
        $this->validate();
        $tipo = CategoriaServicio::where('id', $this->categoriaServicioId)->update([
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
        $this->categoriaServicioId = '';
        $this->nombre = '';
        $this->descripcion = '';
    }
}
