<div class="p-6">
    <div class="flex items-center justify-between py-3">
        @include('components.search')
        <x-jet-button wire:click="create()">Crear</x-jet-button>
    </div>

    @include('admin.aulas.form')
    @include('components.delete-modal')

    <div class="shadow-sm overflow-hidden border-b rounded border-gray-200 sm:rounded-lg">
        <div class="table-responsive">
            <table class="table-tail">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="table-tail-th text-center">Aula</th>
                        <th scope="col" class="table-tail-th text-center">Piso</th>
                        @if (Auth::user()->roles()->first()->name == "Administrador")
                        <th scope="col" class="table-tail-th">Deshabilitar</th>
                        @endif
                        <th scope="col" class="table-tail-th">Estado</th>
                        <th scope="col" class="table-tail-thr text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($aulas as $index => $item)
                        <tr>
                            <td class="table-tail-td">
                                <div class="text-sm text-gray-900 text-center">{{ Str::ucfirst($item->aula) }}</div>
                            </td>
                            <td class="table-tail-td">
                                <div class="text-sm text-gray-900 text-center">{{ $item->piso }}</div>
                            </td>
                            @if (Auth::user()->roles()->first()->name == "Administrador")
                                <td class="table-tail-td">
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
                            <td class="table-tail-td flex">
                                <div class="text-sm px-2 py-1 w-auto rounded-md text-gray-50
                                {{$item->estado === '1' ? 'bg-green-600' : 'bg-red-600'}}">
                                {{$item->estado === '1' ? 'Activo' : 'Inactivo'}}
                                </div>
                            </td>
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
    </div>
    <div class="py-4">
        {{ $aulas->links() }}
    </div>
</div>
