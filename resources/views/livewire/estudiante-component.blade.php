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
                                    <th scope="col" class="table-tail-th text-center">Acciones</th>
                                </tr>
                            </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($estudiantes as $item)
                                        <tr>
                                            <td class="table-tail-td">
                                                <div class="text-sm text-gray-900">{{ $item->carnet }} {{ $item->expedido }}</div>
                                            </td>
                                            <td class="table-tail-td">
                                                <div class="text-sm text-gray-900">{{ $item->paterno }}</div>
                                            </td>
                                            <td class="table-tail-td">
                                                <div class="text-sm text-gray-900">{{ $item->materno}}</div>
                                            </td>
                                            <td class="table-tail-td">
                                                <div class="text-sm text-gray-900">{{ $item->nombre }}</div>
                                            </td>
                                            <td class="table-tail-td">
                                                <div class="text-sm text-gray-900">{{$item->celular}}</div>
                                            </td>
                                            <td class="table-tail-td text-right text-sm font-medium">
                                                <div class="flex items-center justify-center">
                                                    <a wire:click.prevent="edit({{$item}})" href="" class="mr-2">
                                                        @include('components.edit-icon')
                                                    </a>
                                                    <a href="" wire:click.prevent="openModalShow({{$item}})">
                                                        @include('components.show-icon')
                                                    </a>
                                                    <a href="" wire:click.prevent="openModalUser({{$item}})">
                                                        @include('components.user-icon')
                                                    </a>
                                                    <a href="{{ route('admin.estudiantes.modulosInscritos', $item->id) }}">
                                                        <svg class="h-6 w-6 text-purple-500 hover:text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" />
                                                            <path fill="#fff" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
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
