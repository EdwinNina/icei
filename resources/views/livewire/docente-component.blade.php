<div class="p-6">
    <div class="flex items-center justify-between py-3">
        @include('components.search')
        <x-jet-button wire:click="create()">
            {{ __('Crear') }}
        </x-jet-button>
    </div>

    @include('admin.docentes.form')
    @include('components.form-user')
    @include('components.delete-modal')

    <div class="shadow-sm overflow-hidden border-b rounded border-gray-200 sm:rounded-lg">
        <div class="table-responsive">
            <table class="table-tail">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="table-tail-th">Cedula</th>
                        <th scope="col" class="table-tail-th">Nombre</th>
                        <th scope="col" class="table-tail-th">Paterno</th>
                        <th scope="col" class="table-tail-th">Materno</th>
                        <th scope="col" class="table-tail-th">Email</th>
                        <th scope="col" class="table-tail-th">Celular</th>
                        <th scope="col" class="table-tail-thr text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($docentes as $item)
                        <tr>
                            <td class="table-tail-td">
                                <div class="text-sm text-gray-900">{{ $item->carnet }} {{ $item->expedido }}</div>
                            </td>
                            <td class="table-tail-td">
                                <div class="text-sm text-gray-900">{{ $item->nombre }}</div>
                            </td>
                            <td class="table-tail-td">
                                <div class="text-sm text-gray-900">{{ $item->paterno }}</div>
                            </td>
                            <td class="table-tail-td">
                                <div class="text-sm text-gray-900">{{ $item->materno }}</div>
                            </td>
                            <td class="table-tail-td">
                                <div class="text-sm text-gray-900">{{$item->email}}</div>
                            </td>
                            <td class="table-tail-td">
                                <div class="text-sm text-gray-900">{{$item->celular}}</div>
                            </td>
                            <td class="table-tail-td  text-sm font-medium">
                                <div class="flex items-center justify-evenly">

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
    <div class="py-4">
        {{ $docentes->links() }}
    </div>
</div>
