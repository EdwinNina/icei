<div class="p-6">
    <div class="flex items-center justify-between px-4 py-3 sm:px-6">
        @include('components.search')

        <x-jet-button wire:click="create()">Crear</x-jet-button>
    </div>

    @include('admin.tipoPagos.form')

    @include('components.delete-modal')
    <div class="flex flex-col my-4 px-4 sm:px-6">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="table">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="table-th">Titulo</th>
                                <th scope="col" class="table-th">Descripcion</th>
                                <th scope="col" class="table-th text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($tipoPagos as $item)
                                <tr class="text-gray-700">
                                    <td class="px-4 py-3 text-sm">{{ $item->nombre }} </td>
                                    <td class="px-4 py-3 text-sm">{!! $item->descripcion !!} </td>
                                    <td class="px-4 py-3 text-sm text-right font-medium">
                                        <div class="flex items-center justify-start">
                                            <a href="#" wire:click.prevent="edit({{$item->id}})" wire:loading.attr="disabled">
                                                @include('components.edit-icon')
                                            </a>
                                            <a href="#" wire:click.prevent="openDelete({{$item->id}})" wire:loading.attr="disabled">
                                                @include('components.delete-icon')
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="py-4">
                        {{ $tipoPagos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

