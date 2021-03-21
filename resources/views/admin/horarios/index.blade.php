@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de Horarios</h1>
@stop

@section('content')
    <div class="py-2">
        <div class="w-full">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('horario-component')
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@stop

@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('modals')
@stop
