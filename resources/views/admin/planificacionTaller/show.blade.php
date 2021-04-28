@extends('adminlte::page')

@section('title', 'Planificacion de Taller')

@section('content')
    @if (session('message'))
        <div class=" border-l-4 px-5 py-2 rounded mb-3
            {{session('message') === 'good' ? 'bg-green-500 border-green-600' : 'bg-red-500 border-red-600'}}">
            <span class="text-white text-center">
                {{ session('message') === 'good'
                    ? 'Planificación creada exitosamente'
                    : 'Ocurrió un error, intentelo de nuevo'
                }}
            </span>
        </div>
    @endif
    <div>
        <div class="w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="uppercase text-center mt-4 text-2xl">Detalles de la Planificación</h1>
                <div class="p-6">
                    <p><span class="font-bold">Titulo del Taller:</span> {{ Str::title($planificacion->taller->nombre)}}</p>
                    <p class="mt-2">
                        <span class="font-bold">Horario:</span> {{ Str::title($planificacion->horario->dias) }}
                    </p>
                    <p class="mt-2">
                        <span class="font-bold">Docente:</span> {{$planificacion->docente->nombre_completo}}
                    </p>
                    <p class="mt-2">
                        <span class="font-bold">Modalidad:</span> {{$planificacion->modalidad->nombre}}
                    </p>
                    <p class="mt-2">
                        <span class="font-bold">Fecha de Inicio:</span> {{$planificacion->fecha_inicio->format('d-m-Y')}}</p>
                    <p class="mt-2">
                        <span class="font-bold">Fecha de Finalización:</span> {{$planificacion->fecha_fin->format('d-m-Y')}}</p>
                    <p class="mt-2">
                        <span class="font-bold">Costo del taller (Bs):</span> {{$planificacion->costo}}
                    </p>
                    <p class="mt-2">
                        <span class="font-bold">Duración del Taller:</span>
                        <span>{{$planificacion->duracion}} {{$planificacion->duracion > 1 ? 'Días' : 'Día'}}</span>
                    </p>
                    <p class="mt-2">
                        <span class="font-bold">Carga Horaria:</span> {{ Str::title($planificacion->carga_horaria)}} horas académicas
                    </p>
                    <p class="mt-2">
                        <span class="font-bold">Requisitos:</span> {{ Str::title($planificacion->requisitos)}}
                    </p>
                    <div class="flex mt-4 justify-end">
                        <x-back-button href="{{ route('admin.planificacionTaller.index') }}">Volver</x-back-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
@stop
@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
@stop
