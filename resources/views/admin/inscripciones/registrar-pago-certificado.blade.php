<div class="my-4">
    @php $montos = array(); $suma_montos_total = ""; @endphp
    @if ($inscripcion->saldo == "0")
        @foreach ($estudiante->notas as $nota)
            @if ($nota->planificacionModulo->modulo_id == $inscripcion->modulo_id && $nota->nota_final >= $nota_minima_aprobacion)
                @if ($inscripcion->saldo_certificado != null || $inscripcion->saldo_certificado > "0")
                    <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200">Detalle de pagos del Certificado</h2>
                    <div class="table-responsive mt-6 mb-3 bg-gray-50 pb-3 rounded-md shadow-md">
                        <table class="table-tail">
                            <thead class="bg-gray-500 rounded-lg">
                                <tr class="text-center">
                                    <th class="px-1 py-2 text-white">Nro.</th>
                                    <th class="px-1 py-2 text-white">Razón</th>
                                    <th class="px-1 py-2 text-white">Tipo de Pago</th>
                                    <th class="px-1 py-2 text-white">Concepto</th>
                                    <th class="px-1 py-2 text-white">Monto (Bs)</th>
                                    <th class="px-1 py-2 text-white">Fecha de Deposito</th>
                                    <th class="px-1 py-2 text-white">Estado</th>
                                    <th class="px-1 py-2 text-white">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inscripcion->pagosInscripcion as $index => $pago)
                                    @if ($pago->tipoDeRazon->nombre == "certificado" && $pago->estado != 0)
                                        <tr class="text-center">
                                            <td>{{ Str::title($pago->numeroFactura)}}</td>
                                            <td>{{ Str::title($pago->tipoDeRazon->nombre)}}</td>
                                            <td>{{ Str::title($pago->tipoDePago->nombre)}}</td>
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
                                                        <a href="" onclick="anularPago(event, {{$pago->id}}, 'certificado')"
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
                                    <td colspan="7" class="text-right">Total a Cancelar</td>
                                    <td class="text-center font-bold">{{$inscripcion->total_monto_certificado}}</td>
                                    <input type="hidden" value="{{$inscripcion->total_monto_certificado}}">
                                </tr>
                                <tr>
                                    <td colspan="7" class="text-right">Total Cancelado</td>
                                    <td class="text-center font-bold" id="pagoTotalAnterior">{{ number_format($suma_montos_total, 2)}}</td>
                                </tr>
                                <tr>
                                    <td colspan="7" class="text-right">Saldo Actual</td>
                                    <td colspan="7" class="text-center">
                                        <span class="font-bold {{$inscripcion->saldo_certificado > 0 ? 'text-red-500' : 'text-green-500'}}">{{$inscripcion->saldo_certificado}}</span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                @endif
                <h2 class="text-sm uppercase my-3 text-blue-500 border-b-2 border-gray-200">Detalle de la nota obtenida</h2>
                <div class="flex justify-between items-center flex-wrap">
                    <div>
                        <label class="text-gray-600 block font-light">La nota final obtenida es
                            {{$nota->nota_final}} el estudiante esta {{$nota->estado == '2' ? 'Reprobado' : 'Aprobado'}}
                        </label>
                        <span class="text-sm font-medium">
                            Nota subida {{$nota->updated_at->diffForHumans()}}
                        </span>
                    </div>
                    <div class="flex items-start">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="habilitarCertificado"
                                {{$inscripcion->habilitado_certificado == "1" ? 'checked' : ''}}>
                            <label
                                class="custom-control-label uppercase"
                                for="habilitarCertificado">
                                {{ $inscripcion->habilitado_certificado == "1" ? 'Certificado solicitado' : 'Solicitar certificado'}}
                            </label>
                        </div>
                        @if ($inscripcion->habilitado_certificado == "1" && $inscripcion->certificado->solicitado == "1")
                            <div class="custom-control ml-3 custom-switch">
                                <input type="checkbox" class="custom-control-input" id="solicitarFotos"
                                    {{$inscripcion->certificado->fotos == "1" ? 'checked' : ''}}>
                                <label
                                    class="custom-control-label uppercase"
                                    for="solicitarFotos">
                                    {{ $inscripcion->certificado->fotos == "1" ? 'Fotos recepcionadas' : 'Solicitar fotos'}}
                                </label>
                            </div>
                        @endif
                    </div>
                </div>
                @if ($nota->estado == '1')
                    @if ($inscripcion->saldo_certificado == "0" && $inscripcion->total_monto_certificado == "0")
                        <div class="flex justify-end">
                            <span class="text-sm uppercase font-semibold text-blue-500">La obtención del certificado fue gratuito</span>
                        </div>
                    @else
                        <div x-data="{mostrarCarritoCertificado: false}" class="w-full block mt-3">
                            <div class="flex justify-end" >
                                @if ($inscripcion->saldo_certificado != 0 || $inscripcion->habilitado_certificado)
                                    <button type="button" id="btnAgregarPagoCertificado"
                                    class="btn bg-green-600 focus:border-green-800 hover:bg-green-700 hover:text-white"
                                    @click="mostrarCarritoCertificado = !mostrarCarritoCertificado"
                                    x-text="[mostrarCarritoCertificado === true ? 'Ocultar Pago' : 'Agregar Pago']"><button>
                                @endif
                            </div>

                            @if ($inscripcion->habilitado_certificado == true && $inscripcion->total_monto_certificado != null || $inscripcion->saldo_certificado > 0)
                                <form action="{{ route('admin.inscripciones.update', $inscripcion->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="opcion" value="certificado">
                                    <div class="mt-5" x-show="mostrarCarritoCertificado">
                                        @livewire('carrito-pago-general-component', [
                                            'total_monto' => (int)$inscripcion->total_monto_certificado,
                                            'pagoAnterior' => (int)$suma_montos_total
                                        ])
                                    </div>
                                    @if ($inscripcion->saldo_certificado != 0)
                                        <div class="flex justify-end mt-6">
                                            <x-back-button href="{{ route('admin.inscripciones.index') }}" class="mr-2">Volver</x-back-button>
                                            <x-jet-danger-button type="submit">Guardar</x-jet-danger-button>
                                        </div>
                                    @endif
                                </form>
                            @endif
                        </div>
                    @endif
                @endif
                <div class="flex justify-end flex-wrap items-center my-2 font-bold uppercase"
                    x-data="{mostrarEntrega : false}">
                    @if ($inscripcion->saldo_certificado != null && $inscripcion->saldo_certificado == "0")
                        @if ($inscripcion->certificado->impresion)
                            <div class="w-auto shadow px-2 py-1 border-l-8 border-purple-500 rounded-md text-sm text-purple-700">
                                <span>El certificado ya fue impreso en la fecha {{\Carbon\Carbon::parse($inscripcion->certificado->fecha_impresion)->translatedFormat('d F Y')}}</span>
                            </div>
                            <button
                                @click="mostrarEntrega = !mostrarEntrega"
                                class="btn ml-3 text-sm bg-blue-600 focus:border-blue-800 hover:bg-blue-700 hover:text-white">
                                Formulario entrega
                            </button>
                        @else
                            <div class="w-auto shadow px-2 py-1 border-l-8 border-purple-500 rounded-md text-sm text-purple-700">
                                <span>La impresión del certificado aún esta pendiente</span>
                            </div>
                        @endif
                    @endif
                    <div x-show="mostrarEntrega"
                        x-transition:enter="transition duration-200 transform ease-out"
                        x-transition:enter-start="scale-75"
                        x-transition:leave="transition duration-100 transform ease-in"
                        x-transition:leave-end="opacity-0 scale-90"
                        class="w-full block" id="mostrarEntrega">
                        <div class="mt-4 bg-gray-100 w-4/6 p-4 mx-auto">
                            <form action="" onsubmit="realizarEntrega(event)">
                                @csrf
                                @method('PUT')
                                @if ($inscripcion->habilitado_certificado)
                                    <input type="hidden" id="certificado_id" value="{{$inscripcion->certificado->id}}">
                                @endif
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <x-required-label for="entregado" value="Entregado a" />
                                        <textarea
                                            class="w-full h-24 text-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200
                                            focus:ring-opacity-50 rounded-md shadow-sm mt-1 py-2 px-3"
                                            name="entregado_a" form="entregado" id="entregado_a"></textarea>
                                        <x-jet-input-error for="entregado" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-jet-label for="fecha_entregado" value="Fecha de Entrega" />
                                        <x-jet-input type="date" class="w-full" name="fecha_entregado" id="fecha_entregado" value="{{date('Y-m-d')}}" readonly />
                                    </div>
                                </div>
                                <div class="flex justify-end my-2">
                                    <x-jet-danger-button type="submit">Guardar</x-jet-danger-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            @if ($nota->planificacionModulo->modulo_id == $inscripcion->modulo_id && $nota->estado == "2")
                <div class="flex justify-center mt-2">
                    <span class="text-center font-bold uppercase text-blue-500">El estudiante aún no tiene nota final de aprobación para obtener el certificado</span>
                </div>
                <div class="flex justify-end mt-3 py-2">
                    <x-back-button href="{{ route('admin.inscripciones.index') }}" class="mr-2">Volver</x-back-button>
                </div>
            @endif
        @endforeach
    @else
        <div class="flex justify-center mt-2">
            <span class="text-center font-bold uppercase text-blue-500">El estudiante aún no completo el pago de su inscripción</span>
        </div>
        <div class="flex justify-end mt-3">
            <x-back-button href="{{ route('admin.inscripciones.index') }}" class="mr-2">Volver</x-back-button>
        </div>
    @endif
</div>

