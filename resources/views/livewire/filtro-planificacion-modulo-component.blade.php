<div class="p-6">
    <div class="flex justify-between items-center mb-2">
        <h3 class="text-gray-500 uppercase text-sm font-semibold w-full">Buscar Por:</h3>
        <a href="" wire:click.prevent="limpiarFiltro()"
        class="p-2 flex items-center bg-purple-600 text-white rounded-md shadow-md hover:bg-purple-700 ml-4 mt-1">
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </a>
    </div>
    <div class="bg-gray-100 px-2 py-2 rounded-lg">
        <div class="flex items-start mt-1 flex-wrap">
            <select name="" class="custom-select sm:text-sm w-full md:flex-1" wire:model="carrera_id">
                <option value="" selected>Seleccionar Carrera</option>
                @foreach ($carreras as $carrera)
                    <option value="{{$carrera->id}}">{{ Str::title($carrera->titulo) }}</option>
                @endforeach
            </select>
            <select name="" class="custom-select sm:text-sm w-full md:flex-1 md:ml-4" wire:model.defer="modulo_id">
                <option value="" selected>Seleccionar Modulo</option>
                @if (!is_null($modulos))
                    @foreach ($modulos as $modulo)
                        <option value="{{$modulo->id}}">{{$modulo->titulo_completo}}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="flex items-start mt-1 flex-wrap">
            <select name="" class="custom-select sm:text-sm w-full md:flex-1" wire:model.defer="horario_id">
                <option value="" selected>Seleccionar Horario</option>
                @foreach ($horarios as $horario)
                    <option value="{{$horario->id}}">{{$horario->horario_completo}}</option>
                @endforeach
            </select>
            <select name="" class="custom-select sm:text-sm w-full md:mx-4 md:flex-1" wire:model.defer="modalidad_id">
                <option value="" selected>Seleccionar Modalidad</option>
                @foreach ($modalidades as $modalidad)
                    <option value="{{$modalidad->id}}">{{$modalidad->nombre}}</option>
                @endforeach
            </select>
            <select name="" class="custom-select sm:text-sm w-full md:flex-1" wire:model.defer="gestion">
                <option value="" disabled>Seleccionar gestion</option>
                @foreach ($gestiones as $key => $gestion)
                    <option value="{{ $key }}">{{$gestion}}</option>
                @endforeach
            </select>
            <a href="" wire:click.prevent="buscarPlanificacion()"
                class="p-2 bg-green-600 text-white flex justify-center items-center rounded-md shadow-md hover:bg-green-700 ml-2 mt-1">
                @include('components.search-icon')
            </a>
        </div>
        <div class="mt-2 flex justify-between items-center">
            <h3 class="text-gray-500 uppercase text-sm font-semibold w-full">Docente (Opcional):</h3>
            <select name="" class="custom-select sm:text-sm w-auto md:flex-1" wire:model="docente_id">
                <option value="" selected>Seleccionar</option>
                @foreach ($docentes as $docente)
                    <option value="{{$docente->id}}">{{ $docente->nombre_completo }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <h3 class="text-gray-500 uppercase font-semibold my-3">Lista de Planificaciones por Módulo</h3>
    <div class="shadow-sm overflow-hidden border-b rounded border-gray-200 sm:rounded-lg">
            @if (count($planificaciones) != 0)
            <table class="table-tail">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="table-tail-th w-28">Código</th>
                    <th scope="col" class="table-tail-th">Carrera</th>
                    <th scope="col" class="table-tail-th">Docente</th>
                    <th scope="col" class="table-tail-th">Fecha inicio</th>
                    <th scope="col" class="table-tail-th w-20">Fecha Fin</th>
                    <th scope="col" class="table-tail-thr text-center">Acciones</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($planificaciones as $item)
                            <tr>
                                <td class="pl-4">
                                    <div class="text-xs text-gray-900">{{ $item->codigo }}</div>
                                    <div class="text-xs text-left font-bold {{$item->estado === '1' ? 'text-green-600' : 'text-red-600'}}">
                                        {{$item->estado === '1' ? 'Activo' : 'Inactivo'}}
                                    </div>
                                </td>
                                <td class="table-tail-td">
                                    <div class="text-sm text-gray-800">{{ Str::title($item->carrera->titulo) }}</div>
                                    <div class="text-xs font-semibold text-gray-900">{{ Str::title($item->modalidad->nombre) }}</div>
                                </td>
                                <td class="table-tail-td px-2">
                                    <div class="text-xs text-gray-900">{{ Str::title($item->docente->nombre_completo) }}</div>
                                </td>
                                <td class="table-tail-td">
                                    <div class="text-sm text-gray-900">
                                        @foreach ($item->planificacionModulos as $i)
                                            @if ($i->modulo_id == $modulo_id)
                                                {{ $i->fecha_inicio == null ? 'Sin fecha asignada' : $i->fecha_inicio}}
                                            @endif
                                        @endforeach
                                    </div>
                                </td>
                                @foreach ($item->planificacionModulos as $i)
                                    @if ($i->modulo_id == $modulo_id)
                                        <td class="table-tail-td">
                                            <div class="text-sm text-gray-900">
                                                {{ $i->fecha_fin == null ? 'Sin fecha asignada' : $i->fecha_fin}}
                                            </div>
                                        </td>
                                        <td class="table-tail-td flex justify-evenly items-start">
                                            <a href="{{ route('admin.pagos.inscritos.planificacion', $i->id) }}"
                                                data-toggle="tooltip" data-placement="left" title="Ver Estado de Pagos">
                                                <svg class="h-6 w-6 text-green-500  font-bold"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.notas.inscritos.planificacion', $i->id) }}"
                                                data-toggle="tooltip" data-placement="left" title="Ver Registro de Notas">
                                                <svg class="h-6 w-6 text-indigo-500 font-bold" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                </svg>
                                            </a>
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                </tbody>
            </table>
            @else
                <div class="py-3">
                    @if ($carrera_id == '' && $modulo_id == '')
                        <p class="text-blue-500 font-bold text-sm text-center no-encontrado">Seleccione algún criterio para la búsqueda</p>
                    @else
                        <p class="text-red-500 font-bold text-sm text-center no-encontrado">No existen registros en la base de datos que coincidan esos criterios</p>
                    @endif
                </div>
            @endif
    </div>
</div>

