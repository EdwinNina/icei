<?php

namespace App\Http\Livewire;

use App\Models\Modulo;
use App\Models\Carrera;
use App\Models\Docente;
use App\Models\Horario;
use Livewire\Component;
use App\Models\Modalidad;
use Livewire\WithPagination;
use App\Models\PlanificacionCarrera;
use App\Models\PlanificacionModulo;

class FiltroPlanificacionModuloComponent extends Component
{
    use WithPagination;

    public $carrera_id = '', $horario_id= '', $modulo_id= '', $modalidad_id, $gestion;
    public $docente_id = '', $planificacionModulo;
    public $modulos,$horarios,$docentes,$carreras,$modalidades, $planificaciones = [];
    public $gestiones = ['2018' => '2018','2019' => '2019','2020' => '2020','2021' => '2021','2022' => '2022',
                        '2023' => '2023','2024' => '2024','2025' => '2025','2026' => '2026','2027' => '2027',
                        '2028' => '2028','2028' => '2028','2029' => '2029','2030' => '2030'];

    public function mount(){
        $this->horarios = Horario::get();
        $this->carreras = Carrera::get();
        $this->modalidades = Modalidad::get();
        $this->docentes = Docente::select('nombre','paterno','materno','id')->get();
        $this->gestion = date('Y');
    }

    public function render()
    {
        return view('livewire.filtro-planificacion-modulo-component');
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
        ])->whereHas('planificacionModulos', function($q){
            $q->where('modulo_id', $this->modulo_id);
        })->filtroDocente($this->docente_id)->get();
    }

    public function limpiarFiltro(){
        $this->carrera_id = '';
        $this->docente_id = '';
        $this->modulo_id = '';
        $this->horario_id = '';
        $this->modalidad_id = '';
        $this->planificaciones = [];
    }
}
