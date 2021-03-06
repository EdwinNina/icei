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
            <div class="flex items-center justify-between px-4 py-3 sm:px-6">
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
                <div class="flex flex-col my-4 px-4 sm:px-6">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="table">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="table-th">Cedula</th>
                                        <th scope="col" class="table-th">Paterno</th>
                                        <th scope="col" class="table-th">Materno</th>
                                        <th scope="col" class="table-th">Nombre</th>
                                        <th scope="col" class="table-th">Celular</th>
                                        <th scope="col" class="table-th">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($estudiantes as $item)
                                            <tr>
                                                <td class="table-td">
                                                    <div class="text-sm text-gray-900">{{ $item->carnet }} {{ $item->expedido }}</div>
                                                </td>
                                                <td class="table-td">
                                                    <div class="text-sm text-gray-900">{{ $item->paterno }}</div>
                                                </td>
                                                <td class="table-td">
                                                    <div class="text-sm text-gray-900">{{ $item->materno}}</div>
                                                </td>
                                                <td class="table-td">
                                                    <div class="text-sm text-gray-900">{{ $item->nombre }}</div>
                                                </td>
                                                <td class="table-td">
                                                    <div class="text-sm text-gray-900">{{$item->celular}}</div>
                                                </td>
                                                <td class="table-td text-right text-sm font-medium">
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
                                                        <a href="{{ route('admin.inscripciones.create', $item) }}" class="mr-2">
                                                            <svg class="h-6 w-6 text-purple-500 hover:text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
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
                    </div>
                    <div class="py-4">
                        {{ $estudiantes->links() }}
                    </div>
                </div>
            @else
                <p class="text-red-400 text-center mt-4 font-bold">No existen registros</p>
            @endif
        </div>
    @endif
</div>
