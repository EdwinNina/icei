<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Horario;
use App\Models\TipoPago;
use App\Models\Estudiante;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use App\Models\DetalleInscripcion;
use Illuminate\Support\Facades\DB;
use App\Models\InscripcionEconomico;

class InscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Estudiante $estudiante)
    {
        $horarios = Horario::get();
        $carreras = Carrera::get();
        $pagos = TipoPago::get();

        return view('admin.inscripciones.create', compact('estudiante','horarios','carreras','pagos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $inscripcion = Inscripcion::create([
                'estado' => 'inscrito',
                'planificaciones_id' => $request->planificacion_id,
                'estudiante_id' => $request->estudiante_id,
                'tipo_pago_id' => $request->tipo_pago_id,
            ]);

            $economico = new InscripcionEconomico();
            $economico->numero_recibo = $request->numero_recibo;
            $economico->monto = $request->monto;
            $economico->fecha_pago = $request->fecha_pago;
            $economico->inscripcion_id =$inscripcion->id;

            $path = 'storage/boletasInscripcion';
            $file = $request->boleta;
            $nameFile = time() . '.' . $file->extension();
            $file->move(public_path($path), $nameFile);
            $economico->boleta = $nameFile;

            $economico->save();

            DetalleInscripcion::create([
                'horario_id' => $request->horario_id,
                'modulo_id' => $request->moduloSeleccionado,
                'inscripcion_id' => $inscripcion->id
            ]);
            DB::commit();
            return redirect()->route('admin.inscripciones.index');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('admin.estudiante.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
