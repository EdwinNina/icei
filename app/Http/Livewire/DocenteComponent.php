<?php

namespace App\Http\Livewire;

use App\Models\Docente;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class DocenteComponent extends Component
{
    use WithPagination;

    public $modalFormVisible = false;
    public $showModalDelete = false;
    public $search;
    public $carnet, $nombre, $paterno, $materno, $email, $celular, $expedido, $docenteId;
    public $expedidos = ['CH' => 'CH', 'LP' => 'LP', 'CB' => 'CB', 'OR' => 'OR', 'PT' => 'PT',
    'TJ' => 'TJ', 'SC' => 'SC', 'BN' => 'BN', 'PD' => 'PD'];


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

        return view('livewire.docente-component', ['docentes' => $docentes]);
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
    }

}
