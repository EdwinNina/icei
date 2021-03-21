<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Carrera;
use App\Models\Docente;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class DocenteComponent extends Component
{
    use WithPagination;

    public $modalFormVisible = false;
    public $showModalDelete = false;
    public $search;
    public $estadoRegistro = 0, $titulo, $mensaje;
    public $carnet, $nombre, $paterno, $materno, $email, $celular, $expedido, $docenteId;
    public $modalFormUserVisible = false;
    public $expedidos = ['CH' => 'CH', 'LP' => 'LP', 'CB' => 'CB', 'OR' => 'OR', 'PT' => 'PT',
    'TJ' => 'TJ', 'SC' => 'SC', 'BN' => 'BN', 'PD' => 'PD'];
    public $userEmail, $userPassword, $userName;
    public $password = true;
    public $docenteCarreras;

    public function mount() {
        $this->resetPage();
    }

    public function render()
    {
        $docentes = Docente::where('carnet','like', '%' . $this->search . '%')
                ->orWhere('paterno','like', '%' . $this->search . '%')
                ->orWhere('nombre','like', '%' . $this->search . '%')
                ->orderBy('paterno','ASC')
                ->paginate(5);
        $carreras = Carrera::select('id','titulo')->get();
        return view('livewire.docente-component', ['docentes' => $docentes, 'carreras' => $carreras]);
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
            'carnet' => ['required', Rule::unique('docentes','carnet')->ignore($this->docenteId)],
            'expedido' => 'required',
            'nombre' => 'required',
            'paterno' => 'required',
            'materno' => 'required',
            'email' => 'required|email',
            'celular' => 'required|numeric'
        ];
    }

    public function save(){
        $this->validate();
        $docente = Docente::create([
            'carnet' => $this->carnet,
            'nombre' => $this->nombre,
            'paterno' => $this->paterno,
            'materno' => $this->materno,
            'celular' => $this->celular,
            'email' => $this->email,
            'expedido' => $this->expedido
        ]);
        $this->resetInputs();
        $this->closeModal();
        if($docente){
            $this->emit('messageSuccess');
        }else{
            $this->emit('messageFailed');
        }
    }

    public function edit(Docente $docente){
        $this->resetValidation();
        $this->docenteId = $docente->id;
        $this->carnet = $docente->carnet;
        $this->nombre = $docente->nombre;
        $this->paterno = $docente->paterno;
        $this->materno = $docente->materno;
        $this->email = $docente->email;
        $this->celular = $docente->celular;
        $this->expedido = $docente->expedido;
        $this->modalFormVisible = true;
    }

    public function update(){
        $this->validate();
        Docente::where('id', $this->docenteId)->update([
            'carnet' => $this->carnet,
            'nombre' => $this->nombre,
            'paterno' => $this->paterno,
            'materno' => $this->materno,
            'celular' => $this->celular,
            'email' => $this->email,
            'expedido' => $this->expedido
        ]);
        $this->resetInputs();
        $this->closeModal();
    }

    public function openDelete($id){
        $this->docenteId = $id;
        $this->showModalDelete = true;
        $this->titulo = 'Eliminar';
        $this->showModalDelete = 'Esta seguro de eliminar';

    }

    public function delete(){
        Docente::where('id', $this->docenteId)->delete();
        $this->showModalDelete = false;
        $this->resetPage();
        $this->emit('deleteItem');
    }

    public function resetInputs(){
        $this->docenteId = '';
        $this->carnet = '';
        $this->nombre = '';
        $this->paterno = '';
        $this->materno = '';
        $this->celular = '';
        $this->email = '';
        $this->userName = '';
        $this->userPassword = '';
        $this->userEmail = '';
    }

    function createCode($paterno, $materno, $nombre, $carnet){
        $codigo = Str::substr($paterno, 0, 1) . '' . Str::substr($materno, 0, 1) . '' . Str::substr($nombre, 0, 1) . '' . $carnet;
        return $codigo;
    }

    public function openModalUser(Docente $docente){
        $this->resetInputs();
        $this->resetValidation();
        $codigo = Str::substr($docente->paterno, 0, 1).''.Str::substr($docente->materno, 0, 1).''.Str::substr($docente->nombre, 0, 1) . '' . $docente->carnet;
        $this->nombre = $docente->nombre;
        $this->paterno = $docente->paterno;
        $this->materno = $docente->materno;
        $this->userName = ucwords(mb_strtolower($docente->nombre));
        $this->userPassword = $codigo;
        $this->userEmail = $docente->email;
        $this->modalFormUserVisible = true;
    }

    protected $validationAttributes = [
        'userEmail' => 'correo electrónico',
    ];

    protected $messages = [
        'userEmail.unique' => 'Ya existe el usuario con este correo electrónico',
    ];

    public function addUser(){
        $this->validate([
            'userEmail' => Rule::unique('users','email'),
        ]);

        User::create([
            'name' => $this->userName,
            'email' => $this->userEmail,
            'password' => bcrypt($this->userPassword)
        ])->assignRole('Docente');

        $this->resetInputs();
        $this->emit('customMessage', 'Usuario creado satisfactoriamente');
        $this->modalFormUserVisible = false;
    }
}
