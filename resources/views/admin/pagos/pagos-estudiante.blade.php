@extends('adminlte::page')

@section('title', 'Estado de Pago')

@section('content_header')
@stop

@section('content')
    <div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div>
                    <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 mb-3">Datos el estudiante</h2>
                    <div>
                        <p><span class="font-bold">Código:</span> {{$inscripcion->estudiante->codigo}}</p>
                        <p><span class="font-bold">Nombre:</span> {{$inscripcion->estudiante->nombre_completo}}</p>
                        <p><span class="font-bold">Cédula de identidad:</span> {{$inscripcion->estudiante->carnet}} {{$inscripcion->estudiante->expedido}}</p>
                        <p><span class="font-bold">Celular:</span> {{$inscripcion->estudiante->celular}}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 mb-3">Detalle Curso/Módulo tomado</h2>
                <div>
                    <p><span class="font-bold">Carrera:</span> {{$inscripcion->planificacionCarrera->carrera->titulo}}</p>
                    <p><span class="font-bold">Módulo:</span> {{$inscripcion->modulo->titulo_completo}}</p>
                    <p><span class="font-bold">Horario:</span> {{$inscripcion->planificacionCarrera->horario->horario_completo}}</p>
                    <p><span class="font-bold">Modalidad:</span> {{$inscripcion->planificacionCarrera->modalidad->nombre}}</p>
                </div>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-4 p-6">
            <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 mb-3">Detalles de los pagos realizados</h2>
            <div class="shadow-sm overflow-hidden border-b rounded border-gray-200 sm:rounded-lg my-4">
                <div class="table-responsive">
                    <table class="table-tail">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="table-tail-th text-center">Nro.</th>
                                <th class="table-tail-th text-center">Razón</th>
                                <th class="table-tail-th text-center">Tipo de Pago</th>
                                <th class="table-tail-th text-center">Concepto</th>
                                <th class="table-tail-th text-center">Monto (Bs)</th>
                                <th class="table-tail-th text-center">Fecha de Pago</th>
                            </tr>
                        </thead>
                        @php  $montos = array(); $suma_montos_total = ''; @endphp
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($inscripcion->pagosInscripcion as $index => $pago)
                            <tr class="text-center">
                                <td class="table-tail-td"><div class="text-sm text-gray-900">{{$index + 1}}</div></td>
                                <td class="table-tail-td">
                                    <div class="text-sm text-gray-900">{{ Str::title($pago->tipoDeRazon->nombre)}}</div>
                                </td>
                                <td class="table-tail-td">
                                    <div class="text-sm text-gray-900">{{ Str::title($pago->tipoDePago->nombre)}}</div>
                                </td>
                                <td class="table-tail-td"><div class="text-sm text-gray-900">{{ Str::ucfirst($pago->concepto)}}</div></td>
                                <td class="table-tail-td"><div class="text-sm text-gray-900">{{$pago->monto}}</div></td>
                                <td class="table-tail-td">
                                    <div class="text-sm text-gray-900">{{$pago->fecha_pago->format('d-m-Y')}}</div>
                                </td>
                            </tr>
                            @php
                                $montos[$index] = $pago->monto;
                                $suma_montos_total = array_sum($montos);
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="table-tail-td text-right">Total monto (Bs)</td>
                            <td class="table-tail-td text-center font-bold" id="pagoTotalAnterior">{{number_format($suma_montos_total, 2)}}</td>
                        </tr>
                    </tfoot>
                </table>
                <div class="my-3">
                    <span class="font-bold uppercase">Cantidad de Dinero invertido en el módulo:</span>  {{utf8_decode(NumeroALetras::convertir($suma_montos_total, 'Bolivianos'))}}
                </div>
            </div>
        </div>
        @foreach ($inscripcion->planificacionCarrera->planificacionModulos as $planificacion)
            @if ($planificacion->modulo_id == $inscripcion->modulo_id)
                <x-back-button href="{{route('admin.pagos.inscritos.planificacion', $planificacion->id)}}" class="float-right">Volver</x-back-button>
            @endif
        @endforeach
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
@stop
@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
@stop
