<div>
    <div class="p-4">
        <div class="flex items-center justify-between py-3 ">
            @include('components.search')
            <div class="flex items-center justify-between py-3">
                <div>
                    <a href="{{ route('admin.serviciosVarios.create') }}"
                    class="btn bg-gray-800 focus:border-gray-900 hover:bg-gray-700 hover:text-white">Nuevo</a>
                </div>
            </div>
        </div>

        @include('components.delete-modal')

        @if (count($servicios) > 0)
            <div class="shadow-sm overflow-hidden border-b rounded border-gray-200 sm:rounded-lg">
                <div class="table-responsive">
                    <table class="table-tail">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="table-tail-th">Estudiante</th>
                                <th scope="col" class="table-tail-th">Fecha Recepción</th>
                                <th scope="col" class="table-tail-th">Fecha Entrega</th>
                                <th scope="col" class="table-tail-th text-center">Estado</th>
                                <th scope="col" class="text-xs font-medium text-gray-500 uppercase text-center pl-2">Encargado</th>
                                @if (Auth::user()->roles()->first()->name == "Administrador")
                                <th scope="col" class="table-tail-th">Deshabilitar</th>@endif
                                <th scope="col" class="table-tail-th text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($servicios as $index => $item)
                                <tr>
                                    <td class="table-tail-td">
                                        <div class="text-sm text-gray-900">{{ $item->estudiante->nombre_completo }}</div>
                                    </td>
                                    <td class="table-tail-td">
                                        <div class="text-sm text-gray-900">{{ $item->fecha_recepcion->format('d-m-Y') }}</div>
                                    </td>
                                    <td class="table-tail-td">
                                        <div class="text-sm text-gray-900">{{ $item->fecha_entrega->format('d-m-Y') }}</div>
                                    </td>
                                    <td class="table-tail-td text-center">
                                        <div class="flex justify-center items-center">
                                            <span
                                                data-toggle="tooltip" data-placement="left" title="{{$item->estado == '1' ? 'Servicio habilitado': 'Servicio deshabilitado'}}">
                                                <svg class="h-5 w-5 {{$item->estado == '1' ? 'text-green-600' : 'text-red-600'}}"
                                                    xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                            </span>
                                            @foreach ($item->pagosServicios as $index => $pago)
                                                @if ($index === count($item->pagosServicios) - 1)
                                                    <span
                                                        data-toggle="tooltip" data-placement="left" title="{{$pago->estado === '2' ? 'Cancelación del servicio incompleto': 'Cancelación del servicio completo'}}">
                                                        <svg class="h-5 w-5 {{$pago->estado === '2' ? 'text-red-600' : 'text-green-600'}}"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                                        </svg>
                                                    </span>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="text-sm text-gray-900">Costo: {{ $item->monto }}</div>
                                    </td>
                                    <td class="w-28">
                                        <div class="text-sm text-gray-900">{{ $item->docente->nombre_completo }}</div>
                                    </td>
                                    @if (Auth::user()->roles()->first()->name == "Administrador")
                                    <td class="table-tail-td">
                                        <div class="custom-control ml-3 custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="deshabilitarRegistro_{{$index}}"
                                            name="deshabilitarRegistro"
                                            value="{{$item->estado}}"
                                                {{$item->estado == "0" ? 'checked' : ''}}
                                                onchange="deshabilitarRegistro(event, {{$item->id}})">
                                            <label  class="custom-control-label uppercase" for="deshabilitarRegistro_{{$index}}"></label>
                                        </div>
                                    </td>
                                    @endif
                                    <td class="table-tail-td">
                                        <div class="flex items-center justify-start">
                                            <a href="{{ route('admin.serviciosVarios.edit', $item->id) }}"
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
                {{ $servicios->links() }}
            </div>
        @else
            <p class="text-red-400 text-center mt-4 font-bold">Aún no existen servicios registrados</p>
        @endif
    </div>
</div>
