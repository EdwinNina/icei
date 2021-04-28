@extends('adminlte::page')

@section('title', 'Historial Económico')

@section('content_header')
@stop

@section('content')
    <div class="w-full pb-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <h1 class="text-gray-500 uppercase text-2xl mt-5 text-center">Mi historial académico</h1>
            <div class="p-6">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                    <div>
                        <h2 class="text-sm uppercase text-blue-500 border-b-2 mt-4 border-gray-200 mb-3">Datos Personales</h2>
                        <p><span class="font-bold">Nombre: </span><span>{{$estudiante->nombre_completo}}</span></p>
                        <p><span class="font-bold">Cédula de identidad: </span><span>{{$estudiante->carnet}} {{$estudiante->expedido}}</span></p>
                        <p><span class="font-bold">Código: </span> {{$estudiante->codigo}}</p>
                        <p><span class="font-bold">Celular: </span> {{$estudiante->celular}}</p>
                        <p><span class="font-bold">Correo electrónico: </span> {{$estudiante->email}}</p>
                    </div>
                    <div>
                        <h2 class="text-sm uppercase text-blue-500 border-b-2 mt-4 border-gray-200 mb-3">Grado Académico</h2>
                        <p><span class="font-bold">Grado: </span> {{Str::title($estudiante->grado->grado)}}</p>
                        <p><span class="font-bold">Profesión: </span><span>{{Str::title($estudiante->grado->profesion)}}</span></p>
                        <p><span class="font-bold">Carrera: </span><span>{{Str::title($estudiante->grado->carrera)}}</span></p>
                        <p><span class="font-bold">Universidad: </span><span>{{Str::title($estudiante->grado->universidad)}}</span></p>
                    </div>
                    <div>
                        <h2 class="text-sm uppercase text-blue-500 border-b-2 mt-4 border-gray-200 mb-3">Referencias Familiares</h2>
                        <p><span class="font-bold">Nombre: </span><span>{{$estudiante->familiares->nombre_completo}}</span></p>
                        <p><span class="font-bold">Celular: </span> {{$estudiante->celular}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white overflow-hidden my-4 shadow-sm sm:rounded-lg">
            @livewire('kardex-estudiante-component', [
                'estudiante' => $estudiante,
                'carreras' => $carreras,
                'estudiante_id_activo' => $estudiante_id_activo
            ])
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
@stop
@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
@stop
