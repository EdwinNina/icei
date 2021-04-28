<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Familiar;
use App\Models\Estudiante;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\GradoAcademico;
use App\Models\UsuarioGeneral;
use Illuminate\Validation\Rule;
use App\Imports\EstudiantesImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class EstudianteComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $modalFormVisible = false;
    public $showModalDelete = false;
    public $modalShowVisible = false;
    public $modalFormUserVisible = false;
    public $search;
    public $estadoRegistro = 0, $titulo, $mensaje;
    public $opcion = 'listado';
    public $carnet, $expedido, $nombre, $paterno, $materno, $email, $celular, $estudianteId, $codigo, $excel, $complemento;
    public $grado, $profesion, $carrera, $universidad;
    public $userEmail, $userPassword, $userName;
    public $nombreFamiliar,$paternoFamiliar,$maternoFamiliar,$celularFamiliar;
    public $nombreBotonCarga = 'Subir';
    public $password = true;
    public $expedidos = ['CH' => 'CH', 'LP' => 'LP', 'CB' => 'CB', 'OR' => 'OR', 'PT' => 'PT',
    'TJ' => 'TJ', 'SC' => 'SC', 'BN' => 'BN', 'PD' => 'PD'];
    public $grados = ['estudiante' => 'Estudiante', 'tecnico superior' => 'Técnico superior', 'licenciado' => 'Licenciado',
    'magister' => 'Magister', 'doctor' => 'Doctor'];


    public function mount() {
        $this->resetPage();
    }

    public function render()
    {
        $estudiantes = Estudiante::where('carnet','like', '%' . $this->search . '%')
                    ->orWhere('paterno','like', '%' . $this->search . '%')
                    ->orWhere('nombre','like', '%' . $this->search . '%')
                    ->orderBy('paterno','ASC')
                    ->paginate(10);

        return view('livewire.estudiante-component', [ 'estudiantes' => $estudiantes ]);
    }

    protected $listeners = ['deshabilitarRegistro','habilitarRegistro','verificacion'];

    public function verificacion($id){
        $estudiante = Estudiante::where('id',$id)->first();
        if(count($estudiante->inscripciones)){
            $this->emit('exist',1);
        }else{
            $this->deshabilitarRegistro($id);
        }
    }

    public function deshabilitarRegistro($id){
        $this->estado = Estudiante::where('id',$id)->update([
            'estado' => 0
        ]);
        if($this->estado == 1){
            $this->emit('customMessage','Registro deshabilitado correctamente');
        }else{
            $this->emit('messageFailed');
        }
    }

    public function habilitarRegistro($id){
        $this->estado = Estudiante::where('id',$id)->update([
            'estado' => 1
        ]);
        if($this->estado == 1){
            $this->emit('customMessage','Se anuló la deshabilitación correctamente');
        }else{
            $this->emit('messageFailed');
        }
    }

    public function createCode(){
        $paterno = trim($this->paterno);
        $materno = trim($this->materno);
        $nombre = trim($this->nombre);
        $iniciales = Str::substr($paterno, 0, 1) . '' . Str::substr($materno, 0, 1) . '' . Str::substr($nombre, 0, 1);
        $this->codigo = $iniciales . '' . $this->carnet;
    }

    public function create(){
        $this->resetInputs();
        $this->resetValidation();
        $this->opcion = 'crear';
    }

    public function openModal(){
        $this->modalFormVisible = true;
    }

    public function closeModal(){
        $this->modalFormVisible = false;
    }

    public function openModalShow(Estudiante $estudiante){
        $this->carnet = $estudiante->carnet;
        $this->expedido = $estudiante->expedido;
        $this->codigo = $estudiante->codigo;
        $this->nombre = $estudiante->nombre;
        $this->paterno = $estudiante->paterno;
        $this->materno = $estudiante->materno;
        $this->email = $estudiante->email;
        $this->celular = $estudiante->celular;
        $this->grado = $estudiante->grado->grado;
        $this->profesion = $estudiante->grado->profesion;
        $this->carrera = $estudiante->grado->carrera;
        $this->universidad = $estudiante->grado->universidad;
        $this->nombreFamiliar = $estudiante->familiares->nombre_completo;
        $this->celularFamiliar = $estudiante->familiares->celular;
        $this->modalShowVisible = true;
    }

    public function rules(){
        return [
            'carnet' => ['required', Rule::unique('estudiantes','carnet')->ignore($this->estudianteId)],
            'nombre' => 'required',
            'expedido' => 'required',
            'paterno' => 'required',
            'materno' => 'required',
            'email' => 'required|email',
            'celular' => 'required|numeric',
            'grado' => 'required',
            'carrera' => 'required',
            'universidad' => 'required',
            'nombreFamiliar' => 'required',
            'paternoFamiliar' => 'required',
            'maternoFamiliar' => 'required',
            'celularFamiliar' => 'required',
        ];
    }

    public function save(){
        $this->validate();
        $estudiante = Estudiante::create([
            'codigo' => trim($this->codigo),
            'carnet' => trim($this->carnet),
            'expedido' => trim($this->expedido),
            'complemento' => trim($this->complemento),
            'nombre' => mb_strtolower(trim($this->nombre)),
            'paterno' => mb_strtolower(trim($this->paterno)),
            'materno' => mb_strtolower(trim($this->materno)),
            'celular' => trim($this->celular),
            'email' => trim( $this->email)
        ]);
        GradoAcademico::create([
            'estudiante_id' => $estudiante->id,
            'grado' => trim($this->grado),
            'carrera' => mb_strtolower(trim($this->carrera)),
            'profesion' => mb_strtolower(trim($this->profesion)),
            'universidad' => mb_strtolower(trim($this->universidad))
        ]);
        Familiar::create([
            'estudiante_id' => $estudiante->id,
            'nombre'  => mb_strtolower(trim($this->nombreFamiliar)),
            'paterno' => mb_strtolower(trim($this->paternoFamiliar)),
            'materno' => mb_strtolower(trim($this->maternoFamiliar)),
            'celular' => trim($this->celularFamiliar)
        ]);

        $this->resetInputs();
        $this->closeModal();
        $this->opcion = 'listado';
        if($estudiante){
            $this->emit('messageSuccess','create');
        }else{
            $this->emit('messageFailed');
        }
    }

    public function edit(Estudiante $estudiante){
        $this->opcion = 'editar';
        $this->resetValidation();
        $this->estudianteId = $estudiante->id;
        $this->carnet = $estudiante->carnet;
        $this->expedido = $estudiante->expedido;
        $this->codigo = $estudiante->codigo;
        $this->complemento = $estudiante->complemento;
        $this->nombre = $estudiante->nombre;
        $this->paterno = $estudiante->paterno;
        $this->materno = $estudiante->materno;
        $this->email = $estudiante->email;
        $this->celular = $estudiante->celular;
        $this->grado = $estudiante->grado->grado;
        $this->profesion = $estudiante->grado->profesion;
        $this->carrera = $estudiante->grado->carrera;
        $this->universidad = $estudiante->grado->universidad;
        $this->paternoFamiliar = $estudiante->familiares->paterno;
        $this->maternoFamiliar = $estudiante->familiares->materno;
        $this->nombreFamiliar = $estudiante->familiares->nombre;
        $this->celularFamiliar = $estudiante->familiares->celular;
    }

    public function update(){
        $this->validate();
        Estudiante::where('id', $this->estudianteId)->update([
            'codigo' => $this->codigo,
            'carnet' => $this->carnet,
            'complemento' => $this->complemento,
            'expedido' => $this->expedido,
            'nombre' => mb_strtolower(trim($this->nombre)),
            'paterno' => mb_strtolower(trim($this->paterno)),
            'materno' => mb_strtolower(trim($this->materno)),
            'celular' => $this->celular,
            'email' => $this->email,
        ]);
        GradoAcademico::where('estudiante_id',$this->estudianteId)->update([
            'estudiante_id' => $this->estudianteId,
            'grado' => $this->grado,
            'carrera' => mb_strtolower(trim($this->carrera)),
            'profesion' => mb_strtolower(trim($this->profesion)),
            'universidad' => mb_strtolower(trim($this->universidad))
        ]);
        $this->emit('messageSuccess','update');
        $this->resetInputs();
        $this->closeModal();
        $this->opcion = 'listado';
    }


    public function resetInputs(){
        $this->estudianteId = '';
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

    public function import(){

        try {
            $this->validate([
                'excel' => 'required|file|mimes:xlsx,xlsm,xlsb,xltx'
            ]);
            $this->nombreBotonCarga = 'Subiendo...';
            Excel::import(new EstudiantesImport, $this->excel);
            $this->closeModal();
            $this->nombreBotonCarga = 'Subir';
            $this->emit('messageSuccess');
        } catch (ValidationException $e) {
            $failures = $e->failures();
            session()->flash('failures', $failures);
            return redirect()->route('admin.estudiantes.index');
        }
    }

    public function openModalUser(Estudiante $estudiante){
        $this->resetInputs();
        $this->estudianteId = $estudiante->id;
        $this->nombre = $estudiante->nombre;
        $this->paterno = $estudiante->paterno;
        $this->materno = $estudiante->materno;
        $this->userName = ucwords(mb_strtolower($estudiante->nombre));
        $this->userPassword = $estudiante->codigo;
        $this->userEmail = $estudiante->email;
        $this->modalFormUserVisible = true;
    }
    protected $validationAttributes = [
        'userEmail' => 'correo electrónico'
    ];
    protected $messages = [
        'userEmail.unique' => 'Ya existe el usuario con este correo electrónico',
    ];

    public function addUser(){
        $this->validate([
            'userEmail' => Rule::unique('users','email'),
        ]);

        $usuario_general = UsuarioGeneral::create([
            'generable_type' => 'App\Models\Estudiante',
            'generable_id' => $this->estudianteId
        ]);

        User::create([
            'name' => $this->userName,
            'email' => $this->userEmail,
            'password' => bcrypt($this->userPassword),
            'usuario_general_id' => $usuario_general->id
        ])->assignRole('Estudiante');

        $this->resetInputs();
        $this->modalFormUserVisible = false;
        $this->emit('customSuccess', 'Usuario creado satisfactoriamente');
    }
}
