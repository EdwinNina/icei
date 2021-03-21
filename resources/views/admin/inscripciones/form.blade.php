<div class="p-6">
    @include('admin.inscripciones.mostrar-planificacion-modulos')
    <h1 class="text-gray-500 uppercase text-2xl mt-1 mb-3 text-center">{{$tituloFormulario}}</h1>
    <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 mb-3">Datos Personales </h2>
    <div class="grid grid-cols-1 md:grid-cols-5 gap-3 mt-4">
        <div class="flex items-start flex-wrap col-span-2">
            <x-jet-label for="buscarPorCarnet" value="Buscar Estudiante" class="w-full" />
            <x-jet-input type="text" wire:model.debounce.800ms="buscarPorCarnet" placeholer="Buscar...." class="flex-auto"/>
            {{-- <a href="" wire:click.prevent="buscarEstudiante()"
                class="p-2 bg-green-600 text-white flex justify-center items-center rounded-md shadow-md hover:bg-green-700 ml-1">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </a> --}}
        </div>
        <section class="col-span-3 bg-gray-50 rounded-md p-2">
            <p class="text-blue-500 font-semibold uppercase border-b-2 border-gray-200 mb-1 text-center">Coincidencias Encontradas</p>
            <div class="overscroll-auto overflow-y-scroll max-h-44">
                @if ($estudianteEncontrado)
                    <table class="table-tail">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="table-tail-th bg">Codigo</th>
                                <th class="table-tail-th bg">Nombre</th>
                                <th class="table-tail-th bg">Paterno</th>
                                <th class="table-tail-th bg">Materno</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($estudianteEncontrado as $item)
                                <tr>
                                    <td><x-jet-input type="radio" wire:model="estudiante_id" value="{{$item->id}}" /></td>
                                    <td class="table-tail-th">{{$item->codigo}}</td>
                                    <td class="table-tail-th">{{$item->nombre}}</td>
                                    <td class="table-tail-th">{{$item->paterno}}</td>
                                    <td class="table-tail-th">{{$item->materno}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-red-500 text-center">Digita la cédula de identidad para encontrar al estudiante</p>
                @endif
            </div>
        </section>
    </div>
    <h2 class="text-sm uppercase text-blue-500 border-b-2 mt-4 border-gray-200 mb-3">Referencias Familiares</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-4 mt-4">
        <div>
            <x-jet-label for="nombre" value="Nombre" />
            <x-jet-input id="nombre" type="text" class="mt-1 block w-full"
                wire:model.debounce.800ms="nombre" readonly />
            <x-jet-input-error for="nombre" class="mt-2" />
        </div>
        <div>
            <x-jet-label for="paterno" value="Paterno" />
            <x-jet-input id="paterno" type="text" class="mt-1 block w-full" wire:model.debounce.800ms="paterno"  readonly/>
            <x-jet-input-error for="paterno" class="mt-2" />
        </div>
        <div>
            <x-jet-label for="materno" value="Materno" />
            <x-jet-input id="materno" type="text" class="mt-1 block w-full" wire:model.debounce.800ms="materno" readonly/>
            <x-jet-input-error for="materno" class="mt-2" />
        </div>
        <div>
            <x-jet-label for="celular" value="celular" />
            <x-jet-input id="celular" type="text" class="mt-1 block w-full" wire:model.debounce.800ms="celular" readonly/>
            <x-jet-input-error for="celular" class="mt-2" />
        </div>
    </div>
    <h2 class="text-sm uppercase text-blue-500 border-b-2 mt-4 border-gray-200 mb-3">Nombre del Curso o Modulo de Formación Especializada</h2>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div>
            <x-required-label for="carrera_id" value="Carrera" />
            <select id="carrera_id" class="custom-select sm:text-sm" wire:model="carrera_id">
                <option value="" selected>-- Seleccionar Carrera --</option>
                @foreach ($carreras as $carrera)
                    <option value="{{ $carrera->id }}">{{$carrera->titulo}}</option>
                @endforeach
            </select>
            <x-jet-input-error for="carrera_id" class="mt-2" />
        </div>
        <div>
            <x-required-label for="horario_id" value="Horario" />
            <select id="horario_id" class="custom-select sm:text-sm" wire:model="horario_id">
                <option value="" selected>-- Seleccionar horario --</option>
                @foreach ($horarios as $horario)
                    <option value="{{ $horario->id }}">
                        {{$horario->dias}} / {{$horario->hora_inicio}}-{{$horario->hora_fin}}
                    </option>
                @endforeach
            </select>
            <x-jet-input-error for="horario_id" class="mt-2" />
        </div>
        <div>
            <x-required-label for="modalidad_id" value="Modalidades" />
            <div class="flex items-start">
                <div class="flex-auto">
                    <select id="modalidad_id" class="custom-select sm:text-sm" wire:model="modalidad_id">
                        <option value="" selected>-- Seleccionar modalidad --</option>
                        @foreach ($modalidades as $modalidad)
                            <option value="{{ $modalidad->id }}">{{$modalidad->nombre}}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="horario_id" class="mt-2" />
                </div>
                <a href="" wire:click.prevent="buscarPlanificacion()"
                    class="p-2 bg-green-600 text-white flex justify-center items-center rounded-md shadow-md hover:bg-green-700 ml-2 mt-1">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <div class="mt-3">
        {{-- <p class="text-blue-500 font-semibold uppercase border-b-2 border-gray-200 mb-1 text-center">Coincidencias Encontradas</p> --}}
        @if (!is_null($planificaciones))
            @if (count($planificaciones) > 0)
                <div class="w-full bg-gray-50 rounded-md p-2">
                    <table class="table-tail">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="table-tail-th bg">Codigo</th>
                                <th class="table-tail-th bg">Costo Carrera</th>
                                <th class="table-tail-th bg">Costo Modulo</th>
                                <th class="table-tail-th bg">Docente</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($planificaciones as $item)
                                <tr>
                                    <td><x-jet-input type="radio" wire:model="planificacion_id" value="{{$item->id}}" /></td>
                                    <td class="table-tail-th">{{$item->codigo}}</td>
                                    <td class="table-tail-th">{{$item->costo_carrera}}</td>
                                    <td class="table-tail-th">{{$item->costo_modulo}}</td>
                                    <td class="table-tail-th">{{$item->docente->nombre}}</td>
                                    <td>
                                        <button wire:click="consultarPlanificacionModulos({{$item->id}})" class="btn bg-green-800 focus:border-green-900 hover:text-white hover:bg-green-700 items-center justify-center">
                                            Ver Modulos
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center text-red-500">No hay planificaciones que coincidan con lo requerido</p>
            @endif
        @endif
    </div>
    <div class="mt-4">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <x-required-label for="actividad" value="Lugar de estudio u Ocupación" />
                <select wire:model="actividad" id="actividad" class="custom-select sm:text-sm">
                    <option value="" selected>-- Seleccionar actividad --</option>
                    @foreach ($actividades as $key => $actividad)
                        <option value="{{ $key }}">{{$actividad}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <x-required-label for="tipo_pago_id" value="Tipo de Pago" />
                <select id="tipo_pago_id" class="custom-select sm:text-sm" wire:model="tipo_pago_id">
                    <option value="" selected>-- Seleccionar tipo --</option>
                    @foreach ($tipoPagos as $tipoPago)
                        <option value="{{ $tipoPago->id }}">{{$tipoPago->nombre}}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="tipo_pago_id" class="mt-2" />
            </div>
            <div>
                <x-required-label for="tipo_plan_pago_id" value="Tipo de Plan de Pago" />
                <select id="tipo_plan_pago_id" class="custom-select sm:text-sm" wire:model="tipo_plan_pago_id">
                    <option value="" selected>-- Seleccionar plan --</option>
                    @foreach ($tipoPlanPagos as $tipoPlanPago)
                        <option value="{{ $tipoPlanPago->id }}">{{$tipoPlanPago->nombre}}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="tipo_plan_pago_id" class="mt-2" />
            </div>
        </div>
    </div>
    <div class="mt-4">
        @if (!is_null($modulos))
            <div class="transition duration-500 ease-out">
                <x-required-label for="modulo_id" value="Módulos" />
                <select id="modulo_id" class="custom-select sm:text-sm" wire:model="modulo_id">
                    <option value="" selected>-- Seleccionar módulo --</option>
                    @foreach ($modulos as $item)
                        <option value="{{$item->modulo->id}}">{{$item->modulo->titulo}}</option>
                    @endforeach
                </select>
            </div>
        @endif
    </div>
    <h2 class="text-sm uppercase text-blue-500 border-b-2 mt-5 border-gray-200 mb-3">Datos Deposito Bancario</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-3 mt-4">
        <div>
            <x-required-label for="monto" value="Monto" />
            <x-jet-input id="monto" type="number" class="mt-1 block w-full"
                wire:model="monto" />
            <x-jet-input-error for="monto" class="mt-2" />
        </div>
        <div>
            <x-required-label for="fecha_pago" value="Fecha del Deposito" />
            <x-jet-input id="fecha_pago" type="date" class="mt-1 block w-full"
                wire:model="fecha_pago" />
            <x-jet-input-error for="fecha_pago" class="mt-2" />
        </div>
    </div>
    @if (!$mostrarPagos)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-3 mt-4">
            <div>
                <x-required-label for="numero_recibo" value="Número del recibo" />
                <x-jet-input id="numero_recibo" type="number" class="mt-1 block w-full"
                    wire:model="numero_recibo" />
                <x-jet-input-error for="numero_recibo" class="mt-2" />
            </div>
                @if (!$inscripcion_id)
                <div>
                    <x-required-label for="boleta" value="Subir Comprobante del Deposito" />
                    <x-jet-input id="boleta" type="file" class="mt-1 block w-full"
                        wire:model="boleta"  accept="application/pdf" />
                    <x-jet-input-error for="boleta" class="mt-2" />
                </div>
            @endif
        </div>
    @endif
    <div class="flex justify-end mt-6">
        <x-back-button href="{{ route('admin.inscripciones.index') }}" class="mr-2">Volver</x-back-button>
        @if ($inscripcion_id)
            <x-jet-danger-button wire:click.prevent="update()">Actualizar</x-jet-danger-button>
        @else
            <x-jet-danger-button wire:click.prevent="save()">Registrar</x-jet-danger-button>
        @endif
    </div>
</div>
