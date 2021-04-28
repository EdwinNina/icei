<?php

namespace App\Http\Livewire;

use App\Models\Carrera;
use App\Models\Estudiante;
use App\Models\Inscripcion;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class KardexEstudianteComponent extends Component
{

    public $estudiante_id_activo;
    public $carreras, $estudiante, $carrera_id = '';

    public function render()
    {
        $cursos = Inscripcion::where('estudiante_id', $this->estudiante_id_activo)->FiltroPorCarrera($this->carrera_id)->get();
        return view('livewire.kardex-estudiante-component', [
            'cursos' => $cursos
        ]);
    }
}
