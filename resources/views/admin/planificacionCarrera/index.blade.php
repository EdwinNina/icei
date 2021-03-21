@extends('adminlte::page')

@section('title', 'Planificacion de Carrera')

@section('content')
    <div>
        <div class="w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @livewire('planificacion-carrera-component')
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
