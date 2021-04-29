<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use NumeroALetras;
use App\Models\Nota;
use App\Models\Modulo;
use App\Models\Carrera;
use App\Models\Estudiante;
use App\Models\Inscripcion;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Configuracion;
use App\Models\RegistroEconomico;
use App\Models\CertificadoCarrera;
use Illuminate\Support\Facades\DB;
use App\Models\PlanificacionModulo;

class CertificadoFinalController extends Controller
{
    public function index(){
        $carreras = Carrera::select('id','titulo')->get();
        $gestiones = ['2021' => '2021','2022' => '2022','2023' => '2023','2024' => '2024','2025' => '2025',
                    '2026' => '2026','2027' => '2027','2028' => '2028','2028' => '2028','2029' => '2029',
                    '2030' => '2030','2031' => '2031','2032' => '2032','2033' => '2033','2034' => '2034',
                    '2035' => '2035','2036' => '2036','2037' => '2037','2038' => '2038','2039' => '2039','2040' => '2040'];

        return view('admin.certificadoFinal.index', compact('carreras','gestiones'));
    }

    public function busqueda(Request $request){
        $validacion = $request->validate([
            'estudiante_id' => 'required',
            'carrera' => 'required',
            'gestion' => 'required',
        ]);
        $carrera = Carrera::where('id',$validacion['carrera'])->first();
        $estudiante = Estudiante::where('id',$validacion['estudiante_id'])->first();
        $configuracion = Configuracion::select('nota_minima_aprobacion')->first();
        $nota_minima_aprobacion = $configuracion->nota_minima_aprobacion;
        $inscripciones = Inscripcion::where('estudiante_id', $estudiante->id)->get();
        $encontradosInscripcion = array();
        $planificacion_carrera_id = null;

        foreach ($carrera->planificacionCarrera as $planificacion) {
            foreach ($inscripciones as $index => $inscripcion) {
                if($inscripcion->planificacion_carrera_id == $planificacion->id){
                    $encontradosInscripcion[$index] = $inscripcion;
                    $planificacion_carrera_id = $planificacion->id;
                }
            }
        }
        $encontradosPlanificacionNotas = array();
        foreach ($encontradosInscripcion as $item) {
            $encontradosPlanificacionModulo = PlanificacionModulo::where('planificacion_carrera_id', $item->planificacion_carrera_id)->get();
            foreach ($encontradosPlanificacionModulo as $index => $planificacion) {
                $encontradosPlanificacionNotas[$index] = Nota::where('planificacion_modulo_id', $planificacion->id)->where('estudiante_id', $item->estudiante->id)->first();
            };
        }
        return view('admin.certificadoFinal.verificacion', compact('encontradosPlanificacionNotas','nota_minima_aprobacion','estudiante','carrera','planificacion_carrera_id'));
    }

    public function guardarCertificado(Request $request){
        $validacion = $request->validate([
            'solicitud' => 'required',
            'costo' => 'required'
        ]);

        $estado = CertificadoCarrera::create([
            'total_certificado' => $validacion['costo'],
            'solicitado' =>  $validacion['solicitud'],
            'fecha_solicitado' => date(now()),
            'saldo' => $validacion['costo'],
            'estudiante_id' => $request->estudiante_id,
            'carrera_id' => $request->carrera_id,
            'planificacion_carrera_id' => $request->planificacion_carrera_id,
        ]);

        if($estado){
            return redirect()->route('admin.certificadoFinal.detalleCertificado', $estado)->with('message','good');
        }else{
            return redirect()->back();
        }
    }

    public function detalleCertificado(CertificadoCarrera $certificado){
        return view('admin.certificadoFinal.detalle-certificado-carrera', compact('certificado'));
    }

    public function update(Request $request, CertificadoCarrera $certificado){
        try {
            DB::beginTransaction();
            $certificado->total_pagado = $request->total_pagado;
            $certificado->saldo = $request->saldo;
            $certificado->save();
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
                $certificado->pagosCertificadoFinal()->save($pagos);
            }
            DB::commit();
            return redirect()->back()->with('message','good');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('message','bad');
        }
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
        $fpdf->MultiCell(120,5,utf8_decode(Str::upper($pago->concepto) . ' PARA OBTENCIÓN DE CERTIFICADO PARA LA CARRERA ' . Str::upper($pago->economicable->carrera->titulo)),0,'C');

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

    public function solicitados() {
        $solicitados = CertificadoCarrera::join('estudiantes as es','certificado_carreras.estudiante_id','=','es.id')
        ->select('certificado_carreras.*')
        ->where([
            ['solicitado','=','1'],
        ])
        ->orderBy('es.paterno','asc')
        ->paginate();
        return view('admin.certificadoFinal.solicitados', compact('solicitados'));
    }

    public function entregados() {
        return view('admin.certificadoFinal.entregados');
    }

    public function activarImpresion(Request $request){
        $impresion = CertificadoCarrera::where('id', $request->id)->update([
            'impresion' => true,
            'fecha_impresion' => date('Y-m-d')
        ]);
        return response()->json($impresion);
    }

    public function desactivarImpresion(Request $request){
        $impresion = CertificadoCarrera::where('id', $request->id)->update([
            'impresion' => false,
            'fecha_impresion' => null
        ]);
        return response()->json($impresion);
    }

    public function solicitarFotos(Request $request){
        $certificado = CertificadoCarrera::where('id', $request->id)->update([
            'fotos' => true
        ]);
        return response()->json($certificado);
    }

    public function cancelarSolicitarFotos(Request $request){
        $certificado = CertificadoCarrera::where('id', $request->id)->update([
            'fotos' => false
        ]);
        return response()->json($certificado);
    }

    public function entregaCertificado(Request $request){
        if(!$request->ajax()){ return; }

        $estado = CertificadoCarrera::where('id', $request->certificado_id)->update([
            'entregado' => true,
            'fecha_entregado' => $request->fecha_entregado,
            'entregado_a' =>  $request->entregado_a,
            'estado' => true
        ]);

        return response()->json($estado);
    }

    public function generarCertificado(CertificadoCarrera $certificado)
    {
        $configuracion = Configuracion::select('director_academico')->first();
        setlocale(LC_TIME, 'es_ES');
        Carbon::setLocale('es');
        $fpdf = new Fpdf('P','cm','Legal');
        $fpdf->AddPage();
        $fpdf->SetXY(8.3,16.5);
        $fpdf->SetFont('Helvetica','B',18);
        $fpdf->Cell(40,0, utf8_decode(Str::upper($certificado->carrera->titulo)));
        $fpdf->SetXY(7.2,23.8);
        $fpdf->SetFont('Helvetica','B',18);
        $fpdf->Cell(40,0, utf8_decode(Str::upper($certificado->estudiante->nombre_completo)));
        $fpdf->SetXY(3.5,18);
        $fpdf->SetFont('Arial','',12);
        foreach ($certificado->carrera->modulos as $index => $modulo) {
            $fpdf->SetX(3);
            $fpdf->Cell(40,1,utf8_decode($index+1 .'.- '.Str::title($modulo->titulo)));
            $fpdf->Ln(0.5);
        }
        foreach ($certificado->planificacionCarrera->planificacionModulos as $index => $modulo) {
            if ($index == 0) {
                $fpdf->SetFont('Arial','',12);
                $fpdf->SetXY(7.9,26.5);
                $fpdf->Cell(40,1,Carbon::parse($modulo->fecha_inicio)->format('d'));
                $fpdf->SetXY(9.5,26.5);
                $fpdf->Cell(40,1,utf8_decode(Str::title(Carbon::parse($modulo->fecha_inicio)->translatedFormat('F'))));
                $fpdf->SetXY(11.5,26.5);
                $fpdf->Cell(40,1,Carbon::parse($modulo->fecha_inicio)->format('Y'));
            }elseif ($index == count($certificado->planificacionCarrera->planificacionModulos) - 1) {
                $fpdf->SetFont('Arial','',12);
                $fpdf->SetXY(13.5,26.5);
                $fpdf->Cell(40,1,Carbon::parse($modulo->fecha_fin)->format('d'));
                $fpdf->SetXY(14.7,26.5);
                $fpdf->Cell(40,1,utf8_decode(Str::title(Carbon::parse($modulo->fecha_fin)->translatedFormat('F'))));
                $fpdf->SetXY(16.8,26.5);
                $fpdf->Cell(40,1,Carbon::parse($modulo->fecha_fin)->format('Y'));
            }
        }
        $fpdf->SetFont('Arial','',12);
        $fpdf->SetXY(16.6,24.4);
        $fpdf->Cell(40,1,$certificado->planificacionCarrera->carrera->cargaHoraria);
        $fpdf->SetXY(13.5,28.5);
        $fpdf->SetFont('Arial','',12);
        $fpdf->Cell(40,0, utf8_decode('La Paz '.Carbon::now()->translatedFormat('d F Y')));
        $fpdf->SetXY(7.5,31);
        $fpdf->SetFont('Arial','',9);
        $fpdf->Cell(60,0,'..........................................');
        $fpdf->SetXY(8.5,31.5);
        $fpdf->Cell(60,0,'DOCENTE');
        $fpdf->SetXY(7.8,32);
        $nombre_docente = $certificado->planificacionCarrera->docente->nombre_completo;
        $fpdf->Cell(60,0,utf8_decode('ING. '. $nombre_docente));
        if ( strcmp(Str::upper($nombre_docente),Str::upper($configuracion->director_academico)) > 0 ) {
            $fpdf->SetXY(13,31);
            $fpdf->Cell(60,0,'................................................');
            $fpdf->SetXY(13.3,31.5);
            $fpdf->Cell(60,0, utf8_decode('DIRECTOR ACADÉMICO'));
            $fpdf->SetXY(13,32);
            $fpdf->Cell(60,0,utf8_decode('Ing. ' . Str::upper($configuracion->director_academico)));
        }
        $fpdf->Output('','reporte','true');
        exit;
    }

    public function cancelarSolicitud(Request $request){
        $estado = CertificadoCarrera::where('id', $request->id)->delete();
        return response()->json($estado);
    }

    public function cambiarEstadoPago(Request $request){
        $pago = RegistroEconomico::where('id',$request->idPago)->first();
        $estado = CertificadoCarrera::where('id', $request->idCertificado)->first();
        $estado->total_pagado = ($estado->total_pagado - $pago->monto);
        $estado->saldo = ($estado->saldo + $pago->monto);
        $estado->save();
        return response()->json($estado);
    }
}
