<div class="p-6">
    <div class="flex items-center justify-between py-3 ">
        @include('components.search')
        <a href="{{ route('admin.carreras.create') }}" class="btn bg-gray-800 focus:border-gray-900 hover:bg-gray-700">Nuevo</a>
    </div>
        @include('admin.carreras.show')
        @include('components.delete-modal')

    <div class="shadow-sm overflow-hidden border-b rounded border-gray-200 sm:rounded-lg">
        <div class="table-responsive">
            <table class="table-tail">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="table-tail-th">Titulo</th>
                    <th scope="col" class="table-tail-th">Carga Horaria</th>
                    <th scope="col" class="table-tail-th">Portada</th>
                    <th scope="col" class="table-tail-th">Categoria</th>
                    <th scope="col" class="table-tail-thr">Actions</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($carreras as $item)
                        <tr>
                            <td class="table-tail-td">
                                <div class="text-sm text-gray-900">{{ $item->titulo }}</div>
                            </td>
                            <td class="table-tail-td">
                                <div class="text-sm text-gray-900">{{ $item->cargaHoraria }} horas</div>
                            </td>
                            <td class="table-tail-td">
                                <a href="{{ Storage::url('carreraPortadas/' . $item->portada) }}" data-lightbox="image-1">
                                    <img src="{{ Storage::url('carreraPortadas/' . $item->portada) }}"
                                        class="h-10 w-10 rounded-full ring-2 ring-gray-400 object-cover object-center">
                                </a>
                            </td>
                            <td class="table-tail-td">
                                <div class="text-sm text-gray-900">{{ $item->categoria->nombre }}</div>
                            </td>
                            <td class="table-tail-td">
                                <div class="flex items-center justify-start">
                                    <a href="{{ route('admin.carreras.edit', $item) }}">
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
        {{ $carreras->links() }}
    </div>
</div>
