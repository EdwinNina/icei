<?php

namespace App\Http\Livewire;

use App\Models\Modulo;
use App\Models\Carrera;
use App\Models\DetalleInscripcion;
use App\Models\Horario;
use App\Models\Inscripcion;
use App\Models\InscripcionEconomico;
use Livewire\Component;
use App\Models\TipoPago;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class InscripcionFormComponent extends Component
{
    use WithFileUploads;

    public $modulos, $horarios, $carreras, $pagos;
    public $moduloSeleccionado = [];
    public $modalidad = '', $modulo_id, $carrera_id;
    public $estudiante;
    public $planificacion;

    public function render()
    {
        return view('livewire.inscripcion-form-component');
    }

    public function updatedCarreraId($carrera_id){
        $this->modulos = Modulo::where('carrera_id', $carrera_id)->get();
        $carrera = Carrera::find($carrera_id)->first();
        $this->planificacion = $carrera->planificacion;
        $this->modalidad = $this->planificacion->modalidad;
    }
    public function updatedModuloSeleccionado(){
        $this->modulo_id = $this->moduloSeleccionado[0];
    }

    public function save(){
        Inscripcion::create([
            'estado' => 'inscrito',
            'planificaciones_id' => $this->planificacion_id,
            'estudiante_id' => $this->estudianteId,
            'tipo_pago_id' => $this->tipo_pago_id,
        ]);

        // $economico = new InscripcionEconomico();
        // $economico->numero_recibo = $this->numero_recibo;
        // $economico->monto = $this->monto;
        // $economico->fecha_pago = $this->fecha_pago;
        // $economico->inscripcion_id =$inscripcion->id;

        // $path = 'storage/boletasInscripcion';
        // $file = $this->boleta;
        // $nameFile = time() . '.' . $file->extension();
        // $file->move(public_path($path), $nameFile);
        // $economico->boleta = $nameFile;

        // $economico->save();

        // DetalleInscripcion::create([
        //     'horario_id' => $this->horario_id,
        //     'modulo_id' => $this->modulo_id,
        //     'inscripcion_id' => $inscripcion->id
        // ]);
        $this->emit('messageSuccess','create');
    }

    public function rules(){
        return [
            'carrera_id' => 'required',
            'horario_id' => 'required',
            'tipo_pago_id' => 'required',
            'numero_recibo' => 'required',
            'monto' => 'required',
            'fecha_pago' => 'required',
            'boleta' => 'required',
        ];
    }

    public function resetInputs(){
        $this->carrera_id = '';
        $this->horario_id = '';
        $this->tipo_pago_id = '';
        $this->numero_recibo = '';
        $this->monto = '';
        $this->fecha_pago = '';
        $this->boleta = '';
        $this->modulos = '';
    }
}
