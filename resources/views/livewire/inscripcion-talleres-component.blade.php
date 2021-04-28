<div class="p-6">
    <div class="flex items-center justify-between py-3">
        @include('components.search')
        <div>
            <a href="{{ route('admin.inscripcionesTalleres.create') }}"
            class="btn bg-gray-800 focus:border-gray-900 hover:bg-gray-700 hover:text-white">Nuevo</a>
        </div>
    </div>
    @include('components.delete-modal')

    @if (count($inscripciones) > 0)
        <div class="shadow-sm border-b overflow-hidden rounded border-gray-200 sm:rounded-lg">
            <div class="table-responsive">
                <table class="table-tail">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="table-tail-th">Nombre del Estudiante</th>
                        <th scope="col" class="text-xs font-medium text-gray-500 uppercase w-40">Nombre del Taller</th>
                        <th scope="col" class="table-tail-th text-center">Horario</th>
                        <th scope="col" class="table-tail-th text-center">Estado</th>
                        <th scope="col" class="table-tail-thr text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 relative">
                        @foreach ($inscripciones as $index => $item)
                            <tr>
                                <td class="table-tail-td">
                                    <div class="text-sm text-gray-900">{{ $item->estudiante->nombre_completo }}</div>
                                </td>
                                <td class="w-40 pb-2">
                                    <div class="text-sm text-gray-900">{{ Str::title($item->planificacionTaller->taller->nombre) }}</div>
                                </td>
                                <td class="table-tail-td text-center">
                                    <div class="text-sm text-gray-900">
                                        {{  Str::title($item->planificacionTaller->horario->dias) }}
                                    </div>
                                    <div class="text-sm text-gray-900">
                                        {{$item->planificacionTaller->horario->hora_inicio->format('H:i')}}
                                        {{$item->planificacionTaller->horario->hora_fin->format('H:i')}}
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
                                        @foreach ($item->pagosInscripcionTaller as $index => $pago)
                                            @if ($index === count($item->pagosInscripcionTaller) - 1)
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
                                        <a href="{{ route('admin.inscripcionesTalleres.edit', $item) }}"
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
            <p class="text-red-400 text-center mt-4 font-bold">No existen registros en la base de datos</p>
        @endif
</div>

