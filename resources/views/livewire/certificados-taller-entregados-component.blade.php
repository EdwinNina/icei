<div class="w-full">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h1 class="text-gray-500 uppercase text-2xl mt-1 mb-3 text-center">Certificados de Talleres Entregados</h1>
        <div class="flex items-center justify-between py-3">
            @include('components.search')
        </div>
        <div class="flex justify-between items-center">
            <label>Buscar por fechas</label>
            <div class="flex items-center">
                <div class="mx-3">
                    <x-jet-label value="Fecha Inicio" />
                    <x-jet-input type="date" wire:model.defer="fecha_de" />
                </div>
                <div>
                    <x-jet-label value="Fecha Fin" />
                    <x-jet-input type="date" wire:model.delay.1000ms="fecha_hasta" />
                </div>
                <div class="flex-1 mt-4">
                    <a href="" wire:click.prevent="limpiarFiltro()"
                    class="p-2 flex items-center bg-purple-600 text-white rounded-md shadow-md hover:bg-purple-700 ml-4 mt-1">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="shadow-sm border-b my-4 overflow-hidden rounded border-gray-200 sm:rounded-lg">
            <div class="table-responsive">
                <table class="table-tail">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="table-tail-th">Nombre del Estudiante</th>
                        <th scope="col" class="table-tail-th">Entregado a</th>
                        <th scope="col" class="table-tail-th text-center">Fecha Solicitado</th>
                        <th scope="col" class="table-tail-th text-center">Fecha Entrega</th>
                        <th scope="col" class="table-tail-th text-center">Estado</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 relative">
                        @if ($entregados->count())
                            @foreach ($entregados as $index => $item)
                                <tr>
                                    <td class="table-tail-td">
                                        <div class="text-sm text-gray-900">{{$item->estudiante->nombre_completo}}</div>
                                    </td>
                                    <td class="table-tail-td">
                                        <div class="text-sm text-gray-900">
                                            {{ Str::title($item->entregado_a) }}
                                        </div>
                                    </td>
                                    <td class="table-tail-td text-center">
                                        <div class="text-sm text-gray-900">{{\Carbon\Carbon::parse($item->fecha_solicitado)->translatedFormat('d F Y')}}</div>
                                    </td>
                                    <td class="table-tail-td text-center">
                                        <div class="text-sm text-gray-900">{{\Carbon\Carbon::parse($item->fecha_entregado)->translatedFormat('d F Y')}}</div>
                                    </td>
                                    <td class="table-tail-td text-center">
                                        <div class="text-sm text-gray-900">{{$item->estado == 1 ? 'Entregado': ''}}</div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="5">
                                <div class="flex justify-center py-3">
                                    <span class="text-red-500 font-bold">No existen registros</span>
                                </div>
                            </td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="py-2">
            {{ $entregados->links() }}
        </div>
    </div>
</div>
