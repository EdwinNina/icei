<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class CategoriaComponent extends Component
{
    use WithPagination;

    public $modalFormVisible = false;
    public $showModalDelete = false;
    public $search, $estado;
    public $estadoRegistro = 0, $titulo, $mensaje;
    public $nombre, $slug, $categoriaId;
    protected $paginationTheme = 'bootstrap';


    public function mount() {
        $this->resetPage();
    }

    public function render()
    {
        $categorias = Categoria::where('nombre','like', '%' . $this->search . '%')
            ->orderBy('id','DESC')->paginate(5);

        return view('livewire.categoria-component', ['categorias' => $categorias]);
    }

    protected $listeners = ['deshabilitarRegistro','habilitarRegistro','verificacion'];

    public function verificacion($id){
        $categoria = Categoria::where('id',$id)->first();
        if(count($categoria->carreras)){
            $this->emit('exist',1);
        }else{
            $this->deshabilitarRegistro($id);
        }
    }

    public function deshabilitarRegistro($id){
        $this->estado = Categoria::where('id',$id)->update([
            'estado' => 0
        ]);
        if($this->estado == 1){
            $this->emit('customMessage','Registro deshabilitado correctamente');
        }else{
            $this->emit('messageFailed');
        }
    }

    public function habilitarRegistro($id){
        $this->estado = Categoria::where('id',$id)->update([
            'estado' => 1
        ]);
        if($this->estado == 1){
            $this->emit('customMessage','Se habilitó nuevamente el registro');
        }else{
            $this->emit('messageFailed');
        }
    }

    public function makeSlug(){
        $newText = Str::slug($this->nombre);
        $this->slug = $newText;
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
            'slug' => ['required', Rule::unique('categorias','slug')->ignore($this->categoriaId)],
        ];
    }

    public function save(){
        $this->validate();
        $category = Categoria::create([
            'nombre' => $this->nombre,
            'slug' => $this->slug
        ]);
        $this->resetInputs();
        $this->closeModal();
        if($category){
            $this->emit('messageSuccess','create');
        }else{
            $this->emit('messageFailed');
        }
    }

    public function edit(Categoria $categoria){
        $this->resetValidation();
        $this->categoriaId = $categoria->id;
        $this->nombre = $categoria->nombre;
        $this->slug = $categoria->slug;
        $this->modalFormVisible = true;
    }

    public function update(){
        $this->validate();
        Categoria::where('id', $this->categoriaId)->update([
            'nombre' => $this->nombre,
            'slug' => $this->slug
        ]);
        $this->resetInputs();
        $this->closeModal();
    }

    public function resetInputs(){
        $this->categoriaId = '';
        $this->nombre = '';
        $this->slug = '';
    }
}
