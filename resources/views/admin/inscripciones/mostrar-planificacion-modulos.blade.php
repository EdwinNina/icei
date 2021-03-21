<x-jet-dialog-modal wire:model="modalShowVisible">
    <x-slot name="title">Modulos Asignados</x-slot>

    <x-slot name="content">
        @if (!is_null($planificacionModulos))
        @if (count($planificacionModulos)>0)
            <div class="shadow-sm overflow-hidden border-b rounded border-gray-200 sm:rounded-lg">
                <div class="table-responsive">
                    <table class="table-tail">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="table-tail-th">Módulos</th>
                                <th class="table-tail-th text-center">Horas Academicas</th>
                                <th class="table-tail-th text-center">Fecha de Inicio</th>
                                <th class="table-tail-th text-center">Fecha de Finalizacion</th>
                                <th class="table-tail-th">Observaciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($planificacionModulos as $item)
                                <tr>
                                    <td class="text-xs px-2 py-1">{{ Str::camel(mb_strtolower(Str::substr($item->modulo->titulo, 0, 45))) }}</td>
                                    <td class="text-xs text-center px-2 py-1">{{$item->modulo->cargaHoraria }} horas</td>
                                    <td class="text-xs text-center px-2 py-1 {{ $item->fecha_inicio <= \Carbon\Carbon::now()->format('Y-m-d') ? 'text-red-500 line-through' : ''}}">
                                        {{$item->fecha_inicio}}
                                    </td>
                                    <td class="text-xs text-center px-2 py-1">{{$item->fecha_fin}}</td>
                                    <td class="text-xs text-center px-2 py-1">{{$item->observaciones}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
                <p class="text-center text-red-500">Esta planificacion aún no asigno una planificacion de módulos</p>
            @endif
        @endif
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('modalShowVisible',false)" >Volver</x-jet-secondary-button>
    </x-slot>
</x-jet-dialog-modal>
