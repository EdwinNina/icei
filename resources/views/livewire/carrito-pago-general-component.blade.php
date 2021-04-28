<div>
    <div class="flex justify-between items-center my-4">
        <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200">Datos Económicos</h2>
        <div>
            <button type="button" class="btn bg-green-600 focus:border-green-800 hover:bg-green-700 hover:text-white"
            wire:click.prevent="agregarPago">Agregar nueva Fila<button>
        </div>
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
                    <th class="px-1 py-2 text-white">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pagos as $index => $pago)
                    <tr>
                        <td class="px-1 py-2 w-auto">
                            <select name="pagos[{{$index}}][tipo_razon_id]" wire:model="pagos.{{$index}}.tipo_razon_id"
                                class="custom-select sm:text-sm" required>
                                <option value="" selected>Seleccionar</option>
                                @foreach ($tipoRazones as $tipo)
                                    <option value="{{$tipo->id}}">{{Str::title($tipo->nombre)}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="px-1 py-2 w-auto">
                            <select name="pagos[{{$index}}][tipo_pago_id]" wire:model="pagos.{{$index}}.tipo_pago_id"
                                class="custom-select sm:text-sm" required>
                                <option value="" selected>Seleccionar</option>
                                @foreach ($tipoPagos as $tipo)
                                    <option value="{{$tipo->id}}">{{Str::title($tipo->nombre)}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="px-1 py-2">
                            <select name="pagos[{{$index}}][concepto]" wire:model="pagos.{{$index}}.concepto"
                                class="custom-select sm:text-sm concepto" required>
                                <option value="" selected>Seleccionar</option>
                                <option value="adelanto">Adelanto</option>
                                <option value="cancelacionTotal">Cancelación total</option>
                            </select>
                        </td>
                        <td class="px-1 py-2">
                            <x-jet-input name="pagos[{{$index}}][numero_recibo]" type="number"
                                class="mt-1 w-32" wire:model="pagos.{{$index}}.numero_recibo"/>
                        </td>
                        <td class="px-1 py-2">
                            <x-jet-input name="pagos[{{$index}}][fecha_pago]" type="date"
                                class="mt-1 w-44" wire:model="pagos.{{$index}}.fecha_pago" required/>
                        </td>
                        <td class="px-1 py-2">
                            <x-jet-input name="pagos[{{$index}}][monto]" type="number" required
                                class="mt-1 w-20 monto"
                                wire:model="pagos.{{$index}}.monto"
                                wire:keydown.debounce.500ms="calcularSaldo()"
                                min="0"/>
                        </td>
                        <td class="flex justify-center items-start mt-3 py-2">
                            <a href=""
                                class="flex justify-center items-center mx-auto bg-red-500 rounded-full shadow-lg w-10 h-10 p-1"
                                wire:click.prevent="eliminarPago({{$index}})">
                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="bg-gray-300 border px-2 py-2 text-gray-500 text-right">Total a Pagar (Bs)</td>
                    <td>
                        <x-jet-input type="number" class="w-20" readonly wire:model="total_monto"/>
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
