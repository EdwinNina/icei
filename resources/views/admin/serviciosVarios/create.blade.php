@extends('adminlte::page')

@section('title', 'Servicios Varios')

@section('content_header')
@stop

@section('content')
    <div class="w-full">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <form action="{{ route('admin.serviciosVarios.store') }}" method="POST">
                @csrf
                <div class="p-6">
                    <h1 class="text-gray-500 uppercase text-2xl mt-1 mb-3 text-center">Registro de Servicios Varios</h1>
                    <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 mb-3">Datos Personales </h2>
                    @livewire('buscador-estudiante-component')
                    <h2 class="text-sm uppercase text-blue-500 border-b-2 mt-4 border-gray-200 mb-3">Definir detalles del servicio</h2>
                    @livewire('select-servicios-component')
                    <div class="body-content mt-4">
                        <x-required-label for="detalles" value="Detalle del Servicio" />
                        <trix-editor
                        class="trix-content trix"
                        input="detalles"
                        ></trix-editor>
                        <input type="hidden" name="detalles" id="detalles">
                        <x-jet-input-error for="detalles" class="mt-2" />
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
                        <div>
                            <x-required-label for="fecha_de_recepcion" value="Fecha de recepción" />
                            <x-jet-input type="date" class="w-full" name="fecha_recepcion" id="fecha_de_recepcion"
                                value="{{date('Y-m-d')}}" />
                        </div>
                        <div>
                            <x-required-label for="fecha_de_entrega" value="Fecha de entrega" />
                            <x-jet-input type="date" class="w-full" name="fecha_entrega" id="fecha_de_entrega" />
                            <x-jet-input-error for="fecha_de_entrega" class="mt-2" />
                        </div>
                        <div>
                            <x-required-label for="docente" value="Persona Asignada" />
                            <select name="docente_id" id="docente"
                                class="custom-select sm:text-sm w-full">
                                <option value="" selected>Seleccionar</option>
                                @foreach ($docentes as $docente)
                                    <option value="{{$docente->id}}">{{$docente->nombre_completo}}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="docente" class="mt-2" />
                        </div>
                        <div>
                            <x-required-label for="monto" value="Ingresar costo del Servicio" />
                            <x-jet-input class="w-full block" type="number" name="monto" />
                            <x-jet-input-error for="monto" class="mt-2" />
                        </div>
                    </div>
                </div>
                <div class="flex justify-end mt-6 bg-gray-50 py-4 px-6">
                    <x-back-button href="{{ route('admin.serviciosVarios.index') }}" class="mr-2">Volver</x-back-button>
                    <x-jet-danger-button type="submit">Registrar</x-jet-danger-button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    @trixassets
@stop
@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
@stop
