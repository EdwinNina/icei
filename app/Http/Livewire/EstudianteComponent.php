<?php

namespace App\Http\Livewire;

use App\Imports\EstudiantesImport;
use App\Models\Estudiante;
use App\Models\GradoAcademico;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
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
    public $opcion = 'listado';
    public $carnet, $expedido, $nombre, $paterno, $materno, $email, $celular, $estudianteId, $codigo, $excel;
    public $grado, $profesion, $carrera, $universidad;
    public $userEmail, $userPassword, $userName;
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

    public function createCode(){
        $iniciales = Str::substr($this->paterno, 0, 1) . '' . Str::substr($this->materno, 0, 1) . '' . Str::substr($this->nombre, 0, 1);
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
        ];
    }

    public function save(){
        $this->validate();
        $estudiante = Estudiante::create([
            'codigo' => $this->codigo,
            'carnet' => $this->carnet,
            'expedido' => $this->expedido,
            'nombre' => $this->nombre,
            'paterno' => $this->paterno,
            'materno' => $this->materno,
            'celular' => $this->celular,
            'email' => $this->email,
        ]);
        GradoAcademico::create([
            'estudiante_id' => $estudiante->id,
            'grado' => $this->grado,
            'carrera' => $this->carrera,
            'profesion' => $this->profesion,
            'universidad' => $this->universidad
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
        $this->nombre = $estudiante->nombre;
        $this->paterno = $estudiante->paterno;
        $this->materno = $estudiante->materno;
        $this->email = $estudiante->email;
        $this->celular = $estudiante->celular;
        $this->grado = $estudiante->grado->grado;
        $this->profesion = $estudiante->grado->profesion;
        $this->carrera = $estudiante->grado->carrera;
        $this->universidad = $estudiante->grado->universidad;
    }

    public function update(){
        $this->validate();
        Estudiante::where('id', $this->estudianteId)->update([
            'codigo' => $this->codigo,
            'carnet' => $this->carnet,
            'expedido' => $this->expedido,
            'nombre' => $this->nombre,
            'paterno' => $this->paterno,
            'materno' => $this->materno,
            'celular' => $this->celular,
            'email' => $this->email,
        ]);
        GradoAcademico::where('estudiante_id',$this->estudianteId)->update([
            'estudiante_id' => $this->estudianteId,
            'grado' => $this->grado,
            'carrera' => $this->carrera,
            'profesion' => $this->profesion,
            'universidad' => $this->universidad
        ]);
        $this->emit('messageSuccess','update');
        $this->resetInputs();
        $this->closeModal();
        $this->opcion = 'listado';
    }

    public function openDelete($id){
        $this->estudianteId = $id;
        $this->showModalDelete = true;
    }

    public function delete(){
        Estudiante::where('id', $this->estudianteId)->delete();
        $this->showModalDelete = false;
        $this->resetPage();
        $this->emit('deleteItem');
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
            return redirect()->route('admin.estudiante.index');
        }
    }

    public function openModalUser(Estudiante $estudiante){
        $this->resetInputs();
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

        User::create([
            'name' => $this->userName,
            'email' => $this->userEmail,
            'password' => bcrypt($this->userPassword)
        ])->assignRole('Estudiante');
        $this->resetInputs();
        $this->modalFormUserVisible = false;
        $this->emit('customMessage', 'Usuario creado satisfactoriamente');
    }
}
