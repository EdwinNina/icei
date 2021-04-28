@extends('adminlte::page')

@section('title', 'Servicios Varios')

@section('content_header')
@stop

@section('content')
    @if (session('message'))
    <div class=" border-l-4 px-5 py-2 rounded mb-3
        {{session('message') === 'good' ? 'bg-green-500 border-green-600' : 'bg-red-500 border-red-600'}}">
        <span class="text-white text-center">
            {{ session('message') === 'good'
                ? 'El servicio se registró con exito'
                : 'Ocurrió un error, intentelo de nuevo'
            }}
        </span>
    </div>
    @endif

    <div class="w-full">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h1 class="text-gray-500 uppercase text-2xl mt-1 mb-3 text-center">Editar Registro de Servicios Varios</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 mb-3">Datos el estudiante</h2>
                    <div>
                        <p class="obtenerNombre">
                            <span class="font-bold">Nombre:</span>
                            <span>{{$servicio->estudiante->nombre_completo}}</span></p>
                        <p class="obtenerCarnet">
                            <span class="font-bold">Cédula de identidad:</span>
                            <span>{{$servicio->estudiante->carnet}} {{$servicio->estudiante->expedido}}</span>
                        </p>
                        <p><span class="font-bold">Celular:</span> {{$servicio->estudiante->celular}}</p>
                    </div>
                </div>
                <div>
                    <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200">Detalle del Servicio</h2>
                    <p><span class="font-bold">Categoria:</span> {{ Str::title($servicio->categoria->nombre) }}</p>
                    <p><span class="font-bold">Fecha de Recepción:</span> {{ $servicio->fecha_recepcion }}</p>
                    <p><span class="font-bold">Fecha de Entrega:</span> {{ $servicio->fecha_entrega }}</p>
                    <p>
                        <span class="font-bold">Detalles:</span>
                        <span>{!! $servicio->detalles !!}</span>
                    </p>
                    <p><span class="font-bold">Persona Asignada:</span> {{$servicio->docente->nombre_completo}}</p>
                </div>
            </div>
                @php $montos = array(); $suma_montos_total = ""; @endphp
                <div x-data="{mostrarCarritoCertificado: false}" class="w-full block mt-3">
                    <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200">Detalle de pagos del Servicio</h2>
                    <div class="table-responsive mt-6 mb-3 bg-gray-50 pb-3 rounded-md shadow-md">
                        <table class="table-tail">
                            <thead class="bg-gray-500 rounded-lg">
                                <tr class="text-center">
                                    <th class="px-1 py-2 text-white">Nro.</th>
                                    <th class="px-1 py-2 text-white">Tipo de Pago</th>
                                    <th class="px-1 py-2 text-white">Concepto</th>
                                    <th class="px-1 py-2 text-white">Monto (Bs)</th>
                                    <th class="px-1 py-2 text-white">Fecha de Deposito</th>
                                    <th class="px-1 py-2 text-white">Estado</th>
                                    <th class="px-1 py-2 text-white">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($servicio->pagosServicios as $index => $pago)
                                    @if ($pago->tipoDeRazon->nombre == "servicios varios")
                                        <tr class="text-center">
                                            <td>{{ $pago->numeroFactura }}</td>
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
                                                    class="my-3 flex justify-center items-center mx-auto bg-red-500 rounded-full shadow-lg w-10 h-10">
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
                                        @php $montos[$index] = $pago->monto; @endphp
                                    @endif
                                @endforeach
                                @php
                                    $suma_montos_total = array_sum($montos);
                                @endphp
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="text-right">Total a Cancelar</td>
                                    <td class="text-center font-bold">{{$servicio->monto}}</td>
                                    <input type="hidden" value="{{$servicio->monto}}">
                                </tr>
                                <tr>
                                    <td colspan="6" class="text-right">Total Cancelado</td>
                                    <td class="text-center font-bold" id="pagoTotalAnterior">{{ number_format($suma_montos_total, 2)}}</td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="text-right">Saldo Actual</td>
                                    <td colspan="6" class="text-center">
                                        <span class="font-bold {{$servicio->saldo > 0 ? 'text-red-500' : 'text-green-500'}}">{{$servicio->saldo == null ? '0.00' : number_format($servicio->saldo, 2)}}</span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    @if ($servicio->saldo > "0" || $servicio->saldo == null)
                        <div class="flex justify-end" >
                            <button type="button" id="btnAgregarPagoCertificado" class="btn bg-green-600 focus:border-green-800 hover:bg-green-700 hover:text-white"
                            @click="mostrarCarritoCertificado = !mostrarCarritoCertificado" x-text="[mostrarCarritoCertificado === true ? 'Ocultar Pago' : 'Agregar Pago']"><button>
                        </div>
                        <form action="{{ route('admin.serviciosVarios.update', $servicio->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                                <div class="mt-5" x-show="mostrarCarritoCertificado"
                            x-transition:enter="transition duration-200 transform ease-out"
                            x-transition:enter-start="scale-75"
                            x-transition:leave="transition duration-100 transform ease-in"
                            x-transition:leave-end="opacity-0 scale-90">
                            @livewire('carrito-pago-general-component', [
                                'total_monto' => $servicio->monto,
                                'pagoAnterior' => (int)$suma_montos_total
                            ])
                            <div class="flex justify-end mt-6 bg-gray-50 py-4 px-6">
                                <x-back-button href="{{ route('admin.serviciosVarios.index') }}" class="mr-2">Volver</x-back-button>
                                <x-jet-danger-button type="submit" id="btnGuardar">Registrar</x-jet-danger-button>
                            </div>
                        </form>
                    @else
                    <div class="flex justify-end mt-6 py-4">
                        <x-back-button href="{{ route('admin.serviciosVarios.index') }}" class="mr-2">Volver</x-back-button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    @trixassets
@stop
@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        window.livewire.on('montoCorrecto', () => {
            Swal.fire('Monto ingresado correcto!', '', 'success')
            document.getElementById('btnGuardar').classList.remove('hidden');
        });
        window.livewire.on('errorMonto', () => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'El monto ingresado no puede ser mayor al saldo',
                footer: 'Por favor ingrese un monto igual o menor al saldo'
            });
            document.getElementById('btnGuardar').classList.add('hidden');
        });

        function imprimirRecibo(e, id){
            e.preventDefault();
            console.log(id);
            axios.post('/admin/servicios-varios/reporte-pago', {id:id})
                .then(resp => {
                    window.open("{{asset('/')}}" + "Comprobante_de_Ingreso.pdf", "_blank");
                });
        }

    </script>
@stop
