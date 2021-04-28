<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Familiar;
use App\Models\Estudiante;

class BuscadorEstudianteComponent extends Component
{

    public $modalFormVisible = false;
    public $buscarPorCarnet, $estudianteEncontrado;
    public $estudiante_id, $estudiante_celular, $id_edicion, $nombreCompletoEstudiante;
    public $nombre, $paterno, $materno, $celular;

    public function render()
    {
        return view('livewire.buscador-estudiante-component');
    }

    protected $listeners = ['refreshData'];

    protected $rules = [
        'buscarPorCarnet' => 'required|min:3',
    ];

    public function updated($buscarPorCarnet)
    {
        $this->validateOnly($buscarPorCarnet);
    }

    public function buscarEstudiante(){
        $validatedData = $this->validate();
        $this->estudianteEncontrado = Estudiante::where('carnet','like', '%' . $validatedData['buscarPorCarnet'] . '%')->get();
    }

    public function updatedEstudianteId($estudiante_id){
        $familiar = Familiar::where('estudiante_id', $estudiante_id)->first();
        $this->nombreCompletoEstudiante = Estudiante::where('id', $estudiante_id)->first();
        $this->nombre = $familiar->nombre;
        $this->paterno = $familiar->paterno;
        $this->materno = $familiar->materno;
        $this->celular = $familiar->celular;
    }

    public function refreshData(){
        $this->buscarEstudiante();
    }

    public function edit(Estudiante $estudiante){
        $this->resetValidation();
        $this->estudiante_celular = '';
        $this->id_edicion = '';
        $this->estudiante_celular = $estudiante->celular;
        $this->id_edicion = $estudiante->id;
        $this->modalFormVisible = true;
    }

    public function update(){
        $this->validate([
            'estudiante_celular' => 'required|min:8'
        ]);
        $estudiante = Estudiante::where('id', $this->id_edicion)->first();
        $estudiante->celular = $this->estudiante_celular;
        $estudiante->save();
        $this->emit('messageSuccess');
        $this->emit('refreshData');
        $this->modalFormVisible = false;
    }
}
