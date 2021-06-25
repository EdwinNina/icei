<div>
    @if ($opcion == 'crear')
        @include('admin.estudiantes.form')
    @elseif($opcion == 'editar')
        @include('admin.estudiantes.form')
    @elseif($opcion == 'listado')

        @include('admin.estudiantes.excelForm')
        @include('admin.estudiantes.show')
        @include('components.form-user')

        <div class="p-4">
            <div class="flex items-center justify-between py-3 ">
                @include('components.search')
                <div>
                    <button wire:click="openModal()"
                        class="btn bg-green-800 focus:border-green-900 hover:bg-green-700 items-center justify-center">
                        Importar
                    </button>
                    <button wire:click="create()"
                        class="btn bg-blue-800 focus:border-blue-900 hover:bg-blue-700 items-center justify-center">
                        Nuevo
                    </button>
                </div>
            </div>

            @include('components.delete-modal')

            @if (count($estudiantes) > 0)
                <div class="shadow-sm overflow-hidden border-b rounded border-gray-200 sm:rounded-lg">
                    <div class="table-responsive">
                        <table class="table-tail">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="table-tail-th">Cedula</th>
                                    <th scope="col" class="table-tail-th">Paterno</th>
                                    <th scope="col" class="table-tail-th">Materno</th>
                                    <th scope="col" class="table-tail-th">Nombre</th>
                                    <th scope="col" class="table-tail-th">Celular</th>
                                    @if (Auth::user()->roles()->first()->name == "Administrador")
                                    <th scope="col" class="table-tail-th">Deshabilitar</th>@endif
                                    <th scope="col" class="table-tail-th text-center">Acciones</th>
                                </tr>
                            </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($estudiantes as $index => $item)
                                        <tr>
                                            <td class="table-tail-td">
                                                <div class="text-sm text-gray-900">{{ $item->carnet }} {{ $item->expedido }}</div>
                                            </td>
                                            <td class="table-tail-td">
                                                <div class="text-sm text-gray-900">{{ Str::ucfirst($item->paterno)  }}</div>
                                            </td>
                                            <td class="table-tail-td">
                                                <div class="text-sm text-gray-900">{{ Str::ucfirst($item->materno) }}</div>
                                            </td>
                                            <td class="table-tail-td">
                                                <div class="text-sm text-gray-900">{{ Str::title($item->nombre)  }}</div>
                                            </td>
                                            <td class="table-tail-td">
                                                <div class="text-sm text-gray-900">{{$item->celular}}</div>
                                            </td>
                                            @if (Auth::user()->roles()->first()->name == "Administrador")
                                            <td class="table-tail-td">
                                                <div class="custom-control ml-3 custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="deshabilitarRegistro_{{$index}}"
                                                    name="deshabilitarRegistro"
                                                    value="{{$item->estado}}"
                                                    data-id="{{$item->id}}"
                                                    {{$item->estado == "0" ? 'checked' : ''}}>
                                                    <label  class="custom-control-label uppercase" for="deshabilitarRegistro_{{$index}}"></label>
                                                </div>
                                            </td>
                                            @endif
                                            <td class="table-tail-td text-right text-sm font-medium">
                                                <div class="flex items-center justify-center">
                                                    <a wire:click.prevent="edit({{$item}})" href=""
                                                    class=" flex justify-center items-center mx-auto bg-yellow-500 rounded-full w-7 h-7 hover:bg-yellow-600 transition-all">
                                                        @include('components.edit-icon')
                                                    </a>
                                                    <a href="" wire:click.prevent="openModalShow({{$item}})"
                                                        class="flex justify-center items-center mx-auto bg-blue-500 rounded-full w-7 h-7 hover:bg-blue-600 transition-all">
                                                        @include('components.show-icon')
                                                    </a>
                                                    <a href="" wire:click.prevent="openModalUser({{$item}})"
                                                        class="flex justify-center items-center mx-auto bg-green-500 rounded-full w-7 h-7 hover:bg-green-600 transition-all">
                                                        @include('components.user-icon')
                                                    </a>
                                                    <a href="{{ route('admin.estudiantes.modulosInscritos', $item->id) }}"
                                                        target="_blank"
                                                        class=" flex justify-center items-center mx-auto bg-purple-500 rounded-full w-7 h-7 hover:bg-purple-600 transition-all">
                                                        <svg class="text-white h-5 w-5" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                                        </svg>
                                                    </a>
                                                    <a href="" wire:click.prevent="openDelete({{$item->id}})">
                                                        @include('components.delete-icon')
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
                    {{ $estudiantes->links() }}
                </div>
            @else
                <p class="text-red-400 text-center mt-4 font-bold">No existen registros</p>
            @endif
        </div>
    @endif
</div>
