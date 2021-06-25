@extends('adminlte::page')

@section('title', 'Inscripcion')

@section('content_header')
@stop

@section('content')
<div>
    <div class="w-full">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <form action="{{ route('admin.inscripciones.store') }}" method="POST">
                @csrf
                <div class="p-6">
                    <h1 class="text-gray-500 uppercase text-2xl mt-1 mb-3 text-center">Registrar Inscripción</h1>
                    <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 mb-3">Datos Personales </h2>
                    @livewire('buscador-estudiante-component')
                    <h2 class="text-sm uppercase text-blue-500 border-b-2 mt-4 border-gray-200 mb-3">Nombre del Curso o Modulo de Formación Especializada</h2>
                    @livewire('filtro-planificacion-component')
                    <div class="mt-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <x-required-label for="actividad" value="Lugar de estudio u Ocupación" />
                                <select name="actividad" id="actividad" class="custom-select sm:text-sm" required>
                                    <option value="" selected>-- Seleccionar actividad --</option>
                                    @foreach ($actividades as $key => $actividad)
                                        <option value="{{ $key }}">{{$actividad}}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="actividad" class="mt-2" value="{{ old('actividad') }}"/>
                            </div>
                            <div>
                                <x-required-label for="tipo_plan_pago_id" value="Tipo de Plan de Pago" />
                                <select id="tipo_plan_pago_id" class="custom-select sm:text-sm" name="tipo_plan_pago_id" required>
                                    <option value="" selected>-- Seleccionar plan --</option>
                                    @foreach ($tipoPlanPagos as $tipoPlanPago)
                                        <option value="{{ $tipoPlanPago->id }}">{{Str::title($tipoPlanPago->nombre)}}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="tipo_plan_pago_id" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    @livewire('carrito-pagos-component')
                </div>
                <div class="flex justify-end mt-6 bg-gray-50 py-4 px-6">
                    <x-back-button href="{{ route('admin.inscripciones.index') }}" class="mr-2">Volver</x-back-button>
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

        window.livewire.on('errorMontoCero', () => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No puedes ingresar un monto menor a cero',
                footer: 'Por favor ingrese un monto mayor o igual a cero si corresponde'
            });
            document.getElementById('btnGuardar').classList.add('hidden');
        });
    </script>
@stop
