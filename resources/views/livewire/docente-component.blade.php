<div class="p-6">
    <div class="flex items-center justify-between px-4 py-3 sm:px-6">
        @include('components.search')
        <x-jet-button wire:click="create()">
            {{ __('Crear') }}
        </x-jet-button>
    </div>

    @include('admin.docentes.form')
    @include('components.form-user')
    @include('components.delete-modal')

    <div class="flex flex-col my-4 px-4 sm:px-6">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="table">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="table-th">Cedula</th>
                            <th scope="col" class="table-th">Nombre</th>
                            <th scope="col" class="table-th">Paterno</th>
                            <th scope="col" class="table-th">Materno</th>
                            <th scope="col" class="table-th">Email</th>
                            <th scope="col" class="table-th">Celular</th>
                            <th scope="col" class="table-thr">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($docentes as $item)
                                <tr>
                                    <td class="table-td">
                                        <div class="text-sm text-gray-900">{{ $item->carnet }} {{ $item->expedido }}</div>
                                    </td>
                                    <td class="table-td">
                                        <div class="text-sm text-gray-900">{{ $item->nombre }}</div>
                                    </td>
                                    <td class="table-td">
                                        <div class="text-sm text-gray-900">{{ $item->paterno }}</div>
                                    </td>
                                    <td class="table-td">
                                        <div class="text-sm text-gray-900">{{ $item->materno }}</div>
                                    </td>
                                    <td class="table-td">
                                        <div class="text-sm text-gray-900">{{$item->email}}</div>
                                    </td>
                                    <td class="table-td">
                                        <div class="text-sm text-gray-900">{{$item->celular}}</div>
                                    </td>
                                    <td class="table-td text-right text-sm font-medium">
                                        <div class="flex items-center justify-center">

                                        <a href="#" wire:click.prevent="edit({{$item->id}})">
                                            @include('components.edit-icon')
                                        </a>

                                        <a href="" wire:click.prevent="openModalUser({{$item}})">
                                            @include('components.user-icon')
                                        </a>
                                        <a href="#" wire:click.prevent="openDelete({{$item->id}})">
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
            {{ $docentes->links() }}
        </div>
    </div>
</div>
