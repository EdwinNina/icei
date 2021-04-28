@extends('adminlte::page')

@section('title', 'Estado de Pago')

@section('content_header')
@stop

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 mb-3">Detalles de los pagos realizados</h2>
        <div class="shadow-sm overflow-hidden border-b rounded border-gray-200 sm:rounded-lg my-4">
            <div class="table-responsive">
                <table class="table-tail">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="table-tail-th">Nro</th>
                            <th class="table-tail-th">Nombre del Estudiante</th>
                            <th class="table-tail-th text-center w-20">Inscripción (Bs)</th>
                            <th class="table-tail-th text-center w-20">Examen 2T (Bs)</th>
                            <th class="table-tail-th text-center w-20">Certificado (Bs)</th>
                            <th class="table-tail-thr text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($inscritos as $index => $item)
                        <tr>
                            <td class="table-tail-td">
                                <div class="text-sm text-gray-900">{{$index + 1}}</div>
                            </td>
                            <td class="table-tail-td">
                                <div class="text-sm text-gray-900">{{Str::title($item->estudiante->nombre_completo)}}</div>
                            </td>
                            <td class="table-tail-td">
                                <div class="text-sm font-bold text-gray-900">Total: {{$item->total_pagado}}</div>
                                <div class="text-sm font-bold flex justify-evenly {{$item->saldo > 0 ? 'text-red-600' : 'text-green-600'}}">
                                    Saldo: {{number_format($item->saldo, 2)}}
{{--                                     Saldo: {{$item->saldo}}
                                    @foreach ($item->pagosInscripcion as $index => $pago)
                                        @if ($index === count($item->pagosInscripcion) - 1)
                                            <svg class=" ml-2 h-5 w-5 {{$pago->estado === '2' ? 'text-red-600' : 'text-green-600'}}""
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        @endif
                                    @endforeach --}}
                                </div>
                            </td>
                            <td class="table-tail-td">
                                <div class="text-sm font-bold text-gray-900">Total: {{$item->total_monto_2t == null ? number_format(0,2) : number_format($item->total_monto_2t, 2)}}</div>
                                <div class="text-sm font-bold flex justify-evenly {{$item->saldo_examen > 0 ? 'text-red-600' : 'text-green-600'}}">
                                    Saldo: {{ $item->saldo_examen == null ? number_format(0,2) : number_format($item->saldo_examen, 2)}}
                                </div>
                            </td>
                            <td class="table-tail-td">
                                <div class="text-sm font-bold text-gray-900">Total: {{$item->total_monto_certificado == null ? number_format(0,2) : number_format($item->total_monto_certificado, 2)}}</div>
                                <div class="text-sm font-bold flex justify-evenly {{$item->saldo_certificado > 0 ? 'text-red-600' : 'text-green-600'}}">
                                    Saldo: {{$item->saldo_certificado  == null ? number_format(0,2) : number_format($item->saldo_certificado, 2)}}
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.pagos.pagosEstudiante', $item->id) }}"
                                class="btn bg-purple-500 hover:bg-purple-600 focus:bg-purple-600 text-white">Ver Pagos</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="my-4">
            {{$inscritos->links()}}
        </div>
    </div>
    <x-back-button href="{{route('admin.busquedaPorPlanificacion.index')}}" class="float-right">Volver</x-back-button>
@stop

@section('css')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
@stop
@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
@stop
