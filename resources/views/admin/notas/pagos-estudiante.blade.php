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
                                <th class="table-tail-th text-center">Tipo de Pago</th>
                                <th class="table-tail-th text-center">Concepto</th>
                                <th class="table-tail-th text-center">Monto (Bs)</th>
                                <th class="table-tail-th text-center">Fecha de Deposito</th>
                                <th class="table-tail-th text-center">Estado</th>
                                <th class="table-tail-th text-center">Total (Bs)</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($inscripcion->pagoInscripcion as $index => $pago)
                            <tr class="text-center">
                                <td class="table-tail-td">
                                    <div class="text-sm text-gray-900">{{$index + 1}}</div>
                                </td>
                                <td class="table-tail-td">
                                    <div class="text-sm text-gray-900">{{$pago->tipoDePago->nombre}}</div>
                                </td>
                                <td class="table-tail-td">
                                    <div class="text-sm text-gray-900">{{ Str::ucfirst($pago->concepto)}}</div>
                                </td>
                                <td class="table-tail-td">
                                    <div class="text-sm text-gray-900">{{$pago->monto}}</div>
                                </td>
                                <td class="table-tail-td">
                                    <div class="text-sm text-gray-900">{{$pago->fecha_pago}}</div>
                                </td>
                                <td class="table-tail-td">
                                    <span class="font-bold {{$pago->estado === '2' ? 'text-red-500' : 'text-green-500'}}">
                                        {{$pago->estado === '2' ? 'Pendiente' : 'Cancelado'}}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" class="table-tail-td text-right">Total Cancelado</td>
                            <td class="table-tail-td text-center font-bold" id="pagoTotalAnterior">{{$inscripcion->total_pagado}}</td>
                        </tr>
                        <tr>
                            <td colspan="6" class="table-tail-td text-right">Saldo Actual</td>
                            <td colspan="6" class="table-tail-td text-center">
                                <span class="font-bold {{$inscripcion->saldo > 0 ? 'text-red-500' : 'text-green-500'}}">{{$inscripcion->saldo}}</span>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <x-back-button href="{{route('admin.pagos.inscritos.planificacion', $inscripcion->planificacion_carrera_id)}}" class="float-right">Volver</x-back-button>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
@stop
@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
@stop
