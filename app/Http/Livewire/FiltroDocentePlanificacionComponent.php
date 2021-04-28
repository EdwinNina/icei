<?php

namespace App\Http\Livewire;

use App\Models\Modulo;
use App\Models\Carrera;
use App\Models\Docente;
use App\Models\Horario;
use Livewire\Component;
use App\Models\Modalidad;
use Livewire\WithPagination;
use App\Models\PlanificacionModulo;
use App\Models\PlanificacionCarrera;
use Illuminate\Support\Facades\Auth;

class FiltroDocentePlanificacionComponent extends Component
{
    use WithPagination;

    public $carrera_id = '', $horario_id= '', $modulo_id= '', $modalidad_id, $gestion;
    public $planificacionModulo = null, $docente_activo;
    public $modulos, $horarios, $carreras, $modalidades, $planificaciones = [];

    public function mount(){
        $this->docente_activo = Auth::user()->usuarioGeneral->generable_id;
        $this->horarios = Horario::whereHas('planificacionCarrera', function($query){
            $query->where('docente_id', $this->docente_activo);
        })->get();
        $this->carreras = Carrera::select('id','titulo')->whereHas('planificacionCarrera', function($query){
            $query->where('docente_id', $this->docente_activo);
        })->get();
        $this->modalidades = Modalidad::get();
        $this->docentes = Docente::select('nombre','paterno','materno','id')->get();
        $this->gestion = date('Y');
    }

    public function render()
    {
        return view('livewire.filtro-docente-planificacion-component');
    }

    public function updatedCarreraId($id){
        $this->modulos = Modulo::where('carrera_id', $id)->get();
        $this->horario_id = '';
        $this->modalidad_id = '';
    }

    public function buscarPlanificacion(){
        $this->planificaciones = PlanificacionCarrera::where([
            ['carrera_id', '=', $this->carrera_id],
            ['horario_id', '=', $this->horario_id],
            ['modalidad_id', '=', $this->modalidad_id],
            ['gestion','=', $this->gestion],
            ['docente_id','=', $this->docente_activo],
        ])->whereHas('planificacionModulos', function($q){
            $q->where('modulo_id', $this->modulo_id);
        })->get();
    }

    public function limpiarFiltro(){
        $this->carrera_id = '';
        $this->modulo_id = '';
        $this->horario_id = '';
        $this->modalidad_id = '';
        $this->planificaciones = [];
    }
}

