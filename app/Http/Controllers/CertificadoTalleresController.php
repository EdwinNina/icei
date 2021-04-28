<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use NumeroALetras;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CertificadoTaller;

class CertificadoTalleresController extends Controller
{
    public function solicitados(){
        $solicitados = CertificadoTaller::where([
            ['solicitado','=','1'],
            ['entregado','=','0'],
        ])->paginate();
        return view('admin.certificadosTalleres.solicitados', compact('solicitados'));
    }

    public function entregados(){
        return view('admin.certificadosTalleres.entregados');
    }

    public function generarCertificado(CertificadoTaller $certificado)
    {
        setlocale(LC_TIME, 'es_ES');
        Carbon::setLocale('es');
        $fpdf = new Fpdf('P','cm','Letter');
        $fpdf->AddPage();
        $fpdf->SetXY(7.5,8.5);
        $fpdf->SetFont('Arial','B',16);
        $fpdf->Cell(40,0, utf8_decode(Str::upper($certificado->estudiante->nombre_completo)));
        $fpdf->SetXY(7,11.5);
        $fpdf->SetFont('Arial','',13);
        $fpdf->MultiCell(10,1,utf8_decode(Str::upper($certificado->planificacionTaller->taller->nombre)),0,'C');
        $fpdf->SetXY(12.7,15.8);
        $fpdf->SetFont('Arial','',13);
        $fpdf->Cell(40,0, utf8_decode($certificado->planificacionTaller->carga_horaria));
        $fpdf->SetXY(10.2,18.3);
        $fpdf->Cell(40,0, date('d'));
        $fpdf->SetXY(13,18.3);
        $fpdf->Cell(40,0, Str::title(Carbon::now()->translatedFormat('F')));
        $fpdf->SetXY(17.5,18.3);
        $fpdf->Cell(40,0, date('Y'));
        $fpdf->Output('','reporte','true');
        exit;
    }

    public function activarImpresion(Request $request){
        $impresion = CertificadoTaller::where('id', $request->id)->update([
            'impresion' => true,
            'fecha_impresion' => date('Y-m-d')
        ]);
        return response()->json($impresion);
    }

    public function desactivarImpresion(Request $request){
        $impresion = CertificadoTaller::where('id', $request->id)->update([
            'impresion' => false,
            'fecha_impresion' => null
        ]);
        return response()->json($impresion);
    }

    public function entregaCertificado(Request $request){
        if(!$request->ajax()){ return; }

        $estado = CertificadoTaller::where('id', $request->certificado_id)->update([
            'entregado' => true,
            'fecha_entregado' => $request->fecha_entregado,
            'entregado_a' =>  $request->entregado_a,
            'estado' => true
        ]);

        return response()->json($estado);
    }
}
