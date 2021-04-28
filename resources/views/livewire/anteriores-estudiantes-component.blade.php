<div>
    <div class="p-4">
        <div class="flex justify-end my-3">
            <button wire:click="$set('modalFormVisible',true)"
                class="btn bg-green-800 focus:border-green-900 hover:bg-green-700 items-center justify-center">
                Importar
            </button>
        </div>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <x-jet-input type="search" wire:model.debounce.200ms="searchPaterno" placeholder="Buscar por Paterno...." />
            <x-jet-input type="search" wire:model.debounce.200ms="searchMaterno" placeholder="Buscar por Materno...." />
            <x-jet-input type="search" wire:model.debounce.200ms="searchNombre" placeholder="Buscar por Nombre...." />
        </div>
        @include('admin.anterioresEstudiantes.excelForm')
        <div class="shadow-sm overflow-hidden mt-3 border-b rounded border-gray-200 sm:rounded-lg">
            <div class="table-responsive">
                <table class="table-tail">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="table-tail-th">Paterno</th>
                            <th scope="col" class="table-tail-th">Materno</th>
                            <th scope="col" class="table-tail-th">Nombre</th>
                            <th scope="col" class="table-tail-th">Carrera</th>
                            <th scope="col" class="w-20">Módulo</th>
                            <th scope="col" class="w-20">Nota</th>
                            <th scope="col" class="table-tail-th">Docente</th>
                            <th scope="col" class="table-tail-th">Fecha inicio</th>
                            <th scope="col" class="table-tail-th">Fecha fin</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($estudiantes as $index => $item)
                            <tr>
                                <td class="table-tail-td">
                                    <div class="text-sm text-gray-900">{{ Str::ucfirst($item->paterno)  }}</div>
                                </td>
                                <td class="table-tail-td">
                                    <div class="text-sm text-gray-900">{{ Str::ucfirst($item->materno) }}</div>
                                </td>
                                <td class="table-tail-td">
                                    <div class="text-sm text-gray-900">{{ Str::title($item->nombre)  }}</div>
                                </td>
                                <td class="table-tail-td">
                                    <div class="text-sm text-gray-900">{{ Str::title($item->carrera)  }}</div>
                                </td>
                                <td class="w-20">
                                    <div class="text-sm text-gray-900">{{ Str::title($item->modulo)  }}</div>
                                </td>
                                <td class="w-20">
                                    <div class="text-sm text-gray-900">{{ Str::title($item->nota) }}</div>
                                </td>
                                <td class="table-tail-td">
                                    <div class="text-sm text-gray-900">{{ Str::title($item->docente) }}</div>
                                </td>
                                <td class="table-tail-td">
                                    <div class="text-sm text-gray-900">{{ Str::title($item->fecha_inicio) }}</div>
                                </td>
                                <td class="table-tail-td">
                                    <div class="text-sm text-gray-900">{{ Str::title($item->fecha_fin) }}</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="py-3">
            {{$estudiantes->links()}}
        </div>
    </div>
</div>
