<div>
    @include('admin.inscripciones.mostrar-planificacion-modulos')
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div>
            <x-required-label for="carrera_id" value="Taller" />
            <select id="carrera_id" class="custom-select sm:text-sm" wire:model.defer="taller_id" required>
                <option value="" selected>-- Seleccionar taller --</option>
                @foreach ($talleres as $taller)
                    <option value="{{ $taller->id }}">{{Str::title($taller->nombre)}}</option>
                @endforeach
            </select>
            <x-jet-input-error for="carrera_id" class="mt-2" />
        </div>
        <div>
            <x-required-label for="horario_id" value="Horario" />
            <select id="horario_id" class="custom-select sm:text-sm" wire:model.defer="horario_id" required>
                <option value="" selected>-- Seleccionar horario --</option>
                @foreach ($horarios as $horario)
                    <option value="{{ $horario->id }}">
                        {{$horario->horario_completo}}
                    </option>
                @endforeach
            </select>
            <x-jet-input-error for="horario_id" class="mt-2" />
        </div>
        <div>
            <x-required-label for="modalidad_id" value="Modalidades" />
            <div class="flex items-start">
                <div class="flex-auto">
                    <select id="modalidad_id" class="custom-select sm:text-sm" wire:model.defer="modalidad_id" required>
                        <option value="" selected>-- Seleccionar modalidad --</option>
                        @foreach ($modalidades as $modalidad)
                            <option value="{{ $modalidad->id }}">{{$modalidad->nombre}}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="horario_id" class="mt-2" />
                </div>
                <a href="" wire:click.prevent="buscarPlanificacion()"
                    class="p-2 bg-green-600 text-white flex justify-center items-center rounded-md shadow-md hover:bg-green-700 ml-2 mt-1">
                    @include('components.search-icon')
                </a>
            </div>
        </div>
    </div>
    <div class="mt-3">
        @if (!is_null($planificaciones))
            @if (count($planificaciones) > 0)
                <div class="w-full bg-gray-50 rounded-md overscroll-auto overflow-y-scroll max-h-72">
                    <table class="table-tail">
                        <thead class="bg-gray-500">
                            <tr>
                                <th></th>
                                <th class="px-1 py-2 text-white text-center">Nombre</th>
                                <th class="px-1 py-2 text-white text-center">Costo (Bs)</th>
                                <th class="px-1 py-2 text-white text-center">Carga Horaria</th>
                                <th class="px-1 py-2 text-white text-center">Fecha Inicio</th>
                                <th class="px-1 py-2 text-white text-center">Fecha Fin</th>
                                <th class="px-1 py-2 text-white text-center">Duración</th>
                                <th class="px-1 py-2 text-white text-center">Docente</th>
                            </tr>
                        </thead>
                        <tbody class="p-2">
                            @foreach ($planificaciones as $item)
                                <tr>
                                    <td class="px-1 py-2 text-center">
                                        <x-jet-input type="radio"
                                            name="planificacion_taller_id"
                                            wire:model="planificacion_taller_id"
                                            value="{{$item->id}}" />
                                    </td>
                                    <td class="px-1 py-2 text-center">{{Str::title($item->taller->nombre)}}</td>
                                    <td class="px-1 py-2 text-center">{{$item->costo}}</td>
                                    <td class="px-1 py-2 text-center">{{$item->carga_horaria}}</td>
                                    <td class="px-1 py-2 text-center">{{$item->fecha_inicio->format('d-m-Y')}}</td>
                                    <td class="px-1 py-2 text-center">{{$item->fecha_fin->format('d-m-Y')}}</td>
                                    <td class="px-1 py-2 text-center">
                                        {{$item->duracion}} {{$item->duracion >= 2 ? 'días':'día'}}
                                    </td>
                                    <td class="px-1 py-2 text-center">{{Str::title($item->docente->nombre_completo)}}</td>
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
</div>
