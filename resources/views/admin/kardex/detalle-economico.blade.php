@extends('adminlte::page')

@section('title', 'Historial Académico')

@section('content_header')
@stop

@section('content')
<div class="w-full pb-4">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <h1 class="text-gray-500 uppercase text-2xl mt-5 text-center">Mi historial Económico</h1>
        <div class="rounded p-6">
            <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 mb-3">Detalles económicos de relacionados a la inscripción</h2>
            <div class="table-responsive">
                <table class="table-tail">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="table-tail-th w-32">Factura</th>
                            <th scope="col" class="text-xs font-medium text-gray-500 uppercase w-24">Tipo de Pago</th>
                            <th scope="col" class="table-tail-th">Razón</th>
                            <th scope="col" class="text-xs font-medium text-gray-500 uppercase w-40">Módulo</th>
                            <th scope="col" class="table-tail-th">Concepto</th>
                            <th scope="col" class="table-tail-th">Monto (Bs)</th>
                            <th scope="col" class="table-tail-th">Fecha de Deposito</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 relative">
                        @foreach ($inscripciones as $inscripcion)
                            @foreach ($inscripcion->pagosInscripcion as $index => $pago)
                                @if ($pago->estado != 0)
                                    <tr>
                                        <td class="table-tail-td w-32">
                                            <div class="text-sm text-gray-900">{{ $pago->numeroFactura }}</div>
                                        </td>
                                        <td class="w-24">
                                            <div class="text-sm text-gray-900">{{ Str::title($pago->tipoDePago->nombre)}}</div>
                                        </td>
                                        <td class="table-tail-td">
                                            <div class="text-sm text-gray-900">{{ Str::title($pago->tipoDeRazon->nombre)}}</div>
                                        </td>
                                        <td class="w-40">
                                            <div class="text-sm text-gray-900" data-toggle="tooltip" data-placement="top" title="{{$inscripcion->modulo->titulo_completo}}">
                                                {{ Str::length($inscripcion->modulo->titulo_completo) > 30 ? Str::substr($inscripcion->modulo->titulo_completo, 0, 30).'...' : $inscripcion->modulo->titulo_completo }}
                                            </div>
                                        </td>
                                        <td class="table-tail-td"><div class="text-sm text-gray-900">{{ Str::ucfirst($pago->concepto)}}</div></td>
                                        <td class="table-tail-td"><div class="text-sm text-gray-900">{{$pago->monto}}</div></td>
                                        <td class="table-tail-td">
                                            <div class="text-sm text-gray-900">{{$pago->fecha_pago->format('d-m-Y')}}</div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if ($servicios->count())
        <div class="bg-white overflow-hidden shadow-sm my-4 sm:rounded-lg">
            <div class="rounded p-6">
                <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 mb-3">Detalles económicos de relacionados a Pago de Servicios</h2>
                <div class="table-responsive">
                    <table class="table-tail">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="table-tail-th w-32">Factura</th>
                                <th scope="col" class="text-xs font-medium text-gray-500 uppercase w-24">Tipo de Pago</th>
                                <th scope="col" class="table-tail-th">Razón</th>
                                <th scope="col" class="text-xs font-medium text-gray-500 uppercase w-40">Servicio</th>
                                <th scope="col" class="table-tail-th">Concepto</th>
                                <th scope="col" class="table-tail-th">Monto (Bs)</th>
                                <th scope="col" class="table-tail-th">Fecha de Deposito</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 relative">
                            @foreach ($servicios as $servicio)
                                @foreach ($servicio->pagosServicios as $index => $pago)
                                    @if ($pago->estado != 0)
                                        <tr>
                                            <td class="table-tail-td w-32">
                                                <div class="text-sm text-gray-900">{{ $pago->numeroFactura }}</div>
                                            </td>
                                            <td class="w-24">
                                                <div class="text-sm text-gray-900">{{ Str::title($pago->tipoDePago->nombre)}}</div>
                                            </td>
                                            <td class="table-tail-td">
                                                <div class="text-sm text-gray-900">{{ Str::title($pago->tipoDeRazon->nombre)}}</div>
                                            </td>
                                            <td class="w-40">
                                                <div class="text-sm text-gray-900" data-toggle="tooltip" data-placement="top" title="{{$inscripcion->modulo->titulo_completo}}">
                                                    {{ $servicio->categoria->nombre}}
                                                </div>
                                            </td>
                                            <td class="table-tail-td"><div class="text-sm text-gray-900">{{ Str::ucfirst($pago->concepto)}}</div></td>
                                            <td class="table-tail-td"><div class="text-sm text-gray-900">{{$pago->monto}}</div></td>
                                            <td class="table-tail-td">
                                                <div class="text-sm text-gray-900">{{$pago->fecha_pago->format('d-m-Y')}}</div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
    @if ($talleres->count())
        <div class="bg-white overflow-hidden shadow-sm my-4 sm:rounded-lg">
            <div class="rounded p-6">
                <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 mb-3">Detalles económicos de relacionados a Pago de Servicios</h2>
                <div class="table-responsive">
                    <table class="table-tail">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="table-tail-th w-32">Factura</th>
                                <th scope="col" class="text-xs font-medium text-gray-500 uppercase w-24">Tipo de Pago</th>
                                <th scope="col" class="table-tail-th">Razón</th>
                                <th scope="col" class="text-xs font-medium text-gray-500 uppercase w-40">Taller</th>
                                <th scope="col" class="table-tail-th">Concepto</th>
                                <th scope="col" class="table-tail-th">Monto (Bs)</th>
                                <th scope="col" class="table-tail-th">Fecha de Deposito</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 relative">
                            @foreach ($talleres as $taller)
                                @foreach ($taller->pagosInscripcionTaller as $index => $pago)
                                    @if ($pago->estado != 0)
                                        <tr>
                                            <td class="table-tail-td w-32">
                                                <div class="text-sm text-gray-900">{{ $pago->numeroFactura }}</div>
                                            </td>
                                            <td class="w-24">
                                                <div class="text-sm text-gray-900">{{ Str::title($pago->tipoDePago->nombre)}}</div>
                                            </td>
                                            <td class="table-tail-td">
                                                <div class="text-sm text-gray-900">{{ Str::title($pago->tipoDeRazon->nombre)}}</div>
                                            </td>
                                            <td class="w-40">
                                                <div class="text-sm text-gray-900" data-toggle="tooltip" data-placement="top" title="{{$taller->planificacionTaller->taller->nombre}}">
                                                    {{ $taller->planificacionTaller->taller->nombre}}
                                                </div>
                                            </td>
                                            <td class="table-tail-td"><div class="text-sm text-gray-900">{{ Str::ucfirst($pago->concepto)}}</div></td>
                                            <td class="table-tail-td"><div class="text-sm text-gray-900">{{$pago->monto}}</div></td>
                                            <td class="table-tail-td">
                                                <div class="text-sm text-gray-900">{{$pago->fecha_pago->format('d-m-Y')}}</div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@stop

@section('css')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
@stop
@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
@stop
