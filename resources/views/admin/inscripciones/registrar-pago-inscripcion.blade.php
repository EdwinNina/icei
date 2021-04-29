<div class="my-4" x-data="{mostrarCarritoInscripcion: false}">
    <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200">Detalle Pagos de Inscripción</h2>
    <div  class="table-responsive bg-gray-50 pb-3 shadow-md rounded-md mt-6">
        <table class="table-tail" id="tabla-pago">
            <thead class="bg-gray-500 rounded-lg">
                <tr class="text-center">
                    <th class="px-1 py-2 text-white">Nro.</th>
                    <th class="px-1 py-2 text-white">Razón</th>
                    <th class="px-1 py-2 text-white">Tipo de Pago</th>
                    <th class="px-1 py-2 text-white">Concepto</th>
                    <th class="px-1 py-2 text-white">Monto (Bs)</th>
                    <th class="px-1 py-2 text-white">Fecha de Deposito</th>
                    <th class="px-1 py-2 text-white">Estado</th>
                    <th class="px-1 py-2 text-white">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php $montos = array(); @endphp
                @foreach ($inscripcion->pagosInscripcion as $index => $pago)
                    @if ($pago->tipoDeRazon->nombre == "inscripcion" && $pago->estado != 0)
                        <tr class="text-center obtenerTotalPagado">
                            <td>{{ Str::ucfirst($pago->numeroFactura)}}</td>
                            <td>{{ Str::ucfirst($pago->tipoDeRazon->nombre)}}</td>
                            <td>{{ Str::ucfirst($pago->tipoDePago->nombre)}}</td>
                            <td>{{ Str::ucfirst($pago->concepto)}}</td>
                            <td>{{ $pago->monto}}</td>
                            <td>{{ $pago->fecha_pago->format('d-m-Y')}}</td>
                            <td>
                                <span class="font-bold {{$pago->estado === '2' ? 'text-red-500' : 'text-green-500'}}">
                                    {{$pago->estado === '2' ? 'Pendiente' : 'Cancelado'}}
                                </span>
                            </td>
                            <td>
                                <div class="flex items-center justify-evenly">
                                    <a href="" onclick="imprimirRecibo(event, {{$pago->id}})"
                                        class="my-3 flex justify-center items-center mx-auto bg-green-500 rounded-full w-7 h-7 hover:bg-green-600 transition-all">
                                        @include('components.print-icon')
                                    </a>
                                    @can('admin.registroEconomico.anularPago')
                                        <a href="" onclick="anularPago(event, {{$pago->id}}, 'inscripcion')"
                                            class="flex justify-center items-center mx-auto bg-red-500 rounded-full shadow-lg w-7 h-7 hover:bg-red-600 transition-all">
                                            <svg class="h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </a>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @php $montos[$index] = $pago->monto; @endphp
                    @endif
                @endforeach
                @php
                    $suma_montos_total = array_sum($montos);
                @endphp
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" class="text-right">Total Cancelado</td>
                    <td class="text-center font-bold" id="pagoTotalAnterior">{{ $inscripcion->total_pagado}}</td>
                </tr>
                <tr>
                    <td colspan="6" class="text-right">Saldo Actual</td>
                    <td class="font-bold text-center">
                        <span class="font-bold {{$inscripcion->saldo > 0 ? 'text-red-500' : 'text-green-500'}}">{{$inscripcion->saldo}}</span>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    @if ($inscripcion->saldo > "0")
        <div class="flex justify-end w-full mt-4">
            <button type="button" class="btn bg-green-600 focus:border-green-800 hover:bg-green-700 hover:text-white"
            @click="mostrarCarritoInscripcion = !mostrarCarritoInscripcion" x-text="[mostrarCarritoInscripcion === true ? 'Ocultar Pago' : 'Agregar Pago']"><button>
        </div>
        <form action="{{ route('admin.inscripciones.update', $inscripcion->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="opcion" value="inscripcion">
            <input type="hidden" id="inscripcion_id" value="{{$inscripcion->id}}">
            <div class="mt-10" x-show="mostrarCarritoInscripcion"
                x-transition:enter="transition duration-200 transform ease-out"
                x-transition:enter-start="scale-75"
                x-transition:leave="transition duration-100 transform ease-in"
                x-transition:leave-end="opacity-0 scale-90">
                @livewire('carrito-pagos-component', [
                    'pagoAnterior' => (int)$suma_montos_total
                ])
            </div>

            <div class="flex justify-end mt-6 py-4">
                <x-back-button href="{{ route('admin.inscripciones.index') }}" class="mr-2">Volver</x-back-button>
                <x-jet-danger-button type="submit" id="btnGuardar">Guardar</x-jet-danger-button>
            </div>
        </form>
    @else
        <div class="flex justify-end mt-6">
            <x-back-button href="{{ route('admin.inscripciones.index') }}" class="mr-2">Volver</x-back-button>
        </div>
    @endif
</div>
