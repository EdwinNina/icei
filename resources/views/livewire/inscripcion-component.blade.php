<div class="p-6">
    <div class="flex flex-col md:flex-row md:justify-between py-3">
        @include('components.search')
        <div class="grid grid-cols-2 gap-4 items-end">
            <select class="custom-select sm:text-sm mt-2 md:mt-0 md:mr-3" wire:model="estado">
                <option value="1" selected>Activos</option>
                <option value="0">Anulados</option>
            </select>
            <a href="{{ route('admin.inscripciones.create') }}"
            class="btn bg-gray-800 md:mx-auto focus:border-gray-900 hover:bg-gray-700 hover:text-white">Nuevo</a>
        </div>
    </div>

    @include('components.delete-modal')
    @include('admin.inscripciones.modal-congelamiento')

    <div class="mb-4">
        <div class="flex justify-between items-center mb-2">
            <h3 class="text-gray-500 uppercase text-sm font-semibold w-full">Buscar Por:</h3>
            <a href="" wire:click.prevent="limpiarFiltro()"
            class="p-2 flex items-center bg-purple-600 text-white rounded-md shadow-md hover:bg-purple-700 ml-4 mt-1">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </a>
        </div>
        <div class="bg-gray-100 px-2 py-3 rounded-lg">
            <div class="flex items-start mt-1 flex-wrap">
                <select class="custom-select sm:text-sm w-full md:flex-1" wire:model="carrera_id">
                    <option value="" selected>Seleccionar Carrera</option>
                    @foreach ($carreras as $carrera)
                        <option value="{{$carrera->id}}">{{$carrera->titulo}}</option>
                    @endforeach
                </select>
                <select class="custom-select sm:text-sm md:ml-4 w-full md:flex-1" wire:model.defer="modulo_id">
                    <option value="" selected>Seleccionar Modulo</option>
                    @if (!is_null($modulos))
                        @foreach ($modulos as $modulo)
                            <option value="{{$modulo->id}}">{{$modulo->titulo_completo}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="flex items-start mt-1 flex-wrap">
                <select class="custom-select sm:text-sm flex-1" wire:model.defer="horario_id">
                    <option value="" selected>Seleccionar Horario</option>
                    @foreach ($horarios as $horario)
                        <option value="{{$horario->id}}">{{$horario->horario_completo}}</option>
                    @endforeach
                </select>
                <select name="" class="custom-select sm:text-sm w-full md:mx-4 md:flex-1" wire:model="modalidad_id">
                    <option value="" selected>Seleccionar Modalidad</option>
                    @foreach ($modalidades as $modalidad)
                        <option value="{{$modalidad->id}}">{{$modalidad->nombre}}</option>
                    @endforeach
                </select>
                <select name="" class="custom-select sm:text-sm w-full md:flex-1" wire:model="estado_congelacion">
                    <option value="" selected>Seleccionar Estado</option>
                    <option value="1">Congelados</option>
                    <option value="0">Habilitados</option>
                </select>
            </div>
        </div>
    </div>
    @if (count($inscripciones) > 0)
        <div class="shadow-sm border-b overflow-hidden rounded border-gray-200 sm:rounded-lg">
            <div class="table-responsive">
                <table class="table-tail">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="table-tail-th">Nombre del Estudiante</th>
                        <th scope="col" class="text-xs font-medium pl-2 text-gray-500 uppercase w-44">Carrera</th>
                        <th scope="col" class="w-44 text-xs font-medium pl-2 text-gray-500 uppercase">Módulo</th>
                        <th scope="col" class="table-tail-th text-center">Horario</th>
                        <th scope="col" class="table-tail-th text-center">Estado</th>
                        <th scope="col" class="table-tail-thr text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 relative">
                        @foreach ($inscripciones as $index => $item)
                            <tr>
                                <td class="table-tail-td">
                                    <div class="text-sm text-gray-900 {{ $item->congelacion == "1" ? 'line-through text-blue-500':''}}">
                                        {{ $item->estudiante->nombre_completo }}</div>
                                    <div class="text-xs font-bold text-gray-900 {{ $item->congelacion == "1" ? 'text-blue-500':''}}">
                                        {{ $item->congelacion == "1" ? 'Congeló el módulo' : '' }}
                                    </div>
                                </td>
                                <td class="w-44">
                                    <div class="text-sm text-gray-900">{{ Str::title($item->modulo->carrera->titulo) }}</div>
                                    <div class="text-xs font-semibold text-gray-600">
                                        Mod. {{ Str::title($item->planificacionCarrera->modalidad->nombre) }}
                                    </div>
                                </td>
                                <td class="w-44" data-toggle="tooltip" data-placement="top" title="{{$item->modulo->titulo_completo}}">
                                    <div class="text-sm text-gray-900">{{
                                        Str::length($item->modulo->titulo_completo) > 40
                                        ? Str::substr($item->modulo->titulo_completo, 0, 40) . "..."
                                        : $item->modulo->titulo_completo
                                    }}
                                    </div>
                                </td>
                                <td class="table-tail-td text-center">
                                    <div class="text-sm text-gray-900">
                                        {{  Str::title($item->planificacionCarrera->horario->dias) }}
                                    </div>
                                    <div class="text-sm text-gray-900">
                                        {{$item->planificacionCarrera->horario->hora_inicio->format('H:i')}}
                                        {{$item->planificacionCarrera->horario->hora_fin->format('H:i')}}
                                    </div>
                                </td>
                                <td class="table-tail-td text-center">
                                    <div class="flex justify-center items-center">
                                        <span
                                            data-toggle="tooltip" data-placement="left" title="{{$item->estado === '1' ? 'Estudiante Inscrito': 'Inscripcion Anulada'}}">
                                            <svg class="h-5 w-5 {{$item->estado === '1' ? 'text-green-600' : 'text-red-600'}}"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                            </svg>
                                        </span>
                                        @foreach ($item->pagosInscripcion as $index => $pago)
                                            @if ($index === count($item->pagosInscripcion) - 1)
                                                <span
                                                    data-toggle="tooltip" data-placement="left" title="{{$pago->estado === '2' ? 'Cancelación inscripcion incompleta': 'Cancelación inscripcion completa'}}">
                                                    <svg class="h-5 w-5 {{$pago->estado === '2' ? 'text-red-600' : 'text-green-600'}}"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                                    </svg>
                                                </span>
                                                @endif
                                            @endforeach
                                    </div>
                                    <div class="text-xs font-bold text-gray-500">{{ $item->created_at->format('d-m-Y')}}</div>
                                </td>
                                <td class="table-tail-td text-center text-sm font-medium">
                                    <div class="flex items-center justify-start">
                                        <a href="{{ route('admin.inscripciones.edit', $item) }}"
                                            class=" flex justify-center items-center mx-auto bg-yellow-500 rounded-full w-7 h-7 hover:bg-yellow-600 transition-all">
                                            @include('components.edit-icon')
                                        </a>
                                        @if ($item->estado === '1')
                                            <a href="" wire:click.prevent="openDelete({{$item->id}})"
                                                class=" flex justify-center items-center mx-auto bg-red-500 rounded-full w-7 h-7 hover:bg-red-600 transition-all">
                                                @include('components.delete-icon')
                                            </a>
                                        @else
                                            <a href="" wire:click.prevent="enableItem({{$item->id}})"
                                                class=" flex justify-center items-center mx-auto bg-indigo-500 rounded-full w-7 h-7 hover:bg-indigo-600 transition-all">
                                                <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </a>
                                        @endif
                                        <a href="{{route('admin.inscripciones.generarPDF', $item->id)}}"
                                            target="_blank"
                                            class=" flex justify-center items-center mx-auto bg-green-500 rounded-full w-7 h-7 hover:bg-green-600 transition-all">
                                            <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </a>
                                        @if ($item->congelacion == '0')
                                            <a href="" wire:click.prevent="openModalCongelacion({{$item->id}})"
                                                data-toggle="tooltip" data-placement="left" title="Congelar inscripción"
                                                class=" flex justify-center items-center mx-auto bg-blue-500 rounded-full w-7 h-7 hover:bg-blue-600 transition-all">
                                                <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5" />
                                                </svg>
                                            </a>
                                        @else
                                            <a href="" wire:click.prevent="openModalDescongelacion({{$item->id}})"
                                                data-toggle="tooltip" data-placement="left" title="Anular Congelación"
                                                class=" flex justify-center items-center mx-auto bg-red-500 rounded-full w-7 h-7 hover:bg-red-600 transition-all">
                                                <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5" />
                                                </svg>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="py-4">
            {{ $inscripciones->links() }}
        </div>
        @else
            <p class="text-red-400 text-center mt-4 font-bold">No existen coincidencias con lo seleccionado</p>
        @endif
</div>

