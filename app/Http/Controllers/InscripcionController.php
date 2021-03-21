<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Models\Inscripcion;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;

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
        $nombre = $inscripcion->estudiante->nombre.' '.$inscripcion->estudiante->paterno.' '.$inscripcion->estudiante->materno;
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
        $nombre = $inscripcion->estudiante->familiares->nombre.' '.$inscripcion->estudiante->familiares->paterno.' '.$inscripcion->estudiante->familiares->materno;
        $fpdf->Cell(80,7,utf8_decode($nombre),1,0);
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
        $horario = $inscripcion->planificacionCarrera->horario->dias .'/'. $inscripcion->planificacionCarrera->horario->hora_inicio .'-'. $inscripcion->planificacionCarrera->horario->hora_fin;
        $fpdf->Cell(80,7,$horario,1,0);
        $fpdf->Ln(10);
        $fpdf->SetFont('Arial','',8);
        $fpdf->Cell(20,7,'Modulo:',0,0);
        $fpdf->Cell(0,7,utf8_decode($inscripcion->modulo->titulo),1,0);
        $fpdf->Ln(10);
        $fpdf->SetFont('Arial','B',10);
        $fpdf->Cell(10,10,'5. LUGAR DE ESTUDIO U OCUPACION',0,0);
        $fpdf->Ln(10);
        $fpdf->SetFont('Arial','',10);
        $fpdf->Cell(20,7,'Actual:',0,0);
        $fpdf->Cell(0,7,utf8_decode($inscripcion->actividad),1,0);
        $fpdf->Ln(10);
        $fpdf->Cell(20,7,'Tipo de Plan de Pago:',0,0);
        $fpdf->Cell(20);
        $fpdf->Cell(80,7,$inscripcion->planPago->nombre,1,0);
        $fpdf->Ln(20);
        $fpdf->SetLineWidth(0.5);
        $fpdf->Line(30,240,60,240);
        $fpdf->Ln(45);
        $fpdf->Cell(20);
        $fpdf->Cell(30,7,'Firma del alumno',0,0);
        $fpdf->Output('','reporte','true');
        exit;
    }
}
