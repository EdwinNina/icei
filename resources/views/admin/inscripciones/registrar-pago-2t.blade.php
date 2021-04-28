<div class="pb-4">
    @php  $montos = array(); $suma_montos_total = ''; @endphp
    <div class="flex justify-between my-3 items-center flex-wrap">
        @if ($inscripcion->saldo == 0)
            @foreach ($estudiante->notas as $nota)
                @if ($nota->planificacionModulo->modulo_id === $inscripcion->modulo_id)
                    @if ($nota->nota_2 != null && $inscripcion->saldo_examen != null)
                        <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200">Detalle de pagos del examen 2t</h2>
                        <div class="table-responsive mt-6 mb-3 bg-gray-50 pb-3 rounded-md shadow-md">
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
                                    @foreach ($inscripcion->pagosInscripcion as $index => $pago)
                                        @if ($pago->tipoDeRazon->nombre == "examen 2t" && $pago->estado != 0)
                                            <tr class="text-center obtenerTotalPagado">
                                                <td>{{ $pago->numeroFactura }}</td>
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
                                                            <a href="" onclick="anularPago(event, {{$pago->id}})"
                                                                class="flex justify-center items-center mx-auto bg-red-500 rounded-full shadow-lg w-7 h-7 hover:bg-red-600 transition-all">
                                                                <svg class="h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                            </a>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                                $montos[$index] = $pago->monto;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @php
                                        $suma_montos_total = array_sum($montos);
                                    @endphp
                                </tbody>
                                <tfoot >
                                    <tr>
                                        <td colspan="7" class="text-right">Total a Cancelar</td>
                                        <td class="text-center font-bold">{{$inscripcion->total_monto_2t}}</td>
                                        <input type="hidden" value="{{$inscripcion->total_monto_2t}}">
                                    </tr>
                                    <tr>
                                        <td colspan="7" class="text-right">Total Cancelado</td>
                                        <td class="text-center font-bold" id="pagoTotalAnterior">{{ number_format($suma_montos_total,2)}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" class="text-right">Saldo Actual</td>
                                        <td colspan="7" class="text-center">
                                            <span class="font-bold {{$inscripcion->saldo_examen > 0 ? 'text-red-500' : 'text-green-500'}}">{{$inscripcion->saldo_examen == null ? 0.00 : number_format($inscripcion->saldo_examen, 2)}}</span>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @endif
                    @if ($nota->nota_final != 0)
                        <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 block w-full">Detalle de la nota final obtenida</h2>
                        <div>
                            <label class="text-gray-600 mt-4 block font-light">La nota final obtenida es
                                {{$nota->nota_final}} el estudiante esta {{$nota->estado == '2' ? 'Reprobado' : 'Aprobado'}}
                            </label>
                            <span class="text-sm font-medium">
                                Nota subida {{$nota->updated_at->diffForHumans()}}
                            </span>
                        </div>
                        @if ($nota->nota_final < $nota_minima_aprobacion || $inscripcion->habilitado_2t)
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="habilitar2t"
                                    {{$inscripcion->habilitado_2t == "1" ? 'checked' : ''}}>
                                <label class="custom-control-label uppercase" for="habilitar2t">
                                    {{ $inscripcion->habilitado_2t == "1" ? 'Examen 2T Habilitado' : 'Habilitar 2T' }}</label>
                            </div>
                        @endif
                    @else
                        <label class="text-indigo-500 font-bold text-center uppercase">Aún el docente no asignó la Nota Final </label>
                    @endif
                    <input type="hidden" id="inscripcion_id" value="{{$inscripcion->id}}">
                    @if ($inscripcion->habilitado_2t == true && $inscripcion->total_monto_2t > 0)
                        <div x-data="{mostrarCarrito2t: false}" class="w-full block mt-3">
                            @if ($inscripcion->saldo_examen != 0 || $inscripcion->saldo_examen == null)
                                <div class="flex justify-end" >
                                    <button type="button" id="btnAgregarPago2t"
                                        class="btn bg-green-600 focus:border-green-800 hover:bg-green-700 hover:text-white"
                                    @click="mostrarCarrito2t = !mostrarCarrito2t" x-text="[mostrarCarrito2t === true ? 'Ocultar Pago' : 'Agregar Pago']"><button>
                                </div>
                            @endif
                            @if ($inscripcion->habilitado_2t == true && $inscripcion->total_monto_2t != null || $inscripcion->saldo_examen == null)
                                <form action="{{ route('admin.inscripciones.update', $inscripcion->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="opcion" value="examen">
                                    <div class="mt-5" x-show="mostrarCarrito2t"
                                    x-transition:enter="transition duration-200 transform ease-out"
                                    x-transition:enter-start="scale-75"
                                    x-transition:leave="transition duration-100 transform ease-in"
                                    x-transition:leave-end="opacity-0 scale-90">
                                        @livewire('carrito-pago-general-component', [
                                            'total_monto' => (int)$inscripcion->total_monto_2t,
                                            'opcion' => 'examen',
                                            'pagoAnterior' => (int)$suma_montos_total
                                        ])
                                    </div>
                                    @if ($inscripcion->saldo_examen != 0 || $inscripcion->saldo_examen == null)
                                        <div class="flex justify-end mt-6">
                                            <x-back-button href="{{ route('admin.inscripciones.index') }}" class="mr-2">Volver</x-back-button>
                                            <x-jet-danger-button type="submit">Guardar</x-jet-danger-button>
                                        </div>
                                    @endif
                                </form>
                            @endif
                        </div>
                    @endif
                    @if ($inscripcion->habilitado_2t && $inscripcion->total_monto_2t == 0)
                        <label class="text-indigo-500 font-bold text-center w-full mt-3 uppercase">El costo del examen 2T fue de 0 Bs, Por tal motivo no puede agregar ningún pago</label>
                    @endif
                @endif
            @endforeach
        @else
            <span class="font-bold uppercase text-indigo-500">El estudiante aún no completó el pago de su inscripción</span>
        @endif
    </div>
    <div class="mt-2 flex justify-end">
        @if ($inscripcion->total_monto_2t == null)
            <x-back-button href="{{ route('admin.inscripciones.index') }}">Volver</x-back-button>
        @endif
    </div>
</div>

