<?php

namespace App\Http\Controllers;

use App\Models\Certificado;
use Carbon\Carbon;
use NumeroALetras;
use App\Models\Modulo;
use App\Models\TipoPago;
use App\Models\Estudiante;
use App\Models\Inscripcion;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Str;
use App\Models\TipoPlanPago;
use Illuminate\Http\Request;
use App\Models\Configuracion;
use App\Models\RegistroEconomico;
use Illuminate\Support\Facades\DB;

class InscripcionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.inscripciones.create')->only('create','store');
        $this->middleware('can:admin.inscripciones.edit')->only('edit','update');
    }

    public function create()
    {
        $actividades = ['escuela' => 'Escuela','colegio' => 'Colegio','universidad' => 'Universidad','empresa' => 'Empresa','independiente' => 'Independiente'];
        $tipoPagos = TipoPago::get();
        $tipoPlanPagos = TipoPlanPago::get();

        return view('admin.inscripciones.create', compact('actividades','tipoPagos','tipoPlanPagos'));
    }

    public function store(Request $request){
        try {
            DB::beginTransaction();
            $inscripcion = Inscripcion::create([
                'estudiante_id' => $request->estudiante_id,
                'modulo_id' => $request->modulo_id,
                'planificacion_carrera_id' => $request->planificacion_id,
                'tipo_plan_pago_id' => $request->tipo_plan_pago_id,
                'actividad' => $request->actividad,
                'total_modulo' => $request->total_modulo,
                'total_pagado' => $request->total_pagado,
                'saldo' => $request->saldo,
            ]);

            foreach ($request->pagos as $pago) {
                $pagos = new RegistroEconomico([
                    'monto' => $pago['monto'],
                    'concepto' => $pago['concepto'],
                    'fecha_pago' => $pago['fecha_pago'],
                    'numero_recibo' => $pago['numero_recibo'],
                    'tipo_pago_id' => $pago['tipo_pago_id'],
                    'tipo_razon_id' => $pago['tipo_razon_id'],
                    'estado' => $request->saldo > 0 ? 2 : 1,
                ]);
                $inscripcion->pagosInscripcion()->save($pagos);
            }
            DB::commit();
            return redirect()->route('admin.inscripciones.edit', $inscripcion->id)->with('message','good');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('admin.inscripciones.index')->with('message','bad');
        }
    }

    public function edit(Inscripcion $inscripcion){
        $estudiante = Estudiante::where('id', $inscripcion->estudiante_id)->first();
        $configuracion = Configuracion::select('nota_minima_aprobacion')->first();
        $nota_minima_aprobacion = $configuracion->nota_minima_aprobacion;
        return view('admin.inscripciones.edit', compact('inscripcion', 'estudiante', 'nota_minima_aprobacion'));
    }

    public function update(Request $request, Inscripcion $inscripcion){
        try {
            DB::beginTransaction();
            if($request->opcion === 'inscripcion'){
                $inscripcion->total_pagado = $request->total_pagado;
                $inscripcion->saldo = $request->saldo;
                $inscripcion->save();
                foreach ($request->pagos as $pago) {
                    $pagos = new RegistroEconomico([
                        'monto' => $pago['monto'],
                        'concepto' => $pago['concepto'],
                        'fecha_pago' => $pago['fecha_pago'],
                        'numero_recibo' => $pago['numero_recibo'],
                        'tipo_pago_id' => $pago['tipo_pago_id'],
                        'tipo_razon_id' => $pago['tipo_razon_id'],
                        'estado' => $request->saldo > 0 ? 2 : 1,
                    ]);
                    $inscripcion->pagosInscripcion()->save($pagos);
                }
            }elseif ($request->opcion === 'examen') {
                $inscripcion->saldo_examen = $request->saldo;
                $inscripcion->save();
                foreach ($request->pagos as $pago) {
                    $pagos = new RegistroEconomico([
                        'monto' => $pago['monto'],
                        'concepto' => $pago['concepto'],
                        'fecha_pago' => $pago['fecha_pago'],
                        'numero_recibo' => $pago['numero_recibo'],
                        'tipo_pago_id' => $pago['tipo_pago_id'],
                        'tipo_razon_id' => $pago['tipo_razon_id'],
                        'estado' => $request->saldo > 0 ? 2 : 1,
                    ]);
                    $inscripcion->pagosInscripcion()->save($pagos);
                }
            }elseif ($request->opcion === 'certificado') {
                $inscripcion->saldo_certificado = $request->saldo;
                $inscripcion->save();
                foreach ($request->pagos as $pago) {
                    $pagos = new RegistroEconomico([
                        'monto' => $pago['monto'],
                        'concepto' => $pago['concepto'],
                        'fecha_pago' => $pago['fecha_pago'],
                        'numero_recibo' => $pago['numero_recibo'],
                        'tipo_pago_id' => $pago['tipo_pago_id'],
                        'tipo_razon_id' => $pago['tipo_razon_id'],
                        'estado' => $request->saldo > 0 ? 2 : 1,
                    ]);
                    $inscripcion->pagosInscripcion()->save($pagos);
                }
            }
            DB::commit();
            return redirect()->back()->with('message','good');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('message','bad');
        }
    }

    public function cambiarCarrera(Request $request, Inscripcion $inscripcion){
        $inscripcion->planificacion_carrera_id = $request->planificacion_id;
        $inscripcion->modulo_id = $request->modulo_id;
        $inscripcion->save();
        return redirect()->route('admin.inscripciones.edit', $inscripcion->id)->with('message','good');
    }


    public function habilitar2t(Request $request){
        $estado = Inscripcion::where('id', $request->id)->update([
            'habilitado_2t' => true,
            'total_monto_2t' => $request->monto,
            'fecha_habilitado_2t' => date('Y-m-d'),
        ]);
        if($estado){
            return response()->json('good');
        }else{
            return response()->json('bad');
        }
    }

    public function deshabilitar2t(Request $request){
        $estado = Inscripcion::where('id', $request->id)->update([
            'habilitado_2t' => false,
            'total_monto_2t' => null,
            'fecha_habilitado_2t' => null,
        ]);
        if($estado){
            return response()->json('good');
        }else{
            return response()->json('bad');
        }
    }

    public function habilitarCertificado(Request $request){
        try {
            DB::beginTransaction();
            Inscripcion::where('id', $request->id)->update([
                'habilitado_certificado' => true,
                'total_monto_certificado' => $request->monto,
                'fecha_habilitado_certificado' => date('Y-m-d'),
                'saldo_certificado' => $request->monto
            ]);
            $inscripcion = Inscripcion::where('id', $request->id)->first();
            $certificado = new Certificado();
            $certificado->solicitado = 1;
            $certificado->fecha_solicitado = Carbon::now();
            $certificado->estudiante_id = $inscripcion->estudiante->id;
            $certificado->inscripcion_id = $inscripcion->id;
            foreach ($inscripcion->estudiante->notas as $nota) {
                if ($nota->planificacionModulo->modulo_id == $inscripcion->modulo_id){
                    $certificado->planificacion_modulo_id = $nota->planificacionModulo->id;
                    $certificado->nota_id = $nota->id;
                }
            }
            $certificado->save();
            DB::commit();
            return response()->json('good');
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json('bad');
        }
    }

    public function deshabilitarCertificado(Request $request){
        $estado = Inscripcion::where('id', $request->id)->update([
            'habilitado_certificado' => false,
            'total_monto_certificado' => null,
            'fecha_habilitado_certificado' => null,
            'saldo_certificado' => null
        ]);
        if($estado){
            return response()->json('good');
        }else{
            return response()->json('bad');
        }
    }

    public function anularInscripcion(Request $request){
        $estado = Inscripcion::where('id', $request->id)->update(['estado' => 0]);
        if($estado){
            return response()->json('good');
        }else{
            return response()->json('bad');
        }
    }

    public function generarPDF(Inscripcion $inscripcion){
        $fpdf = new Fpdf('P','mm','Letter');
        $fpdf->AddPage();
        $fpdf->Image('images/logo.png',10,6,35);
        // Arial bold 15
        // Arial bold 15
        $fpdf->SetFont('Arial','B',10);
        // Move to the right
        $fpdf->Cell(70);
        // Title
        $fpdf->Cell(20,5,'INSTITUTO TECNICO INGENIERIA',0,0);
        $fpdf->Ln(5);
        $fpdf->Cell(50);
        $fpdf->Cell(20,5,'Y CAPACITACION EN ELECTRONICA E INFORMATICA',0,0);
        $fpdf->SetFont('Arial','',8);
        $fpdf->Ln(2);
        $fpdf->Cell(0,12,'Calle Cochabamba Nro 100 Edificio Jose Santos-Piso 3',0,0,'C');
        $fpdf->Ln(2);
        $fpdf->Cell(0,13,'Telefono 2117862 - Celular 72021277',0,0,'C');
        $fpdf->SetLineWidth(0.5);
        $fpdf->Line(10,30,200,30);
        $fpdf->Ln(15);
        $fpdf->SetFont('Arial','B',15);
        $fpdf->Cell(0,10,'FORMULARIO DE INSCRIPCION',0,0,'C');
        $fpdf->Ln(15);
        $fpdf->SetFont('Arial','B',10);
        $fpdf->Cell(10,10,'1. FECHA DE INSCRIPCION',0,0);
        $fpdf->Cell(40);
        $fpdf->Cell(40,10,$inscripcion->created_at->format('d-m-Y'),1,0,'C');
        $fpdf->Ln(10);
        $fpdf->SetFont('Arial','B',10);
        $fpdf->Cell(10,10,'2. DATOS PERSONALES',0,0);
        $fpdf->Ln(13);
        $fpdf->SetFont('Arial','',10);
        $fpdf->Cell(20,7,'Nombre:',0,0);
        $nombre = $inscripcion->estudiante->nombre_completo;
        $fpdf->Cell(80,7,utf8_decode($nombre),1,0);
        $fpdf->Cell(30);
        $fpdf->Cell(20,7,'No. C.I.:',0,0);
        $fpdf->Cell(40,7,$inscripcion->estudiante->carnet .' ' . $inscripcion->estudiante->expedido,1,0);
        $fpdf->Ln(10);
        $fpdf->Cell(20,7,'Email',0,0);
        $fpdf->Cell(80,7,$inscripcion->estudiante->email,1,0);
        $fpdf->Cell(30);
        $fpdf->Cell(20,7,'Celular:',0,0);
        $fpdf->Cell(40,7,$inscripcion->estudiante->celular,1,0);
        $fpdf->Ln(10);
        $fpdf->SetFont('Arial','B',10);
        $fpdf->Cell(10,10,'3. REFERENCIAS FAMILIARES',0,0);
        $fpdf->Ln(13);
        $fpdf->SetFont('Arial','',10);
        $fpdf->Cell(20,7,'Nombre:',0,0);
        $fpdf->Cell(80,7,utf8_decode($inscripcion->estudiante->familiares->nombre_completo),1,0);
        $fpdf->Cell(30);
        $fpdf->Cell(20,7,'Celular:',0,0);
        $fpdf->Cell(40,7,$inscripcion->estudiante->familiares->celular,1,0);
        $fpdf->Ln(10);
        $fpdf->SetFont('Arial','B',10);
        $fpdf->Cell(10,10,'4. NOMBRE DEL CURSO O MODULO DE FORMACION ESPECIALIZADA',0,0);
        $fpdf->Ln(10);
        $fpdf->SetFont('Arial','',10);
        $fpdf->Cell(20,7,'Carrera:',0,0);
        $fpdf->Cell(80,7,$inscripcion->modulo->carrera->titulo,1,0);
        $fpdf->Ln(10);
        $fpdf->Cell(20,7,'Horario:',0,0);
        $fpdf->Cell(80,7,$inscripcion->planificacionCarrera->horario->horario_completo,1,0);
        $fpdf->Ln(10);
        $fpdf->SetFont('Arial','',8);
        $fpdf->Cell(20,7,'Modulo:',0,0);
        $fpdf->Cell(0,7,utf8_decode($inscripcion->modulo->titulo_completo),1,0);
        $fpdf->Ln(10);
        $fpdf->SetFont('Arial','B',10);
        $fpdf->Cell(10,10,'5. LUGAR DE ESTUDIO U OCUPACION',0,0);
        $fpdf->Ln(10);
        $fpdf->SetFont('Arial','',10);
        $fpdf->Cell(20,7,'Actual:',0,0);
        $fpdf->Cell(0,7,utf8_decode(Str::ucfirst($inscripcion->actividad)),1,0);
        $fpdf->Ln(10);
        $fpdf->Cell(20,7,'Tipo de Plan de Pago:',0,0);
        $fpdf->Cell(20);
        $fpdf->Cell(80,7,$inscripcion->tipoPlanPago->nombre,1,0);
        $fpdf->Ln(20);
        $fpdf->SetLineWidth(0.5);
        $fpdf->Line(30,240,60,240);
        $fpdf->Ln(45);
        $fpdf->Cell(20);
        $fpdf->Cell(30,7,'Firma del alumno',0,0);
        $fpdf->Output('','reporte','true');
        exit;
    }

    public function generarPdfPago(Request $request){
        $pago = RegistroEconomico::where('id', $request->id)->first();
        $configuracion = Configuracion::first();
        $fpdf = new Fpdf('P','mm',array(216,220));
        $fpdf->SetMargins(15,15,15,15);
        $fpdf->AddPage();

        $fpdf->SetDrawColor(0,0,0);
        $fpdf->SetLineWidth(0.3);
        $fpdf->Line(60,30,140,30);

        $fpdf->SetFont('helvetica','B', 10);
        $fpdf->Cell(145,6,utf8_decode(''),0,0,'C');
        $fpdf->Cell(10,6,utf8_decode('Bs'),0,0,'C');
        $fpdf->Cell(35,6,utf8_decode($pago->monto),1,1,'C');

        $fpdf->Image('images/logo.png',15,15,45,15);
        $fpdf->SetFont('helvetica','BI', 10);
        $fpdf->Cell(50,4,utf8_decode(''),0,0,'C');
        $fpdf->MultiCell(60,5,utf8_decode(Str::upper($configuracion->nombre)));
        $fpdf->Cell(140,4,utf8_decode(''),0,0,'C');
        $fpdf->SetFont('helvetica','B', 10);
        $fpdf->SetXY(155,25);
        $fpdf->Cell(15,6,utf8_decode('$us'),0,0,'C');
        $fpdf->Cell(35,6,utf8_decode(''),1,1,'C');

        $fpdf->SetFont('helvetica','B', 6);
        $fpdf->Cell(15,3,utf8_decode('Calle Cochabamba Nro 100'),0,1,'L');
        $fpdf->Cell(15,3,utf8_decode('Edif. José Santos Piso 1'),0,1,'L');
        $fpdf->Cell(15,3,utf8_decode('(lado Edif.: Loteria Nacional)'),0,1,'L');
        $fpdf->Cell(15,3,utf8_decode('Telfs: '. $configuracion->telefono .'- Fax: 2117477'),0,1,'L');
        $fpdf->Cell(15,3,utf8_decode('Cel: '. $configuracion->celular),0,1,'L');

        $fpdf->SetXY(80,35);
        $fpdf->SetFont('helvetica','B', 12);
        $fpdf->Cell(50,6,utf8_decode('C O M P R O B A N T E'),0,1,'C');
        $fpdf->Cell(65,6,(' '),0,0);
        $fpdf->Cell(50,6,utf8_decode('D E   I N G R E S O'),0,1,'C');

        $fpdf->SetXY(160,35);
        $fpdf->Cell(50,6,"NRO. " . $pago->numeroFactura,0,1,'C');

        $fpdf->Ln(10);

        $fpdf->SetFont('helvetica','B', 10);
        $fpdf->Cell(30,6,utf8_decode('He recibido de:'),0,0,'L');
        $fpdf->SetFont('helvetica','', 10);
        $fpdf->Cell(160,6,utf8_decode($pago->economicable->estudiante->nombre_completo),0,1,'C');
        $fpdf->SetXY(55,56);
        $fpdf->Cell(160,1,utf8_decode('.............................................................................................................................................'),0,1,'L');

        $fpdf->Ln(4);
        $fpdf->SetDrawColor(0,0,0);
        $fpdf->SetLineWidth(0.3);
        $fpdf->Rect(15,60,190,25);

        $fpdf->SetFont('helvetica','B', 8);
        $fpdf->Cell(20,6,utf8_decode('La suma de:'),0,0,'L');
        $fpdf->SetFont('helvetica','', 8);
        $fpdf->Cell(140,6,utf8_decode(NumeroALetras::convertir($pago->monto)),0,0,'');
        $fpdf->SetFont('helvetica','B', 8);
        $fpdf->Cell(30,6,utf8_decode('Bolivianos / $us'),0,1,'C');

        $fpdf->SetXY(35,65);
        $fpdf->Cell(135,0,utf8_decode('..............................................................................................................................................................................'),0,1,'L');

        $fpdf->Ln(2);
        $fpdf->SetFont('helvetica','B', 8);
        $fpdf->Cell(30,6,utf8_decode('Por concepto de:'),0,0,'L');
        $fpdf->SetFont('helvetica','', 8);
        $fpdf->MultiCell(120,5,utf8_decode(Str::upper($pago->concepto) . ' PARA EL MODULO ' . Str::upper($pago->economicable->modulo->titulo_completo)),0,'C');

        $fpdf->Ln(2);
        $fpdf->SetFont('helvetica','B', 8);
        $fpdf->Cell(20,6,utf8_decode('C.I.:'),0,0,'L');
        $fpdf->SetFont('helvetica','', 8);
        $fpdf->Cell(20,6,utf8_decode($pago->economicable->estudiante->carnet. ' ' . $pago->economicable->estudiante->expedido),0,1,'L');

        $fpdf->Ln(5);

        $fpdf->Cell(0,6,'La Paz, '. Carbon::now()->format("Y-m-d"),0,1,'R');

        $fpdf->Ln(15);

        $fpdf->Cell(30,4,utf8_decode(''),0,0,'L');
        $fpdf->Cell(60,4,utf8_decode('.............................................................'),0,0,'C');
        $fpdf->Cell(20,4,utf8_decode(''),0,0,'L');
        $fpdf->Cell(60,4,utf8_decode('.............................................................'),0,1,'C');
        $fpdf->Cell(30,4,utf8_decode(''),0,0,'L');
        $fpdf->SetFont('helvetica','B', 8);
        $fpdf->Cell(60,4,utf8_decode('Entregué Conforme'),0,0,'C');
        $fpdf->Cell(20,4,utf8_decode(''),0,0,'L');
        $fpdf->Cell(60,4,utf8_decode('Recibí Conforme'),0,1,'C');
        $fpdf->Output("Comprobante_de_Ingreso.pdf","F");
        $fpdf->Output();
    }
}
