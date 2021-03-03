@section('styles')
    <link rel="stylesheet" href="{{ asset('css/lightbox.min.css') }}">
@endsection
<div class="p-6">
    <div class="flex items-center justify-between px-4 py-3 sm:px-6">
        @include('components.search')
        <a href="{{ route('admin.carrera.create') }}" class="btn bg-gray-800 focus:border-gray-900 hover:bg-gray-700">Nuevo</a>
    </div>
        @include('admin.carreras.show')
        @include('components.delete-modal')

    <div class="flex flex-col my-4 px-4 sm:px-6">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="table">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="table-th">Titulo</th>
                            <th scope="col" class="table-th">Carga Horaria</th>
                            <th scope="col" class="table-th">Portada</th>
                            <th scope="col" class="table-th">Categoria</th>
                            <th scope="col" class="table-thr">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($carreras as $item)
                                <tr>
                                    <td class="table-td">
                                        <div class="text-sm text-gray-900">{{ $item->titulo }}</div>
                                    </td>
                                    <td class="table-td">
                                        <div class="text-sm text-gray-900">{{ $item->cargaHoraria }} horas</div>
                                    </td>
                                    <td class="table-td">
                                        <a href="{{ Storage::url('carreraPortadas/' . $item->portada) }}" data-lightbox="image-1">
                                            <img src="{{ Storage::url('carreraPortadas/' . $item->portada) }}"
                                                class="h-10 w-10 rounded-full ring-2 ring-gray-400 object-cover object-center">
                                        </a>
                                    </td>
                                    <td class="table-td">
                                        <div class="text-sm text-gray-900">{{ $item->categoria->nombre }}</div>
                                    </td>
                                    <td class="table-td text-right text-sm font-medium">
                                        <div class="flex items-center justify-center">
                                            <a href="{{ route('admin.carrera.edit', $item) }}">
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
        </div>
        <div class="py-4">
            {{ $carreras->links() }}
        </div>
    </div>
</div>
@section('scripts')
    <script src="{{ asset('js/lightbox-plus-jquery.min.js') }}"></script>
@endsection
