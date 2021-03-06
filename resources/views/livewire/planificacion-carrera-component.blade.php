<div class="p-6">
    <div class="flex items-center justify-between px-4 py-3 sm:px-6">
        @include('components.search')
        <x-jet-button wire:click="create()">Crear</x-jet-button>
    </div>

    @include('admin.planificacionCarrera.form')

    @include('components.delete-modal')
    <div class="flex flex-col my-4 px-4 sm:px-6">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="table">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="table-th">Código</th>
                                <th scope="col" class="table-th">Carrera</th>
                                <th scope="col" class="table-th">Modalidad</th>
                                <th scope="col" class="table-th">Costo Total</th>
                                <th scope="col" class="table-th">Costo Modular</th>
                                <th scope="col" class="table-th">Fecha Inicio</th>
                                <th scope="col" class="table-th">Fecha Fin</th>
                                <th scope="col" class="table-th text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($planificaciones as $item)
                                <tr class="text-gray-700 text-center">
                                    <td class="px-4 py-3 text-sm">{{ $item->codigo }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $item->carrera->titulo }}</td>
                                    <td class="px-4 py-3 text-sm">{{ ucwords($item->modalidad) }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $item->costo_carrera }} Bs</td>
                                    <td class="px-4 py-3 text-sm">{{ $item->costo_modulo }} Bs</td>
                                    <td class="px-4 py-3 text-sm">{{ $item->fecha_inicio }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $item->fecha_fin }}</td>
                                    <td class="px-4 py-3 text-sm text-right font-medium">
                                        <div class="flex items-center justify-center">
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
        </div>
        <div class="py-4">
            {{ $planificaciones->links() }}
        </div>
    </div>
</div>


