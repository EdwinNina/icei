@extends('adminlte::page')

@section('title', 'Estudiantes Anteriores')

@section('content_header')
@stop

@section('content')
    <div>
        @if (session('message'))
            <div class=" border-l-4 px-5 py-2 rounded mb-3
                {{session('message') === 'good' ? 'bg-green-500 border-green-600' : 'bg-red-500 border-red-600'}}">
                <span class="text-white text-center">
                    {{ session('message') === 'good'
                        ? 'La inscripcion se realizo con exito'
                        : 'Ocurrió un error, intentelo de nuevo'
                    }}
                </span>
            </div>
        @endif
        <div class="w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @livewire('anteriores-estudiantes-component')
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
