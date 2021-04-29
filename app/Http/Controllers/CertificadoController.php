<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use NumeroALetras;
use App\Models\Certificado;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Configuracion;

class CertificadoController extends Controller
{

    public function solicitados() {
        $solicitados = Certificado::join('estudiantes as es','certificados.estudiante_id','=','es.id')
        ->select('certificados.*')
        ->where([
            ['solicitado','=','1'],
        ])
        ->orderBy('es.paterno','asc')
        ->paginate();
        return view('admin.certificados.solicitados', compact('solicitados'));
    }

    public function entregados() {
        return view('admin.certificados.entregados');
    }

    public function solicitarFotos(Request $request){
        $certificado = Certificado::where('inscripcion_id', $request->id)->update([
            'fotos' => true
        ]);
        return response()->json($certificado);
    }

    public function cancelarSolicitarFotos(Request $request){
        $certificado = Certificado::where('inscripcion_id', $request->id)->update([
            'fotos' => false
        ]);
        return response()->json($certificado);
    }

    public function generarCertificado(Certificado $certificado)
    {
        $configuracion = Configuracion::select('director_academico')->first();
        setlocale(LC_TIME, 'es_ES');
        Carbon::setLocale('es');
        $fpdf = new Fpdf('P','cm','Letter');
        $fpdf->AddPage();
        $fpdf->SetXY(2,7);
        $fpdf->SetFont('Arial','',7);
        $fpdf->Cell(40,0, utf8_decode($certificado->codigo));
        $fpdf->SetXY(4.5,13);
        $fpdf->SetFont('Arial','B',15);
        $fpdf->Cell(40,0, utf8_decode(Str::upper($certificado->estudiante->nombre_completo)));
        $fpdf->SetXY(7.2,15);
        $fpdf->SetFont('Arial','B',11);
        $fpdf->MultiCell(10,0.7,utf8_decode(Str::upper($certificado->inscripcion->modulo->titulo)),0,'C');
        $fpdf->SetXY(11,17.5);
        $fpdf->Cell(40,0, utf8_decode($certificado->nota->nota_final . "% (" . Str::title(NumeroALetras::convertir($certificado->nota->nota_final)) . 'por ciento)'));
        $fpdf->SetXY(8,19.7);
        $fpdf->SetFont('Arial','B',11);
        $fpdf->Cell(40,0, utf8_decode('Del ' . Str::title(Carbon::parse($certificado->planificacionModulo->fecha_inicio)->translatedFormat('d F Y')) . ' al ' . Str::title(Carbon::parse($certificado->planificacionModulo->fecha_fin)->translatedFormat('d F Y'))));
        $fpdf->SetXY(6.7,21.8);
        $fpdf->Cell(40,0, utf8_decode($certificado->inscripcion->modulo->cargaHoraria));
        $fpdf->SetXY(12.5,21.8);
        $fpdf->Cell(40,0, utf8_decode(Carbon::now()->translatedFormat('d F Y')));
        $fpdf->SetXY(3,24);
        $fpdf->SetFont('Arial','',9);
        $fpdf->Cell(60,0,'.....................................................');
        $fpdf->SetXY(4.6,24.5);
        $fpdf->Cell(60,0,'DOCENTE');
        $fpdf->SetXY(3.1,25);
        $nombre_docente = $certificado->planificacionModulo->planificacionCarrera->docente->nombre_completo;
        $fpdf->Cell(60,0,utf8_decode('ING. '. Str::upper($nombre_docente)));
/*         if ( strcmp(Str::upper($nombre_docente),Str::upper($configuracion->director_academico)) > 0 ) {
            $fpdf->SetXY(10,24);
            $fpdf->Cell(60,0,'................................................');
            $fpdf->SetXY(10.3,24.5);
            $fpdf->Cell(60,0, utf8_decode('DIRECTOR ACADÉMICO'));
            $fpdf->SetXY(10,25);
            $fpdf->Cell(60,0,utf8_decode('ING. ' . Str::upper($configuracion->director_academico)));
        } */
        $fpdf->Output('','reporte','true');
        exit;
    }

    public function activarImpresion(Request $request){
        $impresion = Certificado::where('id', $request->id)->update([
            'impresion' => true,
            'fecha_impresion' => date('Y-m-d')
        ]);
        return response()->json($impresion);
    }

    public function desactivarImpresion(Request $request){
        $impresion = Certificado::where('id', $request->id)->update([
            'impresion' => false,
            'fecha_impresion' => null
        ]);
        return response()->json($impresion);
    }

    public function entregaCertificado(Request $request){
        if(!$request->ajax()){ return; }

        $estado = Certificado::where('id', $request->certificado_id)->update([
            'entregado' => true,
            'fecha_entregado' => $request->fecha_entregado,
            'entregado_a' =>  $request->entregado_a,
            'estado' => true
        ]);

        return response()->json($estado);
    }
}
