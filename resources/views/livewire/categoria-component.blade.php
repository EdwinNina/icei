<div class="p-6">
    <div class="flex items-center justify-between py-3">
        @include('components.search')

        <x-jet-button wire:click="create()">
            {{ __('Crear') }}
        </x-jet-button>
    </div>

    @include('admin.categorias.form')

    @include('components.delete-modal')

        <div class="shadow-sm overflow-hidden border-b rounded border-gray-200 sm:rounded-lg">
            <div class="table-responsive">
                <table class="table-tail">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="table-tail-th">Titulo</th>
                            <th scope="col" class="table-tail-th">Slug</th>
                            <th scope="col" class="table-tail-th">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($categorias as $item)
                            <tr class="text-gray-700">
                                <td class="table-tail-td">{{ $item->nombre }}
                                </td>
                                <td class="table-tail-td">{{ $item->slug }}
                                </td>
                                <td class="table-tail-td">
                                    <div class="flex items-center justify-start">
                                        <a href="#" wire:click.prevent="edit({{$item->id}})">
                                            @include('components.edit-icon')
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
            {{ $categorias->links() }}
        </div>
    </div>
</div>

