<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Modulo;
use App\Models\Carrera;
use App\Models\Horario;
use Livewire\Component;
use App\Models\Familiar;
use App\Models\TipoPago;
use App\Models\Modalidad;
use App\Models\Estudiante;
use App\Models\Inscripcion;
use App\Models\TipoPlanPago;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Models\PlanificacionModulo;
use App\Models\InscripcionEconomico;
use App\Models\PlanificacionCarrera;

class InscripcionComponent extends Component
{

    use WithFileUploads;
    use WithPagination;
    public $showModalDelete = false, $modalShowVisible = false, $verificarPlanificacion = false, $mostrarPagos;
    public $opcion = 'listado', $estadoRegistro = 1, $titulo, $mensaje, $tituloFormulario = 'Registrar Inscripción';
    public $search, $buscarPorCarnet, $estudianteEncontrado, $planificaciones, $planificacion_id;
    public $modulos, $planificacionModulos;
    public $modulo_id, $carrera_id, $tipo_pago_id, $horario_id, $actividad, $inscripcion_id, $modalidad_id, $tipo_plan_pago_id;
    public $estudiante_id;
    public $nombre, $paterno, $materno, $celular;
    public $numero_recibo, $monto, $fecha_pago, $boleta;
    public $actividades = ['escuela' => 'Escuela','colegio' => 'Colegio','universidad' => 'Universidad','empresa' => 'Empresa','independiente' => 'Independiente'];

    public function mount() {
        $this->resetPage();
    }

    public function render()
    {
        $horarios = Horario::get();
        $carreras = Carrera::get();
        $tipoPagos = TipoPago::get();
        $tipoPlanPagos = TipoPlanPago::get();
        $modalidades = Modalidad::get();
        $inscripciones = Inscripcion::with('estudiante')->whereHas('estudiante', function($q){
            $q->where('nombre', 'like', '%' . $this->search . '%');
        })->orderBy('id','desc')->paginate('10');

        return view('livewire.inscripcion-component', [
            'inscripciones' => $inscripciones,
            'horarios' => $horarios,
            'carreras' => $carreras,
            'tipoPagos' => $tipoPagos,
            'tipoPlanPagos' => $tipoPlanPagos,
            'modalidades' => $modalidades
        ]);
    }

    // public function buscarEstudiante(){
    //     $this->estudianteEncontrado = Estudiante::where('carnet','like', '%' . $this->buscarPorCarnet . '%')->get();
    // }

    public function updatedbuscarPorCarnet(){
        $this->estudianteEncontrado = Estudiante::where('carnet','like', '%' . $this->buscarPorCarnet . '%')->get();
    }

    public function updatedTipoPagoId($id){
        $verificar = TipoPago::where('id',$id)->first();
        if($verificar->nombre === 'Efectivo'){
            $this->mostrarPagos = true;
        }else{
            $this->mostrarPagos = false;
        }
    }

    public function buscarPlanificacion(){
        $this->planificaciones = PlanificacionCarrera::where([
            ['carrera_id', '=', $this->carrera_id],
            ['horario_id', '=', $this->horario_id],
            ['modalidad_id', '=', $this->modalidad_id]
        ])->get();
    }

    public function consultarPlanificacionModulos($id){
        $this->planificacionModulos = PlanificacionModulo::where('planificacion_carrera_id', $id)->get();
        $this->modalShowVisible = true;
    }

    public function updatedplanificacionId($planificacion_id){
        $this->modulos = PlanificacionModulo::where('planificacion_carrera_id', $planificacion_id)
                        ->where('fecha_inicio','>=', Carbon::now()->format('Y-m-d'))->get();
    }

    public function updatedEstudianteId($estudiante_id){
        $familiar = Familiar::where('estudiante_id', $estudiante_id)->first();
        $this->nombre = $familiar->nombre;
        $this->paterno = $familiar->paterno;
        $this->materno = $familiar->materno;
        $this->celular = $familiar->celular;
    }

    public function create(){
        $this->opcion = 'crear';
        $this->tituloFormulario = 'Registrar Inscripción';
        $this->resetInputs();
    }

    public function save(){
        try {
            DB::beginTransaction();
            $inscripcion = Inscripcion::create([
                'estudiante_id' => $this->estudiante_id,
                'modulo_id' => $this->modulo_id,
                'planificacion_carrera_id' => $this->planificacion_id,
                'tipo_pago_id' => $this->tipo_pago_id,
                'tipo_plan_pago_id' => $this->tipo_plan_pago_id,
                'actividad' => $this->actividad
            ]);

            $economico = new InscripcionEconomico();
            $economico->monto = $this->monto;
            $economico->fecha_pago = $this->fecha_pago;
            $economico->inscripcion_id = $inscripcion->id;
            if(!$this->mostrarPagos){
                $economico->numero_recibo = $this->numero_recibo;
                $pdfPath = $this->boleta->store('boletasInscripcion','public');
                $economico->boleta = $pdfPath;
            }
            $economico->save();

            DB::commit();
            $this->opcion = 'listado';
            $this->resetInputs();
            $this->emit('messageSuccess','create');
        } catch (\Throwable $th) {
            DB::rollback();
            $this->emit('messageFailed');
        }
    }

    public function edit(Inscripcion $inscripcion){
        $this->resetInputs();
        $this->resetValidation();
        $this->opcion = 'editar';
        $this->tituloFormulario = 'Actualizar Inscripción';
        $this->inscripcion_id = $inscripcion->id;
        $estudiante = Estudiante::where('id',$inscripcion->estudiante_id)->first();
        $familiar = Familiar::where('estudiante_id', $estudiante->id)->first();
        $this->buscarPorCarnet = $estudiante->carnet;
        $this->estudiante_id = $estudiante->id;
        $this->estudianteEncontrado = Estudiante::where('carnet','like', '%' . $this->buscarPorCarnet . '%')->get();
        $this->nombre = $familiar->nombre;
        $this->paterno = $familiar->paterno;
        $this->materno = $familiar->materno;
        $this->celular = $familiar->celular;
        $this->carrera_id = $inscripcion->modulo->carrera->id;
        $this->horario_id = $inscripcion->planificacionCarrera->horario->id;
        $this->modalidad_id = $inscripcion->planificacionCarrera->modalidad_id;
        $this->planificacion_id = $inscripcion->planificacionCarrera->id;
        $this->tipo_pago_id = $inscripcion->tipo_pago_id;
        $this->modulos = PlanificacionModulo::where('planificacion_carrera_id', $this->planificacion_id)
                        ->where('fecha_inicio','>=', Carbon::now()->format('Y-m-d'))->get();
        $this->planificaciones = PlanificacionCarrera::where([
            ['carrera_id', '=', $this->carrera_id],
            ['horario_id', '=', $this->horario_id],
            ['modalidad_id', '=', $this->modalidad_id]
        ])->get();
        $this->modulo_id = $inscripcion->modulo_id;
        $this->tipo_plan_pago_id = $inscripcion->tipo_plan_pago_id;
        $this->actividad = $inscripcion->actividad;
        $this->monto = $inscripcion->pagoInscripcion->monto;
        if($inscripcion->tipo_pago_id === 1){
            $this->mostrarPagos = true;
        }
        $this->numero_recibo = $inscripcion->pagoInscripcion->numero_recibo;
        $this->fecha_pago = $inscripcion->pagoInscripcion->fecha_pago;
    }

    public function update(){
        Inscripcion::where('id', $this->inscripcion_id)->update([
            'estudiante_id' => $this->estudiante_id,
            'planificacion_carrera_id' => $this->planificacion_id,
            'tipo_plan_pago_id' => $this->tipo_plan_pago_id,
            'tipo_pago_id' => $this->tipo_pago_id,
            'modulo_id' =>  $this->modulo_id,
            'actividad' => $this->actividad
        ]);

        InscripcionEconomico::where('inscripcion_id', $this->inscripcion_id)->update([
            'numero_recibo' => $this->numero_recibo,
            'monto' => $this->monto,
            'fecha_pago' => $this->fecha_pago
        ]);

        $this->opcion = 'listado';
        $this->resetInputs();
        $this->emit('messageSuccess','update');
    }

    protected $validationAttributes = [
        'carrera_id' => 'carrera',
        'tipo_pago_id' => 'tipo de pago',
        'numero_recibo' => 'numero de recibo',
        'fecha_pago' => 'fecha de pago',
    ];

    public function rules(){
        return [
            'carrera_id' => 'required',
            'tipo_pago_id' => 'required',
            'monto' => 'required',
            'fecha_pago' => 'required',
        ];
    }

    public function resetInputs(){
        $this->inscripcion_id = '';
        $this->estudiante_id= '';
        $this->horario_id = '';
        $this->tipo_pago_id = '';
        $this->numero_recibo = '';
        $this->monto = '';
        $this->actividad = '';
        $this->fecha_pago = '';
        $this->modulos = null;
        $this->modulo_id = '';
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

    public function delete(){
        Inscripcion::where('id', $this->inscripcion_id)->update(['estado' => 0]);
        $this->showModalDelete = false;
        $this->resetPage();
        $this->emit('deleteItem');
    }

    public function enable(){
        Inscripcion::where('id', $this->inscripcion_id)->update(['estado' => 1]);
        $this->showModalDelete = false;
        $this->resetPage();
        $this->emit('deleteItem');
    }
}
