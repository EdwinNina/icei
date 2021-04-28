<div class="p-6">
    <div class="flex items-center justify-between py-3">
        @include('components.search')
        <x-jet-button wire:click="create()">
            {{ __('Crear') }}
        </x-jet-button>
    </div>

    @include('admin.horarios.form')

    @include('components.delete-modal')

    <div class="shadow-sm overflow-hidden border-b rounded border-gray-200 sm:rounded-lg">
        <div class="table-responsive">
            <table class="table-tail">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="table-tail-th">Dia de clases</th>
                        <th scope="col" class="table-tail-th">Hora de Inicio</th>
                        <th scope="col" class="table-tail-th">Hora de Finalización</th>
                        <th scope="col" class="table-tail-th">Turno</th>
                        @if (Auth::user()->roles()->first()->name == "Administrador")
                        <th scope="col" class="table-tail-th">Deshabilitar</th>@endif
                        <th scope="col" class="table-tail-th">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($horarios as $index => $item)
                        <tr>
                            <td class="table-tail-td">
                                <div class="text-sm text-gray-900">{{ Str::title($item->dias) }}</div>
                            </td>
                            <td class="table-tail-td">
                                <div class="text-sm text-gray-900">{{ $item->hora_inicio->format('d-m-Y') }}</div>
                            </td>
                            <td class="table-tail-td">
                                <div class="text-sm text-gray-900">{{ $item->hora_fin->format('d-m-Y') }}</div>
                            </td>
                            <td class="table-tail-td">
                                <div class="text-sm text-gray-900">{{ Str::title($item->turno) }}</div>
                            </td>
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
    </div>
    <div class="py-4">
        {{ $horarios->links() }}
    </div>
</div>
