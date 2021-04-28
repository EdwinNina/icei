<div class="p-6">
    @if (session('message'))
        <div class="bg-green-500 border-l-4 px-5 py-2 rounded mb-3 border-green-600">
            <span class="text-white text-center">{{session('message')}}</span>
        </div>
    @endif
    <div class="flex items-center justify-between py-3">
        @include('components.search')
        <a href="{{ route('admin.planificacionTaller.create') }}"
            class="btn bg-gray-800 focus:border-gray-900 hover:bg-gray-700 hover:text-white">Nuevo</a>
    </div>
    <div class="flex items-center justify-between my-3 bg-gray-100 px-2 py-2 rounded-lg">
        <h3 class="text-gray-500 uppercase text-sm font-semibold w-full">Estado de los Registros:</h3>
        <div class="flex">
            <select class="custom-select sm:text-sm w-auto" wire:model="estado">
                <option value="" selected>-- Seleccionar --</option>
                <option value="1">Activos</option>
                <option value="0">Cancelados</option>
            </select>
            <a href="" wire:click.prevent="$set('estado','')"
            class="p-2 bg-purple-600 text-white flex justify-center items-center rounded-md shadow-md hover:bg-purple-700 ml-4 mt-1">
                <svg class="h-5 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </a>
        </div>
    </div>

    <div class="shadow-sm overflow-hidden border-b rounded border-gray-200 sm:rounded-lg">
        @if (count($planificaciones))
            <div class="table-responsive">
                <table class="table-tail">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="text-xs font-medium pl-2 text-gray-500 uppercase text-center w-40">Titulo</th>
                            <th scope="col" class="table-tail-th w-20 text-center">Costo (Bs)</th>
                            <th scope="col" class="table-tail-th text-center">Horario</th>
                            <th scope="col" class="table-tail-th text-center">Docente</th>
                            <th scope="col" class="table-tail-th text-center">Cancelar</th>
                            <th scope="col" class="table-tail-th text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($planificaciones as $index => $item)
                            <tr class="text-gray-700 text-center">
                                <td class="w-40 pl-4 pb-2">
                                    <div class="text-sm text-gray-900">
                                        {{ Str::title($item->taller->nombre)}}
                                    </div>
                                </td>
                                <td class="table-tail-td w-16">{{ $item->costo}}</td>
                                <td class="table-tail-td">
                                    <div class="text-sm text-gray-900">
                                        {{  Str::title($item->horario->dias) }}
                                    </div>
                                </td>
                                <td>
                                    <div class="text-sm text-gray-900">
                                        {{ $item->docente->nombre_completo}}
                                    </div>
                                </td>
                                <td class="w-28 text-center">
                                    <div class="custom-control ml-3 custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="deshabilitarRegistro_{{$index}}"
                                        name="deshabilitarRegistro"
                                        value="{{$item->estado}}"
                                        {{$item->estado == "0" ? 'checked' : ''}}
                                        data-id="{{$item->id}}">
                                        <label  class="custom-control-label uppercase" for="deshabilitarRegistro_{{$index}}"></label>
                                    </div>
                                </td>
                                <td class="table-tail-td font-medium">
                                    <div class="flex items-center justify-evenly">
                                        <a href="{{ route('admin.planificacionTaller.edit', $item) }}"
                                            class="flex justify-center items-center mx-auto bg-yellow-500 rounded-full w-7 h-7 hover:bg-yellow-600 transition-all">
                                            @include('components.edit-icon')
                                        </a>
                                        <a href="{{ route('admin.planificacionTaller.show', $item) }}"
                                            class="flex justify-center items-center mx-auto bg-blue-500 rounded-full w-7 h-7 hover:bg-blue-600 transition-all">
                                            @include('components.eye-icon')
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="flex justify-center my-4 items-center">
                <span class="font-bold text-red-500 uppercase">No existen planificaciones cerradas</span>
            </div>
        @endif
    </div>
    <div class="py-4">
        {{ $planificaciones->links() }}
    </div>
</div>
