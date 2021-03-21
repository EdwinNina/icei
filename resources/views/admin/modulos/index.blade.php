@extends('adminlte::page')

@section('title', 'Modulos')

@section('content_header')
@stop

@section('content')
    <div>
        <div class="w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @livewire('modulo-component')
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('css/lightbox.min.css') }}">
@stop
@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('js/lightbox-plus-jquery.min.js') }}"></script>

    <script>
        window.livewire.on('messageSuccess', value => {
            switch (value) {
                case 'create':
                    toastr.success('Correcto', 'Registro agregado correctamente');
                    break;
                case 'update':
                    toastr.success('Correcto', 'Registro actualizado correctamente');
                break;
            }
        });

        window.livewire.on('messageFailed', () => {
            toastr.error('Incorrecto', 'Hubo un error, intentelo de nuevo!');
        });
    </script>
@stop
