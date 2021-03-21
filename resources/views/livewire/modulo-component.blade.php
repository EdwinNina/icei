<div class="p-6">
    <div class="flex items-center justify-between py-3">
        @include('components.search')
        <a href="{{ route('admin.modulos.create') }}" class="btn focus:shadow-outline-gray bg-gray-800 focus:border-gray-900 hover:bg-gray-700 active:bg-gray-900">{{ __('Crear') }}</a>
    </div>

    @include('components.delete-modal')
    @include('admin.modulos.show')

    <div class="shadow-sm overflow-hidden border-b rounded border-gray-200 sm:rounded-lg">
        <div class="table-responsive">
            <table class="table-tail">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="table-tail-th">Version</th>
                        <th scope="col" class="table-tail-th">Titulo</th>
                        <th scope="col" class="table-tail-th">Carga Horaria</th>
                        <th scope="col" class="table-tail-th">Curso</th>
                        <th scope="col" class="table-tail-thr">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($modulos as $item)
                        <tr>
                            <td class="table-tail-td w-5">
                                <div class="text-sm text-center text-gray-900">{{ $item->version }}</div>
                            </td>
                            <td class="table-tail-td w-80">
                                <div class="text-sm text-gray-900">{{ Str::substr($item->titulo, 0, 45) }} </div>
                            </td>
                            <td class="table-tail-td w-10">
                                <div class="text-sm text-gray-900">{{ $item->cargaHoraria }} Horas</div>
                            </td>
                            <td class="table-tail-td w-48">
                                <div class="text-sm text-gray-900">{{ $item->carrera->titulo }}</div>
                            </td>
                            <td class="table-tail-td text-right text-sm font-medium w-24">
                                <div class="flex items-center justify-center">
                                    <a href="{{ route('admin.modulos.edit', $item ) }}">
                                        @include('components.edit-icon')
                                    </a>
                                    <a href="#" wire:click.prevent="openModalShow({{$item}})">
                                        @include('components.show-icon')
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
    <div class="py-4">
        {{ $modulos->links() }}
    </div>
</div>

