@extends('adminlte::page')

@section('title', 'Inscripcion Talleres')

@section('content_header')
@stop

@section('content')
<div>
    <div class="w-full">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <form action="{{ route('admin.inscripcionesTalleres.store') }}" method="POST">
                @csrf
                <div class="p-6">
                    <h1 class="text-gray-500 uppercase text-2xl mt-1 mb-3 text-center">Registrar Inscripción al taller</h1>
                    <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 mb-3">Datos Personales </h2>
                    @livewire('buscador-estudiante-component')
                    <h2 class="text-sm uppercase text-blue-500 border-b-2 mt-4 border-gray-200 mb-3">Nombre del taller</h2>
                    @livewire('filtro-planificacion-talleres-component')
                    <div class="hidden" id="mostrarCarrito">
                        @livewire('carrito-pagos-component')
                    </div>
                </div>
                <div class="flex justify-end mt-6 bg-gray-50 py-4 px-6">
                    <x-back-button href="{{ route('admin.inscripcionesTalleres.index') }}" class="mr-2">Volver</x-back-button>
                    <x-jet-danger-button type="submit" id="btnGuardar">Registrar</x-jet-danger-button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
@stop
@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
    @stack('script')
    <script>
        window.livewire.on('mostrarCarrito', () => {
            document.getElementById('mostrarCarrito').classList.remove('hidden');
        });

        window.livewire.on('montoCorrecto', () => {
            Swal.fire('Monto ingresado correcto!', '', 'success')
            document.getElementById('btnGuardar').classList.remove('hidden');
        });
        window.livewire.on('errorMonto', () => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'El monto ingresado no puede ser mayor al saldo',
                footer: 'Por favor ingrese un monto igual o menor al saldo'
            });
            document.getElementById('btnGuardar').classList.add('hidden');
        });
    </script>
@stop
