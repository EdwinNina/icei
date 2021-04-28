<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Inscripcion;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstudianteController extends Controller
{

    public function modulosInscritos(Estudiante $estudiante){
        $detalles = DB::table('inscripcions as in')
            ->join('modulos as mo', 'mo.id', '=', 'in.modulo_id')
            ->join('carreras as ca', 'ca.id', '=', 'mo.carrera_id')
            ->where('in.estudiante_id',$estudiante->id)
            ->select('in.created_at as fecha','mo.id','mo.titulo','ca.titulo as carrera')
            ->get();
        $this->consulta = $detalles;
        return view('admin.estudiantes.modulos-inscritos', compact('detalles','estudiante'));
    }

    public function generarPdfModulosInscritos(Estudiante $estudiante){
        $fpdf = new Fpdf('P','mm','Letter');
        $fpdf->AddPage();
        $fpdf->SetAutoPageBreak(true,25);
        $fpdf->Image('images/logo.png',10,5,35);
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
        $fpdf->Cell(0,10,'REPORTE ESTUDIANTIL',0,0,'C');
        $fpdf->Ln(10);
        $fpdf->SetFont('Arial','B',10);
        $fpdf->Cell(10,10,'Datos del Estudiante',0,0,);
        $fpdf->Ln(13);
        $fpdf->SetFont('Arial','',10);
        $fpdf->Cell(20,7,'Nombre:',0,0);
        $nombre = $estudiante->nombre.' '.$estudiante->paterno.' '.$estudiante->materno;
        $fpdf->Cell(80,7,$nombre,1,0);
        $fpdf->Cell(30);
        $fpdf->Cell(20,7,'No. C.I.:',0,0);
        $fpdf->Cell(40,7,$estudiante->carnet .' ' . $estudiante->expedido,1,0);
        $fpdf->Ln(15);
        $fpdf->Cell(20,7,'Email:',0,0);
        $fpdf->Cell(80,7,$estudiante->email,1,0);
        $fpdf->Cell(30);
        $fpdf->Cell(20,7,utf8_decode('Código'),0,0);
        $fpdf->Cell(40,7,$estudiante->codigo,1,0);
        $fpdf->Ln(12);
        $fpdf->SetFont('Arial','B',9);
        $fpdf->Cell(10,10,utf8_decode('Cursos o Módulos tomados por el estudiante'),0,0);
        $fpdf->Ln(12);
        $fpdf->SetFillColor(232,232,232);
        $fpdf->Cell(10,8,'ID',1,0,'C',true);
        $fpdf->Cell(40,8,'CARRERA',1,0,'C',true);
        $fpdf->Cell(90,8,'MODULO',1,0,'C',true);
        $fpdf->Cell(30,8,'FECHA',1,0,'C',true);
        $fpdf->Ln();
        $detalles = DB::table('inscripcions as in')
            ->join('modulos as mo', 'mo.id', '=', 'in.modulo_id')
            ->join('carreras as ca', 'ca.id', '=', 'mo.carrera_id')
            ->where('in.estudiante_id',$estudiante->id)
            ->select('in.created_at as fecha','mo.id','mo.titulo','ca.titulo as carrera')
            ->get();
        $fpdf->SetFont('Arial','',6);
        foreach ($detalles as $key => $detalle) {
            $fpdf->Cell(10,8,$key + 1,1,0,'C');
            $fpdf->Cell(40,8,utf8_decode($detalle->carrera),1,0,'C');
            $fpdf->Cell(90,8,utf8_decode($detalle->titulo),1,0,'C');
            $fpdf->Cell(30,8,$detalle->fecha,1,0,'C');
            $fpdf->Ln();
        }

        $fpdf->Output();
        exit;
    }
}
