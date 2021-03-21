<div class="p-6">
    @if (session('message'))
        <div class="bg-green-500 border-l-4 px-5 py-2 rounded mb-3 border-green-600">
            <span class="text-white text-center">{{session('message')}}</span>
        </div>
    @endif
    <div class="flex items-center justify-between py-3">
        @include('components.search')
        <a href="{{ route('admin.planificacionCarrera.create') }}" class="btn bg-gray-800 focus:border-gray-900 hover:bg-gray-700 hover:text-white">Nuevo</a>
    </div>

    @include('components.delete-modal')

    <div class="shadow-sm overflow-hidden border-b rounded border-gray-200 sm:rounded-lg">
        <div class="table-responsive">
            <table class="table-tail">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="table-tail-th">Código</th>
                        <th scope="col" class="table-tail-th">Carrera</th>
                        <th scope="col" class="table-tail-th">Modalidad</th>
                        <th scope="col" class="table-tail-th">Costo Total</th>
                        <th scope="col" class="table-tail-th">Costo Modular</th>
                        <th scope="col" class="table-tail-th">Horario</th>
                        <th scope="col" class="table-tail-th">Docente</th>
                        <th scope="col" class="table-tail-th">Estado</th>
                        <th scope="col" class="table-tail-th text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($planificaciones as $item)
                        <tr class="text-gray-700 text-center">
                            <td class="table-tail-td">{{ $item->codigo }}</td>
                            <td class="table-tail-td">{{ $item->carrera->titulo}}</td>
                            <td class="table-tail-td">{{ $item->modalidad->nombre}}</td>
                            <td class="table-tail-td">{{ $item->costo_carrera}}</td>
                            <td class="table-tail-td">{{ $item->costo_modulo}}</td>
                            <td class="table-tail-td">
                                {{ $item->horario->dias }} / {{$item->horario->hora_inicio}}-{{$item->horario->hora_fin}}
                            </td>
                            <td class="table-tail-td">{{ $item->docente->nombre}} {{ $item->docente->paterno}}</td>
                            <td class="table-tail-td">
                                <div class="text-sm px-2 py-1 rounded-md text-gray-50
                                    {{$item->estado === '1' ? 'bg-green-600' : 'bg-red-600'}}">
                                    {{$item->estado === '1' ? 'Activo' : 'Inactivo'}}
                                </div>
                            </td>
                            <td class="table-tail-td font-medium">
                                <div class="flex items-center justify-center">
                                    <a href="{{ route('admin.planificacionCarrera.edit', $item) }}">
                                        @include('components.edit-icon')
                                    </a>
                                    <a href="{{route('admin.planificacionModulo.create', $item)}}">
                                        <svg class="w-6 h-6 text-purple-500 hover:text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                          </svg>
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
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="py-4">
        {{ $planificaciones->links() }}
    </div>
</div>
