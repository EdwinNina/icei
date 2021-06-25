<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\UsuarioGeneral;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class UsuarioComponent extends Component
{
    use WithPagination;

    public $modalFormVisible = false;
    public $modalRoleVisible = false;
    public $showModalDelete = false;
    public $search;
    public $estadoRegistro = 0, $titulo, $mensaje;
    public $name, $email, $password, $usuarioId;
    public $roles = [];
    public $allRoles;
    public $currentRoles = [];
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $usuarios = User::where('name', 'like', '%' . $this->search . '%')->paginate(10);
        $this->allRoles = Role::get();
        return view('livewire.usuario-component', ['usuarios' => $usuarios]);
    }

    public function mount() {
        $this->resetPage();
    }

    public function rules(){
        return [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ];
    }

    public function create(){
        $this->resetInputs();
        $this->resetValidation();
        $this->modalFormVisible = true;
    }

    public function save(){
        $this->validate();
        $usuario = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password)
        ]);
        $this->resetInputs();
        $this->modalFormVisible = false;
        if($usuario){
            $this->emit('messageSuccess','create');
        }else{
            $this->emit('messageFailed');
        }
    }

    public function edit(User $usuario){
        $this->resetInputs();
        $this->resetValidation();
        $this->usuarioId = $usuario->id;
        $this->name = $usuario->name;
        $this->email = $usuario->email;
        $this->modalFormVisible = true;
    }

    public function update(){
        $usuario = User::where('id', $this->usuarioId)
            ->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);
        $this->resetInputs();
        $this->modalFormVisible = false;
        if($usuario){
            $this->emit('messageSuccess','update');
        }else{
            $this->emit('messageFailed');
        }
    }

    public function addRole(User $usuario){
        $this->resetValidation();
        $this->roles = [];
        $this->name = $usuario->name;
        $this->usuarioId = $usuario->id;
        $this->currentRoles = $usuario->getRoleNames();
        $this->modalRoleVisible = true;
    }

    public function updateRole(){
        $this->validate([
            'roles' => 'required'
        ]);
        $usuario = User::where('id', $this->usuarioId)->first();
        $usuario->roles()->sync($this->roles);
        $this->modalRoleVisible = false;
        $this->usuarioId = '';
        $this->name = '';
        $this->emit('messageSuccess','create');
    }

    public function openDelete($id){
        $this->usuarioId = $id;
        $this->titulo = 'Eliminación';
        $this->mensaje = '¿Esta seguro de eliminar este usuario?';
        $this->showModalDelete = true;
    }

    public function delete(){
        $usuario = User::where('id', $this->usuarioId)->first();
        $usuario->delete();
        UsuarioGeneral::where('id', $usuario->usuario_general_id)->delete();
        $this->showModalDelete = false;
        $this->resetPage();
        $this->emit('deleteItem');
    }

    public function resetInputs(){
        $this->usuarioId = '';
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }
}
