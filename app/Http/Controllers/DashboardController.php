<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Carrera;
use App\Models\Docente;
use App\Models\Estudiante;
use App\Models\Certificado;
use App\Models\CertificadoCarrera;
use App\Models\CertificadoTaller;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use App\Models\RegistroEconomico;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $cantidadEstudiantes = Estudiante::count();
        $cantidadCarreras = Inscripcion::count();
        $cantidadIngresoHoy = RegistroEconomico::where('fecha_pago',date('Y-m-d'))->sum('monto');

        return view('dashboard', [
            'cantidadEstudiantes' => $cantidadEstudiantes,
            'cantidadCarreras' => $cantidadCarreras,
            'cantidadIngresoHoy' => $cantidadIngresoHoy,
        ]);
    }

    public function estadoCertificados(){
        $inicioMes = Carbon::now()->startOfMonth();
        $inicioFormateado = $inicioMes->format('d/m/Y');
        $certificadoModularesSolicitados = Certificado::where('solicitado', 1)->where('fecha_solicitado','>=',$inicioFormateado)->count();
        $certificadoMolularesEntregados = Certificado::where([
            ['entregado', 1],
            ['impresion', 1],
            ['fotos', 1],
        ])->where('fecha_entregado','>=',$inicioFormateado)->count();

        $certificadoTalleresSolicitados = CertificadoTaller::where('solicitado', 1)->where('fecha_solicitado','>=',$inicioFormateado)->count();
        $certificadoTalleresEntregados = CertificadoTaller::where([
            ['entregado', 1],
            ['impresion', 1],
        ])->where('fecha_entregado','>=',$inicioFormateado)->count();

        $certificadoCarrerasSolicitados = CertificadoCarrera::where('solicitado', 1)->where('fecha_solicitado','>=',$inicioFormateado)->count();
        $certificadoCarrerasEntregados = CertificadoCarrera::where([
            ['entregado', 1],
            ['impresion', 1],
            ['fotos', 1],
        ])->where('fecha_entregado','>=',$inicioFormateado)->count();

        return [
            'cantidadSolicitadosModulares' => $certificadoModularesSolicitados,
            'cantidadSolicitadosTalleres' => $certificadoTalleresSolicitados,
            'cantidadSolicitadosCarreras' => $certificadoCarrerasSolicitados,
            'cantidadEntregadosModulares' => $certificadoMolularesEntregados,
            'cantidadEntregadosTalleres' => $certificadoTalleresEntregados,
            'cantidadEntregadosCarreras' => $certificadoCarrerasEntregados,
        ];
    }
}
