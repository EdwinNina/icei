<div class="p-6">
    <div class="flex items-center justify-between py-3">
        @include('components.search')
        <a href="{{ route('admin.modulos.create') }}"
            class="btn bg-gray-800 hover:text-white focus:border-gray-700 hover:bg-gray-700 active:bg-gray-900"
            >{{ __('Crear') }}</a>
    </div>
    <div class="flex items-center justify-between my-3 bg-gray-100 px-2 py-2 rounded-lg">
        <h3 class="text-gray-500 uppercase text-sm font-semibold w-full">Carreras:</h3>
        <div class="flex">
            <select class="custom-select sm:text-sm w-auto" wire:model="carrera_id">
                <option value="" selected>-- Seleccionar --</option>
                @foreach ($carreras as $item)
                    <option value="{{$item->id}}">{{Str::title($item->titulo)}}</option>
                @endforeach
            </select>
            <a href="" wire:click.prevent="$set('carrera_id','')"
            class="p-2 bg-purple-600 text-white flex justify-center items-center rounded-md shadow-md hover:bg-purple-700 ml-4 mt-1">
                <svg class="h-5 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </a>
        </div>
    </div>

    @include('admin.modulos.show')

    @if (count($modulos) > 0)
        <div class="shadow-sm overflow-hidden border-b rounded border-gray-200 sm:rounded-lg">
            <div class="table-responsive">
                <table class="table-tail">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="text-xs font-medium text-gray-500 uppercase text-center pl-2">Version</th>
                            <th scope="col" class="text-xs font-medium text-gray-500 uppercase text-center pl-2">Titulo</th>
                            <th scope="col" class="table-tail-th">Carga Horaria</th>
                            <th scope="col" class="table-tail-th">Curso</th>
                            @if (Auth::user()->roles()->first()->name == "Administrador")
                            <th scope="col" class="table-tail-th w-28">Deshabilitar</th>@endif
                            <th scope="col" class="table-tail-thr text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($modulos as $index => $item)
                            <tr>
                                <td class="w-3">
                                    <div class="text-sm text-center text-gray-900">{{ $item->version }}</div>
                                </td>
                                <td class="w-72">
                                    <div class="text-sm text-gray-900">{{ Str::ucfirst( Str::length($item->titulo) > 45 ? Str::substr($item->titulo, 0, 45) .'...' : $item->titulo) }}</div>
                                </td>
                                <td class="table-tail-td w-10">
                                    <div class="text-sm text-gray-900">{{ $item->cargaHoraria }} Horas</div>
                                </td>
                                <td class="table-tail-td w-48">
                                    <div class="text-sm text-gray-900">{{ Str::title( $item->carrera->titulo) }}</div>
                                </td>
                                @if (Auth::user()->roles()->first()->name == "Administrador")
                                <td class="table-tail-td w-28 text-center">
                                    <div class="custom-control ml-3 custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="deshabilitarRegistro_{{$index}}"
                                        name="deshabilitarRegistro"
                                        value="{{$item->estado}}"
                                        data-id="{{$item->id}}"
                                        {{$item->estado == "0" ? 'checked' : ''}}>
                                        <label  class="custom-control-label uppercase" for="deshabilitarRegistro_{{$index}}"></label>
                                    </div>
                                </td>
                                @endif
                                <td class="table-tail-td">
                                    <div class="flex items-center justify-start">
                                        <a href="{{ route('admin.modulos.edit', $item) }}"
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
            {{ $modulos->links() }}
        </div>
    @else
        <p class="text-red-400 text-center mt-4 font-bold">No existen registros</p>
    @endif
</div>

