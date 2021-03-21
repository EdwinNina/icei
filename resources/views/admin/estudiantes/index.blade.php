@extends('adminlte::page')

@section('title', 'Estudiantes')

@section('content_header')
@stop

@section('content')
    <div class="w-full">
        @if (session('failures'))
        <div class="bg-red-500 border-l-8 px-5 py-2 rounded mb-3 border-red-600">
            <ul class="list-none">
                <p class="text-white text-center">HUBO UN ERROR EN LA IMPORTACIÓN!!</p>
                @foreach (session('failures') as $failure)
                    <div class="flex items-center justify-center">
                        <p class="text-white text-center">Existe error en la fila nro {{ $failure->row() }} en la columna {{ $failure->attribute() }} del archivo excel</p>
                    </div>
                    @foreach ($failure->errors() as $error)
                        <li class="text-white text-center">{{ $error }}</li>
                    @endforeach
                @endforeach
            </ul>
        </div>
        @endif
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @livewire('estudiante-component')
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
@stop
@section('js')
    <script src="{{ mix('js/app.js') }}" defer></script>

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

