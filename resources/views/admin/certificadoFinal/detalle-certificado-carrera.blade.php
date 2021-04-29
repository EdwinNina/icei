@extends('adminlte::page')

@section('title', 'Certificado Finales')

@section('content_header')
@stop

@section('content')
    @if (session('message'))
        <div class=" border-l-4 px-5 py-2 rounded mb-3
            {{session('message') === 'good' ? 'bg-green-500 border-green-600' : 'bg-red-500 border-red-600'}}">
            <span class="text-white text-center">
                {{ session('message') === 'good'
                    ? 'La solicitud del certificado fue exitosa'
                    : 'Ocurrió un error, intentelo de nuevo'
                }}
            </span>
        </div>
    @endif
    @php $montos = array(); $suma_montos_total = ""; @endphp
    <div class="w-full">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 my-4">
            <h1 class="text-gray-500 uppercase text-2xl mb-4 text-center">Datos de la Carrera y Estudiante</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 mb-3">Datos del estudiante</h2>
                    <p>
                        <span class="font-bold">Nombre:</span>
                        <span>{{$certificado->estudiante->nombre_completo}}</span></p>
                    <p>
                        <span class="font-bold">Cédula de identidad:</span>
                        <span>{{$certificado->estudiante->carnet}} {{$certificado->estudiante->expedido}}</span>
                    </p>
                </div>
                <div>
                    <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 mb-3">Detalle de la Carrera</h2>
                    <p>
                        <span class="font-bold">Carrera:</span>
                        <span>{{ Str::title($certificado->carrera->titulo) }}</span>
                    </p>
                    <p>
                        <span class="font-bold">Carga Horaria:</span>
                        <span>{{ $certificado->carrera->cargaHoraria }} Horas Académicas</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h1 class="text-gray-500 uppercase text-2xl mb-4 text-center">Módulos pasados por el estudiante</h1>
            <h3 class="text-blue-500">El estudiante aprobó todos los modulos de la Carrera {{Str::title($certificado->carrera->titulo)}}</h3>
            <ul class="pl-2 list-disc">
                @foreach ($certificado->carrera->modulos as $modulo)
                    <li class="flex">{{$modulo->titulo_completo}} <svg
                        xmlns="http://www.w3.org/2000/svg" class="h-6 text-green-500 font-bold w-6"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </li>
                @endforeach
            </ul>
            <h2 class="text-sm uppercase mt-3 text-blue-500 border-b-2 border-gray-200">Detalle de pagos del Certificado</h2>
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
                        @foreach ($certificado->pagosCertificadoFinal as $index => $pago)
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
                            <td colspan="7" class="text-right">Total a Cancelar</td>
                            <td class="text-center font-bold">{{$certificado->total_certificado}}</td>
                            <input type="hidden" value="{{$certificado->total_certificado}}">
                        </tr>
                        <tr>
                            <td colspan="7" class="text-right">Total Cancelado</td>
                            <td class="text-center font-bold" id="pagoTotalAnterior">{{ number_format($suma_montos_total, 2)}}</td>
                        </tr>
                        <tr>
                            <td colspan="7" class="text-right">Saldo Actual</td>
                            <td colspan="7" class="text-center">
                                <span class="font-bold {{$certificado->saldo > 0 ? 'text-red-500' : 'text-green-500'}}">{{$certificado->saldo}}</span>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="flex justify-end mt-4">
                <input type="hidden" id="idCertificado" value="{{$certificado->id}}">
                <div class="custom-control ml-3 custom-switch">
                    <input type="checkbox" class="custom-control-input" id="solicitarCertificado"
                     {{$certificado->solicitado == 1 ? 'checked':''}}>
                    <label
                        class="custom-control-label uppercase"
                        for="solicitarCertificado">
                        {{$certificado->solicitado == 1 ? 'Certificado Solicitado' : 'Solicitar Certificado'}}
                    </label>
                </div>
                <div class="custom-control ml-3 custom-switch">
                    <input type="checkbox" class="custom-control-input" id="solicitarFotos"
                        {{ $certificado->fotos == "1" ? 'checked' : ''}}>
                    <label
                        class="custom-control-label uppercase"
                        for="solicitarFotos">
                        {{ $certificado->fotos == "1" ? 'Fotos recepcionadas' : 'Solicitar fotos'}}
                    </label>
                </div>
            </div>
            <div x-data="{mostrarCarritoCertificado: false}" class="w-full block mt-3">
                <div class="flex justify-end" >
                    @if ($certificado->saldo != 0)
                        <button type="button" id="btnAgregarPagoCertificado"
                        class="btn bg-green-600 focus:border-green-800 hover:bg-green-700 hover:text-white"
                        @click="mostrarCarritoCertificado = !mostrarCarritoCertificado"
                        x-text="[mostrarCarritoCertificado === true ? 'Ocultar Pago' : 'Agregar Pago']"><button>
                    @endif
                </div>
                <form action="{{ route('admin.certificadoFinal.update', $certificado->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mt-5" x-show="mostrarCarritoCertificado">
                        @livewire('carrito-pago-general-component', [
                            'total_monto' => (int)$certificado->total_certificado,
                            'pagoAnterior' => (int)$suma_montos_total
                        ])
                    <div class="flex justify-end mt-6">
                        <x-back-button href="{{ route('admin.certificadoFinal.index') }}" class="mr-2">Volver</x-back-button>
                        <x-jet-danger-button type="submit">Guardar</x-jet-danger-button>
                    </div>
                    </div>
                </form>
            </div>
            <div class="flex justify-end flex-wrap items-center my-2 font-bold uppercase"
                x-data="{mostrarEntrega : false}">
                @if ($certificado->impresion)
                    <div class="w-auto my-2 md:my-0 shadow px-2 py-1 border-l-8 border-purple-500 rounded-md text-sm text-purple-700">
                        <span>El certificado ya fue impreso en la fecha {{\Carbon\Carbon::parse($certificado->fecha_impresion)->translatedFormat('d F Y')}}</span>
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
                            <input type="hidden" id="certificado_id" value="{{$certificado->id}}">
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
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@stop

@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
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
            axios.post('/admin/certificados-final/reporte-pago', {id:id})
                .then(resp => {
                    window.open("{{ asset('/')}}" + "Comprobante_de_Ingreso.pdf", "_blank");
                });
        }

        const btnSolicitarFotos = document.getElementById('solicitarFotos'),
            certificadoId = document.getElementById('certificado_id').value;

        if(btnSolicitarFotos !== null){
            btnSolicitarFotos.addEventListener('change', () => {
                if(btnSolicitarFotos.checked){
                    Swal.fire({
                        title: '¿Estas recibiendo las fotografías para el certificado?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si',
                        cancelButtonText: 'No'
                    }).then((result) => {
                        if(result.dismiss === "cancel") {
                            toastr.info('Se canceló la aceptación de fotografías');
                            btnSolicitarFotos.checked = false;
                            return;
                        }else{
                            axios.post("/admin/certificados-final/solicitarFotos", {id : certificadoId})
                            .then( resp => {
                                if(resp.status === 200){
                                    toastr.success('Correcto', 'Fotografías aceptadas correctamente');
                                }else{
                                    toastr.error('Incorrecto', 'Hubó un error, inténtelo de nuevo!');
                                }
                            })
                        }
                    })
                }else{
                    axios.post("/admin/certificados-final/cancelarSolicitarFotos",{ id: certificadoId})
                    .then(resp => {
                        console.log(resp);
                        if(resp.status === 200){
                            toastr.success('Correcto', 'Sé canceló la aceptación de fotografías correctamente');
                        }else{
                            toastr.error('Incorrecto', 'Hubó un error, inténtelo de nuevo!');
                        }
                    })
                }
            });
        }

        let entregado_a = document.getElementById('entregado_a'),
            fecha_entregado = document.getElementById('fecha_entregado')
            mostrarEntrega = document.getElementById('mostrarEntrega');

        function realizarEntrega(e){
            e.preventDefault();
            const data = {
                'entregado_a': entregado_a.value,
                'fecha_entregado': fecha_entregado.value,
                'certificado_id': certificadoId,
            }
            axios.post('/admin/certificados-final/entregaCertificado', data)
            .then( resp => {
                if(resp.status === 200){
                    toastr.success('Correcto', 'Los datos de entrega se enviaron correctamente');
                    entregado_a.value = '';
                    mostrarEntrega.style.display = 'none';
                }else{
                    toastr.error('Incorrecto', 'Hubó un error, inténtelo de nuevo!');
                }
            });
        }

        function anularPago(e,id){
            e.preventDefault();
            Swal.fire({
                title: '¿Estas seguro de anular este registro de pago?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No'
            }).then((result) => {
                if(result.dismiss === "cancel" || result.dismiss === "backdrop") {
                    toastr.info('Se canceló la anulación de este registro');
                    return;
                }else{
                    axios.post('/admin/registroEconomico/anular',{id:id})
                    .then( resp => {
                        if (resp.status == 200) {
                            axios.post('/admin/certificados-final/cambiarEstadoPago',{idPago:id,idCertificado: certificadoId})
                            .then( response => {
                                toastr.success('Correcto', 'El pago se anuló correctamente');
                                setTimeout(() => {
                                    location.reload();
                                }, 1500);
                            })
                        }else{
                            toastr.error('Incorrecto', 'Hubó un error, inténtelo de nuevo!');
                        }
                    });
                }
            })
        }

        const btnsolicitarCertificado = document.getElementById('solicitarCertificado'),
            idCertificado = document.getElementById('idCertificado').value;
        btnsolicitarCertificado.addEventListener('change', e => {
            if(e.target.checked == false){
                Swal.fire({
                title: '¿Estas seguro de cancelar la solicitud?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'No'
                }).then((result) => {
                    if(result.dismiss === "cancel" || result.dismiss === "backdrop") {
                        toastr.info('Se canceló la petición');
                        return;
                    }else{
                        axios.post('/admin/certificados-final/cancelarSolicitud',{id:idCertificado})
                        .then( resp => {
                            if (resp.status == 200) {
                                toastr.success('Correcto', 'Se canceló la solicitud correctamente');
                                setTimeout(() => {
                                    window.open("{{ route('admin.certificadoFinal.index')}}")
                                }, 1500);
                            }else{
                                toastr.error('Incorrecto', 'Hubó un error, inténtelo de nuevo!');
                            }
                        });
                    }
                })
            }
        });
    </script>
@stop
