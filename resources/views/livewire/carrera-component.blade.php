<div class="p-6">
    <div class="flex items-center justify-between py-3 ">
        @include('components.search')
        <a href="{{ route('admin.carreras.create') }}"
            class="btn bg-gray-800 focus:border-gray-900 hover:text-white hover:bg-gray-700"
        >Nuevo</a>
    </div>

    @include('admin.carreras.show')

    <div class="shadow-sm overflow-hidden border-b rounded border-gray-200 sm:rounded-lg">
        <div class="table-responsive">
            <table class="table-tail">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="table-tail-th">Titulo</th>
                    <th scope="col" class="table-tail-th">Carga Horaria</th>
                    <th scope="col" class="table-tail-th">Portada</th>
                    <th scope="col" class="table-tail-th">Categoria</th>
                    @if (Auth::user()->roles()->first()->name == "Administrador")
                    <th scope="col" class="table-tail-th">Deshabilitar</th>
                    @endif
                    <th scope="col" class="table-tail-thr text-center">Actions</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($carreras as $index => $item)
                        <tr>
                            <td class="table-tail-td">
                                <div class="text-sm text-gray-900">{{ Str::title($item->titulo) }}</div>
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
                            @if (Auth::user()->roles()->first()->name == "Administrador")
                            <td class="table-tail-td">
                                    <div class="custom-control ml-3 custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="deshabilitarRegistro_{{$index}}"
                                        name="deshabilitarRegistro"
                                        data-id="{{$item->id}}"
                                        value="{{$item->estado}}"
                                        {{$item->estado == "0" ? 'checked' : ''}}>
                                        <label  class="custom-control-label uppercase" for="deshabilitarRegistro_{{$index}}"></label>
                                    </div>
                                </td>
                                @endif
                            <td class="table-tail-td">
                                <div class="flex items-center justify-start">
                                    <a href="{{ route('admin.carreras.edit', $item) }}"
                                        class="flex justify-center items-center mx-auto bg-yellow-500 rounded-full w-7 h-7 hover:bg-yellow-600 transition-all">
                                        @include('components.edit-icon')
                                    </a>
                                    <a href="#" wire:click.prevent="openModalShow({{$item}})"
                                        class="flex justify-center items-center mx-auto bg-indigo-500 rounded-full w-7 h-7 hover:bg-indigo-600 transition-all">
                                        @include('components.show-icon')
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
