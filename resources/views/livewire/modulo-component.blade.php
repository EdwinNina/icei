@section('styles')
    <link rel="stylesheet" href="{{ asset('css/lightbox.min.css') }}">
@endsection

<div class="p-6">
    <div class="flex items-center justify-between px-4 py-3 sm:px-6">
        @include('components.search')
        <a href="{{ route('admin.modulo.create') }}" class="btn focus:shadow-outline-gray bg-gray-800 focus:border-gray-900 hover:bg-gray-700 active:bg-gray-900">{{ __('Crear') }}</a>
    </div>

    @include('components.delete-modal')
    @include('admin.modulos.show')

    <div class="flex flex-col my-4 px-4 sm:px-6">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="table">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="table-th">Version</th>
                            <th scope="col" class="table-th">Titulo</th>
                            <th scope="col" class="table-th">Carga Horaria</th>
                            <th scope="col" class="table-th">Curso</th>
                            <th scope="col" class="table-th">Portada</th>
                            <th scope="col" class="table-thr">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($modulos as $item)
                                <tr>
                                    <td class="table-td w-5">
                                        <div class="text-sm text-center text-gray-900">{{ $item->version }}</div>
                                    </td>
                                    <td class="table-td w-80">
                                        <div class="text-sm text-gray-900">{{ Str::substr($item->titulo, 0, 45) }} </div>
                                    </td>
                                    <td class="table-td w-10">
                                        <div class="text-sm text-gray-900">{{ $item->cargaHoraria }} Horas</div>
                                    </td>
                                    <td class="table-td w-48">
                                        <div class="text-sm text-gray-900">{{ $item->carrera->titulo }}</div>
                                    </td>
                                    <td class="table-td w-16 text-center">
                                        <a href="{{ Storage::url('moduloPortadas/' . $item->portada) }}" data-lightbox="image-1">
                                            <img src="{{ Storage::url('moduloPortadas/' . $item->portada) }}"
                                                class="h-10 w-10 rounded-full ring-2 ring-gray-400 object-cover object-center">

                                        </a>
                                    </td>
                                    <td class="table-td text-right text-sm font-medium w-24">
                                        <div class="flex items-center justify-center">
                                            <a href="{{ route('admin.modulo.edit', $item ) }}">
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
            {{ $modulos->links() }}
        </div>
    </div>
</div>

@section('scripts')
    <script src="{{ asset('js/lightbox-plus-jquery.min.js') }}"></script>
@endsection
