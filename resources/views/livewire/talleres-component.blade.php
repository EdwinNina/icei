<div class="p-6">
    <div class="flex items-center justify-between py-3">
        @include('components.search')

        <x-jet-button wire:click="create()">Crear</x-jet-button>
    </div>

    @include('admin.talleres.form')

    <div class="shadow-sm overflow-hidden border-b rounded border-gray-200 sm:rounded-lg">
        <div class="table-responsive">
            <table class="table-tail">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="text-xs font-medium pl-2 text-gray-500 uppercase text-center w-40">Titulo</th>
                        <th scope="col" class="table-tail-th">Descripcion</th>
                        @if (Auth::user()->roles()->first()->name == "Administrador")
                        <th scope="col" class="table-tail-th">Deshabilitar</th>@endif
                        <th scope="col" class="table-tail-th text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($talleres as $index => $item)
                        <tr class="text-gray-700">
                            <td class="w-40 pl-4">{{ Str::ucfirst($item->nombre) }} </td>
                            <td class="table-tail-td">{!! Str::ucfirst($item->descripcion) !!} </td>
                            @if (Auth::user()->roles()->first()->name == "Administrador")
                            <td class="table-tail-td">
                                <div class="custom-control ml-3 custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="deshabilitarRegistro_{{$index}}"
                                    name="deshabilitarRegistro"
                                    value="{{$item->estado}}"
                                    {{$item->estado == "0" ? 'checked' : ''}}
                                    data-id="{{$item->id}}">
                                    <label  class="custom-control-label uppercase" for="deshabilitarRegistro_{{$index}}"></label>
                                </div>
                            </td>
                            @endif
                            <td class="table-tail-td">
                                <div class="flex items-center justify-start">
                                    <a href="" wire:click.prevent="edit({{$item->id}})"
                                        class=" flex justify-center items-center mx-auto bg-yellow-500 rounded-full w-7 h-7 hover:bg-yellow-600 transition-all">
                                        @include('components.edit-icon')
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="my-4">
            {{ $talleres->links() }}
        </div>
    </div>
</div>

