<?php

namespace App\Http\Controllers;

use App\Models\CertificadoTaller;
use Carbon\Carbon;
use NumeroALetras;
use App\Models\Estudiante;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Configuracion;
use App\Models\InscripcionTaller;
use App\Models\RegistroEconomico;
use Illuminate\Support\Facades\DB;

class InscripcionTalleresController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.inscripcionesTalleres.create');
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
            $inscripcion = InscripcionTaller::create([
                'estudiante_id' => $request->estudiante_id,
                'planificacion_taller_id' => $request->planificacion_taller_id,
                'total_costo' => $request->total_modulo,
                'total_pagado' => $request->total_pagado,
                'saldo' => $request->saldo
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
                $inscripcion->pagosInscripcionTaller()->save($pagos);
            }
            DB::commit();
            return redirect()->route('admin.inscripcionesTalleres.edit', $inscripcion->id)->with('message','good');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('admin.inscripcionesTalleres.index')->with('message','bad');
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(InscripcionTaller $inscripcion)
    {
        $estudiante = Estudiante::where('id', $inscripcion->estudiante_id)->first();
        return view('admin.inscripcionesTalleres.edit',compact('inscripcion','estudiante'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InscripcionTaller $inscripcion)
    {
        try {
            DB::beginTransaction();
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
                $inscripcion->pagosInscripcionTaller()->save($pagos);
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
        $fpdf->MultiCell(120,5,utf8_decode(Str::upper($pago->concepto) . ' PARA EL TALLER ' . Str::upper($pago->economicable->planificacionTaller->taller->nombre)),0,'C');

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


    public function habilitarCertificado(Request $request){
        try {
            DB::beginTransaction();
            InscripcionTaller::where('id', $request->id)->update([
                'certificado_habilitado' => true
            ]);

            $inscripcion = InscripcionTaller::where('id', $request->id)->first();
            $certificado = new CertificadoTaller();
            $certificado->solicitado = 1;
            $certificado->fecha_solicitado = Carbon::now();
            $certificado->estudiante_id = $inscripcion->estudiante->id;
            $certificado->inscripcion_taller_id = $request->id;
            $certificado->planificacion_taller_id = $inscripcion->planificacionTaller->id;
            $certificado->save();
            DB::commit();
            return response()->json('good');
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json('bad');
        }
    }
    public function deshabilitarCertificado(Request $request){
        try {
            DB::beginTransaction();
            InscripcionTaller::where('id', $request->id)->update([
                'certificado_habilitado' => false
            ]);

            CertificadoTaller::where('inscripcion_taller_id', $request->id)->update([
                'solicitado' => 0,
                'fecha_solicitado' => null
            ]);
            DB::commit();
            return response()->json('good');
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json('bad');
        }
    }
}
