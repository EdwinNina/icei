<div class="p-6">
    <div class="flex items-center justify-between my-5">
        @include('components.search')

        <x-jet-button wire:click="create()" wire:loading.attr="disabled">Crear</x-jet-button>
    </div>

    @include('admin.usuarios.form')
    @include('admin.usuarios.form-role')

    @include('components.delete-modal')

    <div class="shadow-sm border-b overflow-hidden rounded border-gray-200 sm:rounded-lg">
        <div class="table-responsive">
            <table class="table-tail">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="table-tail-th">Usuario</th>
                        <th scope="col" class="table-tail-th">Correo electronico</th>
                        <th scope="col" class="table-tail-th">Rol en el Sistema</th>
                        <th scope="col" class="table-tail-th">Acciones</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($usuarios as $index => $item)
                            <tr class="text-gray-700">
                                <td class="table-tail-td">{{ $item->name }}</td>
                                <td class="table-tail-td">{{ $item->email }}</td>
                                <td class="table-tail-td">
                                    @foreach ($item->getRoleNames() as $role)
                                        <span class="text-green-600 mr-3">{{$role}}</span>
                                    @endforeach
                                </td>
                                <td class="table-tail-td text-right font-medium">
                                    <div class="flex items-center justify-start">
                                        <a href="#" wire:click.prevent="edit({{$item->id}})"
                                            class=" flex justify-center items-center mx-auto bg-yellow-500 rounded-full w-7 h-7 hover:bg-yellow-600 transition-all">
                                            @include('components.edit-icon')
                                        </a>
                                        <a href="#" wire:click.prevent="addRole({{$item->id}})"
                                            class=" flex justify-center items-center mx-auto bg-green-500 rounded-full w-7 h-7 hover:bg-green-600 transition-all">
                                            @include('components.user-icon')
                                        </a>
                                        <a href="#" wire:click.prevent="openDelete({{$item->id}})"
                                            class=" flex justify-center items-center mx-auto bg-red-500 rounded-full w-7 h-7 hover:bg-red-600 transition-all">
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
            {{ $usuarios->links() }}
        </div>
    </div>
</div>

