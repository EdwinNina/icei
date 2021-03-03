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
                <p class="text-red-400 text-center mt-4 font-bold">No existe registros con {{$search}}</p>
            @endif
        </div>
    @endif
    {{-- <script>
        document.addEventListener('DOMContentLoaded', () => {
            let inputs = document.getElementsByClassName('codigo');
            let codigo = document.getElementById('codigo');

            const crearCodigo = () => {
                for (let input of inputs) {
                    input.addEventListener('blur', () => {
                        console.log(input.value);
                        (input.getAttribute('id') === 'carnet')
                            ? codigo.value += input.value
                            : codigo.value += input.value[0]
                    });
                }
            };
            crearCodigo();
        });
    </script> --}}

</div>
