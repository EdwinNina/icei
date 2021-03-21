@extends('adminlte::page')

@section('title', 'Estudiantes')

@section('content_header')
@stop

@section('content')
    <div class="w-full">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-3 px-8">
            <div class="flex items-center justify-between">
                <h1 class="text-gray-500 uppercase text-2xl mt-3 text-center">Reporte Estudiantil</h1>
                <a href="{{ route('admin.estudiantes.generarPdfModulosInscritos', $estudiante->id)}}" class="btn bg-green-800 focus:border-green-900 hover:bg-green-700 focus:text-white hover:text-white">
                    Exportar a PDF
                </a>
            </div>
            <section class="mt-4">
                <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200">Datos del Estudiante</h2>
                <div class="flex mt-3">
                    <label>Nombre:</label>
                    <p class="ml-3">{{$estudiante->nombre}} {{$estudiante->paterno}} {{$estudiante->materno}}</p>
                </div>
                <div class="flex">
                    <label>Cédulo de identidad:</label>
                    <p class="ml-3">{{$estudiante->carnet}} {{$estudiante->expedido}}</p>
                </div>
                <div class="flex">
                    <label>Código:</label>
                    <p class="ml-3">{{$estudiante->codigo}}</p>
                </div>
                <div class="flex">
                    <label>Correo eléctronico:</label>
                    <p class="ml-3">{{$estudiante->email}}</p>
                </div>
            </section>
            <section class="mt-2">
                @if (count($detalles) > 0)
                    <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200">Cursos o Módulos tomados por el estudiante</h2>
                    <div class="shadow-sm overflow-hidden mt-3 border-b rounded border-gray-200 sm:rounded-lg">
                        <div class="table-responsive">
                            <table class="table-tail">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="table-tail-th">Nro</th>
                                        <th scope="col" class="table-tail-th">Carrera</th>
                                        <th scope="col" class="table-tail-th">Módulos tomados</th>
                                        <th scope="col" class="table-tail-th text-center">Fecha de inscripcion</th>
                                        <th scope="col" class="table-tail-th text-center">Monto depositado</th>
                                    </tr>
                                </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($detalles as $key => $detalle)
                                            <tr>
                                                <td class="table-tail-td">
                                                    <div class="text-sm text-gray-900">{{ $key + 1 }}</div>
                                                </td>
                                                <td class="table-tail-td">
                                                    <div class="text-sm text-gray-900">{{ $detalle->carrera}}</div>
                                                </td>
                                                <td class="table-tail-td">
                                                    <div class="text-sm text-gray-900">{{ $detalle->titulo}}</div>
                                                </td>
                                                <td class="table-tail-td">
                                                    <div class="text-sm text-center text-gray-900">{{ Carbon\Carbon::parse($detalle->fecha)->format('d-M-Y') }}</div>
                                                </td>
                                                <td class="table-tail-td">
                                                    <div class="text-sm text-center text-gray-900">{{$detalle->monto}}</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <x-back-button href="{{ route('admin.estudiantes.index') }}" class="my-4">Volver</x-back-button>
                    </div>
                @else
                    <p class="text-center uppercase text-gray-400 mt-5">El estudiante aún no se inscribio a ningún módulo</p>
                @endif
            </section>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
@stop
@section('js')
    <script src="{{ mix('js/app.js') }}" defer></script>
@stop

