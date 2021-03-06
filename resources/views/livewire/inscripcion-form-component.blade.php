<div>
    <h1 class="text-gray-500 uppercase text-2xl mt-5 mb-3 text-center">Registrar Inscripción</h1>
    <form action="{{ route('admin.inscripciones.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 mb-3">Datos Personales</h2>
        <x-jet-input type="hidden" value="{{$estudiante->id}}" name="estudiante_id" />
        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-3 mt-4">
            <div>
                <x-jet-label for="nombre" value="Nombre" />
                <x-jet-input id="nombre" type="text" value="{{$estudiante->nombre}}" class="mt-1 block w-full" disabled />
                <x-jet-input-error for="nombre" class="mt-2" />
            </div>
            <div>
                <x-jet-label for="paterno" value="Paterno" />
                <x-jet-input id="paterno" type="text" value="{{$estudiante->paterno}}" class="mt-1 block w-full" disabled />
                <x-jet-input-error for="paterno" class="mt-2" />
            </div>
            <div>
                <x-jet-label for="materno" value="Materno" />
                <x-jet-input id="materno" type="text" value="{{$estudiante->materno}}" class="mt-1 block w-full" disabled />
                <x-jet-input-error for="materno" class="mt-2" />
            </div>
            <div>
                <x-jet-label for="celular" value="Celular" />
                <x-jet-input id="celular" type="text" value="{{$estudiante->celular}}" class="mt-1 block w-full" disabled />
                <x-jet-input-error for="celular" class="mt-2" />
            </div>
        </div>
        <h2 class="text-sm uppercase text-blue-500 border-b-2 mt-4 border-gray-200 mb-3">Datos Académicos</h2>
        <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">
            <div class="col-span-3">
                <x-required-label for="carrera_id" value="Carrera" />
                <select id="carrera_id" class="custom-select sm:text-sm" name="carrera_id" wire:model="carrera_id">
                    <option value="" selected>-- Seleccionar Carrera --</option>
                    @foreach ($carreras as $carrera)
                        <option value="{{ $carrera->id }}">{{$carrera->titulo}}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="carrera_id" class="mt-2" />
            </div>
            <div class="col-span-4">
                <x-required-label for="horario_id" value="Horario" />
                <select id="horario_id" class="custom-select sm:text-sm" name="horario_id">
                    <option value="" selected>-- Seleccionar horario --</option>
                    @foreach ($horarios as $horario)
                        <option value="{{ $horario->id }}">
                            {{$horario->dias}} / {{$horario->hora_inicio}}-{{$horario->hora_fin}}
                        </option>
                    @endforeach
                </select>
                <x-jet-input-error for="horario_id" class="mt-2" />
            </div>
            <div class="col-span-5 transition duration-500 ease-out px-4">
                @if (!is_null($modulos))
                    <x-required-label for="moduloSeleccionado" value="Módulos" />
                    @foreach ($modulos as $modulo)
                        <label for="moduloSeleccionado" class="flex items-start">
                            <x-jet-checkbox name="moduloSeleccionado" value="{{$modulo->id}}" />
                            <span class="ml-2 text-sm text-gray-600">{{$modulo->titulo}}</span>
                        </label>
                    @endforeach
                    <input type="hidden" name="planificacion_id" value="{{$planificacion->id}}">
                @endif
            </div>
        </div>
        <div class="mt-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <x-required-label for="tipo_pago_id" value="Tipo de Plan de Pago" />
                    <select id="tipo_pago_id" class="custom-select sm:text-sm" name="tipo_pago_id">
                        <option value="" selected>-- Seleccionar tipo --</option>
                        @foreach ($pagos as $pago)
                            <option value="{{ $pago->id }}">{{$pago->nombre}}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="tipo_pago_id" class="mt-2" />
                </div>
                <div>
                    <x-jet-label for="modalidad" value="Modalidad" />
                    <x-jet-input id="modalidad" type="text" value="{{$modalidad}}" class="mt-1 block w-full" disabled />
                </div>
            </div>
        </div>
        <h2 class="text-sm uppercase text-blue-500 border-b-2 mt-5 border-gray-200 mb-3">Datos Deposito Bancario</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-3 mt-4">
            <div>
                <x-required-label for="numero_recibo" value="Número del recibo" />
                <x-jet-input id="numero_recibo" type="number" class="mt-1 block w-full"
                    name="numero_recibo" value="{{ old('numero_recibo') }}" />
                <x-jet-input-error for="numero_recibo" class="mt-2" />
            </div>
            <div>
                <x-required-label for="monto" value="Monto" />
                <x-jet-input id="monto" type="number" class="mt-1 block w-full"
                    name="monto" value="{{ old('monto') }}" />
                <x-jet-input-error for="monto" class="mt-2" />
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-3 mt-4">
            <div>
                <x-required-label for="fecha_pago" value="Fecha del Deposito" />
                <x-jet-input id="fecha_pago" type="date" class="mt-1 block w-full"
                    name="fecha_pago" value="{{ old('fecha_pago') }}" />
                <x-jet-input-error for="fecha_pago" class="mt-2" />
            </div>
            <div>
                <x-required-label for="boleta" value="Subir Comprobante del Deposito" />
                <x-jet-input id="boleta" type="file" class="mt-1 block w-full"
                    name="boleta"  accept="application/pdf" />
                <x-jet-input-error for="boleta" class="mt-2" />
            </div>
        </div>
        <div class="flex justify-end mt-6">
            <x-back-button href="{{ route('admin.inscripciones.index') }}" class="mr-2">Volver</x-back-button>
            <x-jet-danger-button type="submit">Registrar</x-jet-danger-button>
        </div>
    </form>
</div>
