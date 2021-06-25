<?php

namespace App\Http\Livewire;

use App\Models\Nota;
use App\Models\Modulo;
use App\Models\Carrera;
use App\Models\Horario;
use Livewire\Component;
use App\Models\Modalidad;
use App\Models\Inscripcion;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\PlanificacionModulo;

class InscripcionComponent extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $showModalDelete = false, $modalFormVisible = false;
    public $estadoRegistro = 1, $titulo, $mensaje, $opcionBoton = false;
    public $search = '', $estado_congelacion = '';
    public $inscripcion_id, $carrera, $modulo, $fecha_congelacion_inicio, $fecha_congelacion_fin, $congelacion;
    public $modulos, $carrera_id = '', $horario_id = '', $modulo_id = '', $modalidad_id = '', $estado = true;

    public function updatingSearch() {
        $this->resetPage();
    }

    public function render()
    {
        $horarios = Horario::get();
        $carreras = Carrera::get();
        $modalidades = Modalidad::get();
        $inscripciones = Inscripcion::leftJoin('estudiantes as es','inscripcions.estudiante_id','=','es.id')
            ->where('inscripcions.estado',$this->estado)
            ->select('inscripcions.*')->busqueda(trim($this->search))
            ->filtro($this->carrera_id,$this->modulo_id,$this->horario_id,$this->modalidad_id,$this->estado_congelacion);

        $inscripciones = $inscripciones->orderBy('es.paterno','asc')->paginate(10);
        return view('livewire.inscripcion-component', [
            'inscripciones' => $inscripciones,
            'horarios' => $horarios,
            'carreras' => $carreras,
            'modalidades' => $modalidades
        ]);
    }


    public function updatedCarreraId($id){
        $this->modulos = Modulo::where('carrera_id', $id)->get();
        $this->horario_id = '';
        $this->modalidad_id = '';
    }

    public function enableItem($id){
        $this->inscripcion_id = $id;
        $this->showModalDelete = true;
        $this->estadoRegistro = 1;
        $this->titulo = 'Habilitacion';
        $this->mensaje = '¿Desea habilitar este registro?';
    }

    public function openDelete($id){
        $this->inscripcion_id = $id;
        $this->showModalDelete = true;
        $this->estadoRegistro = 0;
        $this->titulo = 'Anulación';
        $this->mensaje = '¿Desea anular este registro?';
    }

    public function delete()
    {
        $inscripcion = Inscripcion::where('id', $this->inscripcion_id)->first();
        $estudiante = $inscripcion->estudiante->id;
        $planificacionModulo = PlanificacionModulo::where([
            ['planificacion_carrera_id', '=', $inscripcion->planificacionCarrera->id],
            ['modulo_id', '=', $inscripcion->modulo_id],
        ])->first();
        $inscripcion->update(['estado' => 0]);

        $notaEncontrada = Nota::where('estudiante_id', $estudiante)->where('planificacion_modulo_id',$planificacionModulo->id)->first();
        if ($inscripcion->estado === 0) {
            if ($notaEncontrada != null) {
                Nota::where([
                    'estudiante_id' => $estudiante,
                    'planificacion_modulo_id' => $planificacionModulo->id
                ])->delete();
            }
        }
        $this->showModalDelete = false;
        $this->resetPage();
        $this->emit('deleteItem');
    }

    public function enable(){
        $inscripcion = Inscripcion::where('id', $this->inscripcion_id)->first();
        $estudiante = $inscripcion->estudiante->id;
        $planificacionModulo = PlanificacionModulo::where([
            ['planificacion_carrera_id', '=', $inscripcion->planificacionCarrera->id],
            ['modulo_id', '=', $inscripcion->modulo_id],
        ])->first();
        $inscripcion->update(['estado' => 1]);
        $notaEncontrada = Nota::where('estudiante_id', $estudiante)->where('planificacion_modulo_id',$planificacionModulo->id)->first();
        if ($inscripcion->estado === 1) {
            if ($notaEncontrada == null) {
                Nota::create([
                    'estudiante_id' => $estudiante,
                    'planificacion_modulo_id' => $planificacionModulo->id
                ]);
            }
        }
        $this->showModalDelete = false;
        $this->resetPage();
        $this->emit('deleteItem');
    }

    public function openModalCongelacion(Inscripcion $inscripcion){
        $this->inscripcion_id = $inscripcion->id;
        $this->carrera = Str::title($inscripcion->planificacionCarrera->carrera->titulo);
        $this->modulo = $inscripcion->modulo->titulo_completo;
        $this->congelacion = "0";
        $this->fecha_congelacion_inicio = date('d-m-Y');
        $fecha_nueva = strtotime('+90 day', strtotime($this->fecha_congelacion_inicio));
        $this->fecha_congelacion_fin = date('d-m-Y', $fecha_nueva);
        $this->opcionBoton = true;
        $this->modalFormVisible = true;
    }

    public function congelarModulo(){
        Inscripcion::where('id', $this->inscripcion_id)->update([
            'fecha_congelacion_inicio' => date('Y-m-d', strtotime($this->fecha_congelacion_inicio)),
            'fecha_congelacion_fin' => date('Y-m-d', strtotime($this->fecha_congelacion_fin)),
            'congelacion' => $this->congelacion,
        ]);
        $this->emit('customSuccess','Se congeló el módulo con exito');
        $this->carrera = '';
        $this->modulo = '';
        $this->congelacion = '';
        $this->fecha_congelacion_inicio = '';
        $this->fecha_congelacion_fin = '';
        $this->opcionBoton = false;
        $this->modalFormVisible = false;
    }

    public function openModalDescongelacion(Inscripcion $inscripcion){
        $this->inscripcion_id = $inscripcion->id;
        $this->carrera = Str::title($inscripcion->planificacionCarrera->carrera->titulo);
        $this->modulo = $inscripcion->modulo->titulo_completo;
        $this->congelacion = $inscripcion->congelacion;
        $this->fecha_congelacion_inicio = $inscripcion->fecha_congelacion_inicio->format('d-m-y');
        $this->fecha_congelacion_fin = $inscripcion->fecha_congelacion_fin->format('d-m-y');
        $this->modalFormVisible = true;
    }

    public function descongelarModulo(){
        Inscripcion::where('id', $this->inscripcion_id)->update([
            'fecha_congelacion_inicio' => null,
            'fecha_congelacion_fin' => null,
            'congelacion' => $this->congelacion,
        ]);
        $this->emit('customSuccess','Se anuló la congelación del módulo con exito');
        $this->carrera = '';
        $this->modulo = '';
        $this->fecha_congelacion_inicio = '';
        $this->fecha_congelacion_fin = '';
        $this->congelacion = '';
        $this->modalFormVisible = false;
    }

    public function limpiarFiltro(){
        $this->carrera_id = '';
        $this->modulo_id = '';
        $this->horario_id = '';
        $this->modalidad_id = '';
        $this->estado_congelacion = '';
    }
}
