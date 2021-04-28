<div>
    <div class="flex justify-between items-center p-6 bg-gray-50">
        <x-jet-label value="Filtrar Por Carrera" />
        <select id="" class="custom-select w-auto sm:text-sm" wire:model="carrera_id">
            <option value="" selected>Seleccionar</option>
            @foreach ($carreras as $carrera)
                <option value="{{$carrera->id}}">{{$carrera->titulo}}</option>
            @endforeach
        </select>
    </div>
    <div class="mt-4">
        <div class="rounded p-6">
            <div class="table-responsive">
                <table class="table-tail">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="table-tail-th">Carrera</th>
                            <th scope="col" class="table-tail-th">Módulo</th>
                            <th scope="col" class="table-tail-th text-center">Docente</th>
                            <th scope="col" class="table-tail-th text-center">Gestión</th>
                            <th scope="col" class="table-tail-th text-center">Nota Final</th>
                            <th scope="col" class="table-tail-th text-center">Estado</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 relative">
                        @foreach ($cursos as $curso)
                            <tr>
                                <td class="table-tail-td">
                                    <div class="text-sm text-gray-900">{{ Str::title($curso->planificacionCarrera->carrera->titulo) }}</div>
                                </td>
                                <td class="table-tail-td">
                                    <div class="text-sm text-gray-900" data-toggle="tooltip" data-placement="top" title="{{$curso->modulo->titulo_completo}}">
                                        {{ Str::substr($curso->modulo->titulo_completo, 0, 30) . '...' }}
                                    </div>
                                </td>
                                <td class="table-tail-td text-center">
                                    <div class="text-sm text-gray-900">
                                        {{Str::title($curso->planificacionCarrera->docente->nombre)}} {{Str::ucfirst($curso->planificacionCarrera->docente->paterno)}}
                                    </div>
                                </td>
                                <td class="table-tail-td text-center">
                                    <div class="text-sm text-gray-900">{{$curso->planificacionCarrera->gestion}}</div>
                                </td>
                                @foreach ($estudiante->notas as $nota)
                                    @if ($nota->planificacionModulo->modulo_id === $curso->modulo_id)
                                        <td class="table-tail-td text-center">
                                            <div class="text-sm text-gray-900">{{$nota->nota_final}}</div>
                                        </td>
                                        <td class="table-tail-td text-center">
                                            <div class="text-sm text-gray-900">{{$nota->estado == 1 ? 'Aprobado' : 'Reprobado'}}</div>
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
