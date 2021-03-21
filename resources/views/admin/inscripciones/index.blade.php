@extends('adminlte::page')

@section('title', 'Dashboard')

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
                @livewire('inscripcion-component')
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
@stop
@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
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
    {{-- <script>Libreria axios</script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const fecha_de = document.getElementById('fecha_de');
            const fecha_hasta = document.getElementById('fecha_hasta');
            const boton = document.getElementById('boton');

            boton.addEventListener('click', (e) => {
                e.preventDefault();
                //aqui haces la llamada al controlador por medio de ajax
                const data = new FormData();
                data.append('fecha_de',fecha_de.value);
                data.append('fecha_hasta',fecha_de.value);
                axios.get('ruta al metodo del controlador',data)
                    .then(resp => {
                        let respuesta = resp.body;
                        //dibujas la tabla
                    })
            });
        });
    </script> --}}
@stop
