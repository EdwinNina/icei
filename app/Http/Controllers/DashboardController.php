<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Carbon\Carbon;
use App\Models\Estudiante;
use App\Models\Certificado;
use App\Models\CertificadoCarrera;
use App\Models\CertificadoTaller;
use Illuminate\Http\Request;
use App\Models\RegistroEconomico;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $cantidadEstudiantes = Estudiante::count();
        $cantidadCarreras = Carrera::count();
        $cantidadIngresoHoy = RegistroEconomico::where('fecha_pago',date('Y-m-d'))->where('estado', '!=', 0)->sum('monto');

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

    public function ingresosMes(Request $request)
    {
        $ingresosMes = '';
        if ($request->fecha_inicio && $request->fecha_fin) {
            $ingresosMes = RegistroEconomico::where('estado', '!=', 0)
                ->whereBetween('fecha_pago', [$request->fecha_inicio, $request->fecha_fin])
                ->select(DB::raw("fecha_pago as mes, SUM(monto) as total"))
                ->groupBy('fecha_pago')
                ->orderBy('fecha_pago','asc')
                ->get();
        }else{
            $ingresosMes = RegistroEconomico::where('estado', '!=', 0)
            ->whereYear('created_at', now('Y'))
            ->where('fecha_pago', '>=', Carbon::now()->startOfMonth())
            ->where('fecha_pago', '<=', Carbon::now()->endOfMonth())
            ->select(DB::raw("DATE_FORMAT(fecha_pago,'%d %W') as mes, SUM(monto) as total"))
            ->groupBy('fecha_pago')
            ->orderBy('fecha_pago','asc')
            ->get();
        }
        return response()->json($ingresosMes, 200);
    }

    public function ingresosAnio()
    {
        $ingresosPorAnio = DB::table('registro_economicos')
            ->where('estado','!=','0')
            ->whereYear('created_at', now('Y'))
            ->select(DB::raw("DATE_FORMAT(created_at, '%M') as mes, DATE_FORMAT(created_at, '%m') as numeroMes, sum(monto) as total"))
            ->groupBy('mes','numeroMes')
            ->orderBy('numeroMes','asc')
            ->get();

        return response()->json($ingresosPorAnio, 200);
    }
}
