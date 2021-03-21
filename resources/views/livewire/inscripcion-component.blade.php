@if ($opcion == 'crear')
    @include('admin.inscripciones.form')
@elseif($opcion == 'editar')
    @include('admin.inscripciones.form')
@elseif($opcion == 'listado')
    <div class="p-6">
        <div class="flex items-center justify-between py-3">
            @include('components.search')
            <div>
                <x-jet-button wire:click.refresh="create()" >Nuevo</x-jet-button>
            </div>
        </div>

        @include('components.delete-modal')

        <div class="shadow-sm overflow-hidden border-b rounded border-gray-200 sm:rounded-lg">
            <div class="table-responsive">
                <table class="table-tail">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="table-tail-th">Estudiante</th>
                        <th scope="col" class="table-tail-th">Carrera</th>
                        <th scope="col" class="table-tail-th">Horario</th>
                        <th scope="col" class="table-tail-th">Estado</th>
                        <th scope="col" class="table-tail-th">Fecha</th>
                        <th scope="col" class="table-tail-thr text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($inscripciones as $item)
                            <tr>
                                <td class="table-tail-td">
                                    <div class="text-sm text-gray-900">
                                        {{ $item->estudiante->paterno }} {{ $item->estudiante->materno }} {{$item->estudiante->nombre}}
                                    </div>
                                </td>

                                <td class="table-tail-td">
                                    <div class="text-sm text-gray-900">{{ $item->modulo->carrera->titulo }}</div>
                                </td>
                                <td class="table-tail-td">
                                    <div class="text-sm text-gray-900">
                                        <div class="text-sm text-gray-900">
                                            {{ $item->planificacionCarrera->horario->dias }} / {{$item->planificacionCarrera->horario->hora_inicio}}-{{$item->planificacionCarrera->horario->hora_fin}}
                                        </div>
                                    </div>
                                </td>
                                <td class="table-tail-td">
                                    <div class="text-sm px-2 py-1 rounded-md text-gray-50
                                        {{$item->estado === '1' ? 'bg-green-600' : 'bg-red-600'}}">
                                        {{$item->estado === '1' ? 'Inscrito' : 'Anulado'}}
                                    </div>
                                </td>
                                <td class="table-tail-td">
                                    <div class="text-sm text-gray-900">{{ $item->created_at->format('d-M-Y')}}</div>
                                </td>
                                <td class="table-tail-td  text-sm font-medium">
                                    <div class="flex items-center justify-start">
                                        <a href="" wire:click.prevent="edit({{$item}})">
                                            @include('components.edit-icon')
                                        </a>
                                        @if ($item->estado === '1')
                                            <a href="" wire:click.prevent="openDelete({{$item->id}})">
                                                @include('components.delete-icon')
                                            </a>
                                        @else
                                            <a href="" wire:click.prevent="enableItem({{$item->id}})">
                                                <svg class="w-6 h-6 text-indigo-500 hover:text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                  </svg>
                                            </a>
                                        @endif
                                        <a href="{{route('admin.inscripciones.generarPDF', $item->id)}}">
                                            <svg class="w-6 h-6 text-green-500 hover:text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </a>
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
    </div>
@endif

