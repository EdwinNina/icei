<div class="p-6">
    <div class="flex items-center justify-between py-3">
        @include('components.search')

        <x-jet-button wire:click="create()">Crear</x-jet-button>
    </div>

    @include('admin.tipoPlanPagos.form')

    @include('components.delete-modal')
    <div class="shadow-sm overflow-hidden border-b rounded border-gray-200 sm:rounded-lg">
        <div class="table-responsive">
            <table class="table-tail">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="table-tail-th">Titulo</th>
                                <th scope="col" class="table-tail-th">Descripcion</th>
                                <th scope="col" class="table-tail-th text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($tipoPlanPagos as $item)
                                <tr class="text-gray-700">
                                    <td class="table-tail-td">{{ $item->nombre }} </td>
                                    <td class="table-tail-td">{!! $item->descripcion !!} </td>
                                    <td class="table-tail-td text-right font-medium">
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
                        {{ $tipoPlanPagos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

