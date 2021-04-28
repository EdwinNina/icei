<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Carrera;
use App\Models\Docente;
use App\Models\UsuarioGeneral;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class DocenteComponent extends Component
{
    use WithPagination;

    public $modalFormVisible = false;
    public $search;
    public $carnet, $nombre, $paterno, $materno, $email, $celular, $expedido, $complemento, $docenteId;
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

    protected $listeners = ['deshabilitarRegistro','habilitarRegistro','verificacion'];

    public function verificacion($id){
        $docente = Docente::where('id',$id)->first();
        if($docente->planificacionCarrera){
            $this->emit('exist',1);
        }else{
            $this->deshabilitarRegistro($id);
        }
    }

    public function deshabilitarRegistro($id){
        $this->estado = Docente::where('id',$id)->update([
            'estado' => 0
        ]);

        if($this->estado == 1){
            $this->emit('customMessage','Registro deshabilitado correctamente');
        }else{
            $this->emit('messageFailed');
        }
    }

    public function habilitarRegistro($id){
        $this->estado = Docente::where('id',$id)->update([
            'estado' => 1
        ]);
        if($this->estado == 1){
            $this->emit('customMessage','Se habilitó nuevamente el registro');
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
            'complemento' => $this->complemento,
            'nombre' => mb_strtolower($this->nombre),
            'paterno' => mb_strtolower($this->paterno),
            'materno' => mb_strtolower($this->materno),
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
        $this->complemento = $docente->complemento;
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
            'complemento' => $this->complemento,
            'nombre' => mb_strtolower($this->nombre),
            'paterno' => mb_strtolower($this->paterno),
            'materno' => mb_strtolower($this->materno),
            'celular' => $this->celular,
            'email' => $this->email,
            'expedido' => $this->expedido
        ]);
        $this->resetInputs();
        $this->closeModal();
    }

    public function resetInputs(){
        $this->docenteId = '';
        $this->carnet = '';
        $this->complemento = '';
        $this->nombre = '';
        $this->paterno = '';
        $this->materno = '';
        $this->celular = '';
        $this->email = '';
        $this->userName = '';
        $this->userPassword = '';
        $this->userEmail = '';
    }

    public function openModalUser(Docente $docente){
        $this->resetInputs();
        $this->resetValidation();
        $codigo = Str::upper(Str::substr($docente->paterno, 0, 1)).''.Str::upper(Str::substr($docente->materno, 0, 1)).''.Str::upper(Str::substr($docente->nombre, 0, 1)) . '' . $docente->carnet;
        $this->docenteId = $docente->id;
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
        $usuario_general = UsuarioGeneral::create([
            'generable_type' => 'App\Models\Docente',
            'generable_id' => $this->docenteId
        ]);
        User::create([
            'name' => $this->userName,
            'email' => $this->userEmail,
            'password' => bcrypt($this->userPassword),
            'usuario_general_id' => $usuario_general->id
        ])->assignRole('Docente');

        $this->resetInputs();
        $this->emit('customMessage', 'Usuario creado satisfactoriamente');
        $this->modalFormUserVisible = false;
    }
}
