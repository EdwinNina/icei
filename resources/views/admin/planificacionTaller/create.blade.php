@extends('adminlte::page')

@section('title', 'Crear Planificacion')

@section('content')
    <div>
        <div class="w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-8 pb-3">
                <h1 class="uppercase text-center mt-4 text-2xl">Registrar Planificación de Talleres</h1>
                <form action="{{ route('admin.planificacionTaller.store') }}" method="post">
                    @csrf
                    <div class="mt-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <x-required-label for="taller" value="Taller" />
                                <select class="custom-select sm:text-sm" id="taller" name="taller" value="{{ old('taller') }}">
                                    <option value="" selected disabled>-- Seleccionar taller --</option>
                                    @foreach ($talleres as $taller)
                                        <option value="{{ $taller->id }}">{{ Str::title($taller->nombre) }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="taller" class="mt-2" />
                            </div>
                            <div>
                                <x-required-label for="docente" value="Docente" />
                                <select class="custom-select sm:text-sm"
                                    id="docente" name="docente" value="{{ old('docente') }}">
                                    <option value="" selected disabled>-- Seleccionar docente --</option>
                                    @foreach ($docentes as $docente)
                                        <option value="{{ $docente->id }}">{{ $docente->nombre_completo }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="docente" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-required-label for="horario" value="Horario" />
                                <select class="custom-select sm:text-sm" id="horario" name="horario" value="{{ old('horario') }}">
                                    <option value="" selected disabled>-- Seleccionar horario --</option>
                                    @foreach ($horarios as $horario)
                                        <option value="{{ $horario->id }}">{{ $horario->horario_completo }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="horario" class="mt-2" />
                            </div>
                            <div>
                                <x-required-label for="modalidad" value="Modalidad" />
                                <select class="custom-select sm:text-sm" id="modalidad" name="modalidad" value="{{ old('modalidad') }}">
                                    <option value="" selected disabled>-- Seleccionar modalidad --</option>
                                    @foreach ($modalidades as $modalidad)
                                        <option value="{{ $modalidad->id }}">{{ $modalidad->nombre }}</option>
                                    @endforeach
                                </select>
                                <x-jet-input-error for="modalidad" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <x-required-label for="fecha_inicio" value="Fecha de Inicio" />
                                <x-jet-input id="fecha_inicio" type="date" name="fecha_inicio"
                                    class="mt-1 block w-full"  value="{{ date('Y-m-d') }}"/>
                                <x-jet-input-error for="fecha_inicio" class="mt-2" />
                            </div>
                            <div>
                                <x-required-label for="fecha_fin" value="Fecha de Finalización" />
                                <x-jet-input id="fecha_fin" type="date" name="fecha_fin" class="mt-1 block w-full" value="{{ old('fecha_fin') }}"/>
                                <x-jet-input-error for="fecha_fin" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <x-required-label for="duracion" value="Duración en Dias" />
                                <x-jet-input id="duracion" type="number" name="duracion" class="mt-1 block w-full" value="{{ old('duracion') }}"/>
                                <x-jet-input-error for="duracion" class="mt-2" />
                            </div>
                            <div>
                                <x-required-label for="carga_horaria" value="Carga Horaria" />
                                <x-jet-input id="carga_horaria" type="number" name="carga_horaria" class="mt-1 block w-full" value="{{ old('carga_horaria') }}"/>
                                <x-jet-input-error for="carga_horaria" class="mt-2" />
                            </div>
                            <div>
                                <x-required-label for="costo" value="Costo del Taller" />
                                <x-jet-input id="costo" type="number" name="costo" class="mt-1 block w-full"  value="{{ old('costo') }}"/>
                                <x-jet-input-error for="costo" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-required-label for="requisitos" value="Requisitos del Taller" />
                        <x-jet-input id="requisitos" type="text" name="requisitos" class="mt-1 block w-full" value="{{ old('requisitos') }}"/>
                        <x-jet-input-error for="requisitos" class="mt-2" />
                    </div>
                    <div class="mt-4 flex justify-end items-center">
                        <x-back-button href="{{route('admin.planificacionTaller.index')}}">Volver</x-back-button>
                        <x-jet-danger-button type="submit" class="ml-2">Registrar</x-jet-danger-button>
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
