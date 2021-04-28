<div class="p-6">
    <div class="flex items-center justify-between py-3">
        @include('components.search')
        <x-jet-button wire:click="create()">
            {{ __('Crear') }}
        </x-jet-button>
    </div>

    @include('admin.docentes.form')
    @include('components.form-user')

    <div class="shadow-sm overflow-hidden border-b rounded border-gray-200 sm:rounded-lg">
        <div class="table-responsive">
            <table class="table-tail">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="w-36 text-xs font-medium pl-3 text-gray-500 uppercase">Cedula</th>
                        <th scope="col" class="table-tail-th">Nombre</th>
                        <th scope="col" class="table-tail-th">Paterno</th>
                        <th scope="col" class="table-tail-th">Materno</th>
                        <th scope="col" class="w-40 text-xs font-medium pl-2 text-gray-500 uppercase">Email</th>
                        <th scope="col" class="table-tail-th">Celular</th>
                        @if (Auth::user()->roles()->first()->name == "Administrador")
                        <th scope="col" class="table-tail-th">Deshabilitar</th>
                        @endif
                        <th scope="col" class="table-tail-thr text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($docentes as $index => $item)
                        <tr>
                            <td class="w-36 pl-3">
                                <div class="text-sm text-gray-900">{{ $item->carnet }} {{ $item->expedido }}</div>
                            </td>
                            <td class="table-tail-td">
                                <div class="text-sm text-gray-900">{{ Str::title($item->nombre) }}</div>
                            </td>
                            <td class="table-tail-td">
                                <div class="text-sm text-gray-900">{{ Str::ucfirst($item->paterno) }}</div>
                            </td>
                            <td class="table-tail-td">
                                <div class="text-sm text-gray-900">{{ Str::ucfirst($item->materno) }}</div>
                            </td>
                            <td class="w-40">
                                <div class="text-sm text-gray-900">{{ $item->email}}</div>
                            </td>
                            <td class="table-tail-td">
                                <div class="text-sm text-gray-900">{{$item->celular}}</div>
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
                            <td class="table-tail-td  text-sm font-medium">
                                <div class="flex items-center justify-between">
                                    <a href="#"
                                        wire:click.prevent="edit({{$item->id}})"
                                        class="flex justify-center items-center mx-auto bg-yellow-500 rounded-full w-7 h-7 hover:bg-yellow-600 transition-all">
                                        @include('components.edit-icon')
                                    </a>
                                    <a href="" wire:click.prevent="openModalUser({{$item}})"
                                        class="flex justify-center items-center mx-2 bg-green-500 rounded-full w-7 h-7 hover:bg-green-600 transition-all">
                                        @include('components.user-icon')
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
        {{ $docentes->links() }}
    </div>
</div>
