<div x-data="{
        mostrar: @entangle('mostrarCarrito')
    }">
    <div x-show="mostrar"
        x-transition:enter="transition duration-200 transform ease-out"
        x-transition:enter-start="scale-75"
        x-transition:leave="transition duration-100 transform ease-in"
        x-transition:leave-end="opacity-0 scale-90"
    >
        <div class="flex justify-between items-center my-4">
            <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200">Datos Económicos</h2>
        </div>
        <div class="table-responsive mt-6">
            <table class="table-tail" id="tabla-pago">
                <thead class="bg-gray-500 rounded-lg">
                    <tr class="text-center">
                        <th class="px-1 py-2 text-white">Tipo de Razón</th>
                        <th class="px-1 py-2 text-white">Tipo de Pago</th>
                        <th class="px-1 py-2 text-white">Concepto</th>
                        <th class="px-1 py-2 text-white w-20">Nro de Recibo</th>
                        <th class="px-1 py-2 text-white w-40">Fecha de Deposito</th>
                        <th class="px-1 py-2 text-white">Monto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pagos as $index => $pago)
                        <tr>
                            <td class="px-1 py-2 w-auto">
                                <select name="pagos[{{$index}}][tipo_razon_id]" wire:model.defer="pagos.{{$index}}.tipo_razon_id"
                                    class="custom-select sm:text-sm" required>
                                    <option value="" selected>Seleccionar</option>
                                    @foreach ($tipoRazones as $tipo)
                                        <option value="{{$tipo->id}}">{{Str::title($tipo->nombre)}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-1 py-2 w-auto">
                                <select name="pagos[{{$index}}][tipo_pago_id]" wire:model.defer="pagos.{{$index}}.tipo_pago_id"
                                    class="custom-select sm:text-sm" required>
                                    <option value="" selected>Seleccionar</option>
                                    @foreach ($tipoPagos as $tipo)
                                        <option value="{{$tipo->id}}">{{Str::title($tipo->nombre)}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="px-1 py-2">
                                <select name="pagos[{{$index}}][concepto]" wire:model.defer="pagos.{{$index}}.concepto"
                                    class="custom-select sm:text-sm concepto" required>
                                    <option value="" selected>Seleccionar</option>
                                    <option value="reserva">Reserva</option>
                                    <option value="adelanto">Adelanto</option>
                                    <option value="cancelacionTotal">Cancelación total</option>
                                </select>
                            </td>
                            <td class="px-1 py-2">
                                <x-jet-input name="pagos[{{$index}}][numero_recibo]" type="number"
                                    class="mt-1 w-40" wire:model.defer="pagos.{{$index}}.numero_recibo"/>
                            </td>
                            <td class="px-1 py-2">
                                <x-jet-input name="pagos[{{$index}}][fecha_pago]" type="date"
                                    class="mt-1 w-44" wire:model.defer="pagos.{{$index}}.fecha_pago" required/>
                            </td>
                            <td class="px-1 py-2">
                                <x-jet-input name="pagos[{{$index}}][monto]" type="number" required
                                    class="mt-1 w-20 monto"
                                    wire:model="pagos.{{$index}}.monto"
                                    wire:keydown.debounce.500ms="calcularSaldo()"
                                    min="0"/>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="bg-gray-300 border px-2 py-2 text-gray-500 text-right">Costo Total a Pagar (Bs)</td>
                        <td>
                            <x-jet-input type="number" class="w-20" readonly wire:model="costoModulo" />
                            <input type="hidden" value="{{$costoModulo}}" name="total_modulo" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="bg-gray-300 border px-2 py-2 text-gray-500 text-right">Total Pagado (Bs)</td>
                        <td>
                            <x-jet-input type="number" class="w-20" readonly wire:model="totalPagado" />
                            <input type="hidden" value="{{$totalPagado}}" name="total_pagado" id="totalPagado"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="bg-gray-300 border px-2 py-2 text-gray-500 text-right">Saldo (Bs)</td>
                        <td><x-jet-input type="number"
                            class="w-20 {{ $saldo > 0 ? 'text-red-500 border-2 border-red-600' : 'text-green-500 border-2 border-green-600'}}"
                            readonly wire:model="saldo"/>
                            <input type="hidden" value="{{$saldo}}" name="saldo" />
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
