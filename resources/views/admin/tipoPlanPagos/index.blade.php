@extends('adminlte::page')

@section('title', 'Tipo de Pagos')

@section('content_header')
@stop

@section('content')
    <div class="py-2">
        <div class="w-full">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('tipo-plan-pago-component')
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @trixassets

@stop

@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('modals')
@stop
