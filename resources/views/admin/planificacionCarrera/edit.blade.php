@extends('adminlte::page')

@section('title', 'Crear Planificacion')

@section('content')
    <div>
        <div class="w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-8 pb-3">
                <div class="flex justify-between mt-4 text-gray-500">
                    <h1 class="uppercase text-2xl">Actualizar Planificacion de la Carrera</h1>
                    <p>GESTION: {{$anio}}</p>
                </div>
                <form action="{{ route('admin.planificacionCarrera.update', $planificacion->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mt-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <x-required-label for="carrera" value="Carrera" />
                                <select class="custom-select sm:text-sm" id="carrera" name="carrera" value="{{ $planificacion->carrera }}">
                                    <option value="" selected disabled>-- Seleccionar carrera --</option>
                                    @foreach ($carreras as $carrera)
                                        <option value="{{ $carrera->id }}" {{ $carrera->id === $planificacion->carrera_id ? 'selected' : '' }}>
                                            {{ Str::title($carrera->titulo) }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="carrera" class="mt-2" />
                            </div>
                            <div>
                                <x-required-label for="modalidad" value="Modalidad" />
                                <select class="custom-select sm:text-sm" id="modalidad" name="modalidad" value="{{ $planificacion->modalidad }}">
                                    <option value="" selected disabled>-- Seleccionar modalidad --</option>
                                    @foreach ($modalidades as $modalidad)
                                        <option value="{{ $modalidad->id }}" {{ $modalidad->id === $planificacion->modalidad_id ? 'selected' : '' }}>
                                            {{ $modalidad->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="modalidad" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <x-required-label for="horario" value="Horario" />
                                <select class="custom-select sm:text-sm" id="horario" name="horario" value="{{ $planificacion->horario }}">
                                    <option value="" selected disabled>-- Seleccionar horario --</option>
                                    @foreach ($horarios as $horario)
                                        <option value="{{ $horario->id }}" {{ $horario->id === $planificacion->horario_id ? 'selected' : '' }}>
                                            {{ $horario->horario_completo }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="horario" class="mt-2" />
                            </div>
                            <div>
                                <x-required-label for="docente" value="Docente" />
                                <select class="custom-select sm:text-sm"
                                    id="docente" name="docente" value="{{ $planificacion->docente }}">
                                    <option value="" selected disabled>-- Seleccionar docente --</option>
                                    @foreach ($docentes as $docente)
                                        <option value="{{ $docente->id }}" {{ $docente->id === $planificacion->docente_id ? 'selected' : '' }}>
                                            {{ Str::title($docente->nombre_completo) }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="docente" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <x-required-label for="costo_carrera" value="Costo de la Carrera" />
                                <x-jet-input id="costo_carrera" type="number" name="costo_carrera" class="mt-1 block w-full"  value="{{ $planificacion->costo_carrera }}"/>
                                <x-jet-input-error for="costo_carrera" class="mt-2" />
                            </div>
                            <div>
                                <x-required-label for="costo_modulo" value="Costo del modulo" />
                                <x-jet-input id="costo_modulo" type="number" name="costo_modulo" class="mt-1 block w-full" value="{{ $planificacion->costo_modulo }}"/>
                                <x-jet-input-error for="costo_modulo" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="observaciones" value="Observaciones" />
                        <div class="rounded-md shadow-sm">
                            <input type="hidden" name="observaciones" id="observaciones" value="{{ $planificacion->observaciones }}">
                            <trix-editor
                                class="trix-content trix"
                                input="observaciones"
                            ></trix-editor>
                        </div>
                        <x-jet-input-error for="observaciones" class="mt-2" />
                    </div>
                    <div class="mt-4 flex justify-end items-center">
                        <x-back-button href="{{route('admin.planificacionCarrera.index')}}">Volver</x-back-button>
                        <x-jet-danger-button type="submit" class="ml-2">Guardar</x-jet-danger-button>
                    </div>
                </form>
            </div>
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
