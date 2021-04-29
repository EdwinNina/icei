@extends('adminlte::page')

@section('title', 'Editar Asignación del Alumno')

@section('content_header')
@stop

@section('content')
    @if (session('message'))
        <div class=" border-l-4 px-5 py-2 rounded mb-3
            {{session('message') === 'good' ? 'bg-green-500 border-green-600' : 'bg-red-500 border-red-600'}}">
            <span class="text-white text-center">
                {{ session('message') === 'good'
                    ? 'La modificación se realizó con exito'
                    : 'Ocurrió un error, intentelo de nuevo'
                }}
            </span>
        </div>
    @endif
    <div class="flex justify-end mb-3">
        <a href="{{ route('admin.inscripcionesTalleres.index') }}"
            class="btn ml-4 flex justify-between bg-purple-500 focus:border-yellow-6 hover:bg-purple-600 hover:text-white"
        ><svg class="h-5 w-5 mx-2" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>Volver
        </a>
    </div>
    <div class="w-full" x-data="{mostrarCarritoInscripcion:false}">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between mb-3 items-start">
                    <h1 class="text-gray-500 uppercase text-2xl mt-1 mb-3 text-center">Actualizar datos de alumno inscrito</h1>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 mb-3">Datos del estudiante</h2>
                        <p class="obtenerNombre">
                            <span class="font-bold">Nombre:</span>
                            <span>{{$estudiante->nombre_completo}}</span></p>
                            <input type="hidden" id="estudiante" value="{{$estudiante->id}}">
                        <p class="obtenerCarnet">
                            <span class="font-bold">Cédula de identidad:</span>
                            <span>{{$estudiante->carnet}} {{$estudiante->expedido}}</span>
                        </p>
                        <p><span class="font-bold">Celular:</span> {{$estudiante->celular}}</p>
                        <p><span class="font-bold">Correo electrónico:</span> {{$estudiante->email}}</p>
                    </div>
                    <div>
                        <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200">Detalle del Taller tomado</h2>
                        <p><span class="font-bold">Taller:</span> {{ Str::title($inscripcion->planificacionTaller->taller->nombre)}}</p>
                        <p><span class="font-bold">Horario:</span> {{$inscripcion->planificacionTaller->horario->horario_completo}}</p>
                        <p><span class="font-bold">Modalidad:</span> {{$inscripcion->planificacionTaller->modalidad->nombre}}</p>
                        <p><span class="font-bold">Docente:</span> {{$inscripcion->planificacionTaller->docente->nombre_completo}}</p>
                        <p><span class="font-bold">Fecha de Inicio:</span> {{ Str::title($inscripcion->planificacionTaller->fecha_inicio->translatedFormat('d F Y'))}}</p>
                        <p><span class="font-bold">Fecha de Inicio:</span> {{ Str::title($inscripcion->planificacionTaller->fecha_fin->translatedFormat('d F Y'))}}</p>
                        <p><span class="font-bold">Duración:</span> {{$inscripcion->planificacionTaller->duracion}} {{$inscripcion->planificacionTaller->duracion > 1 ? 'Días' : 'Día'}}</p>
                        <p><span class="font-bold">Carga Horaria:</span> {{$inscripcion->planificacionTaller->carga_horaria}} horas académicas</p>
                        <p><span class="font-bold">Requisitos:</span> {{ Str::title($inscripcion->planificacionTaller->requisitos) }}</p>
                        <p class="costoModulo">
                            <span class="font-bold">Costo del Taller (Bs):</span>
                            <span>{{$inscripcion->planificacionTaller->costo}}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div x-data="{mostrarPagosInscripcion: true, mostrarEntregaCertificado: false}">
        <h2 class="text-sm uppercase font-bold text-yellow-500 border-b-2 mt-4 border-gray-200">Otras acciones a realizar</h2>
        <div class="flex justify-end mt-4">
            <button type="button"
                @click="mostrarPagosInscripcion = !mostrarPagosInscripcion; mostrarEntregaCertificado = false"
                class="btn flex justify-center bg-blue-800 focus:border-blue-900 hover:bg-blue-700 hover:text-white"
                x-text="[mostrarPagosInscripcion == true ? 'Ocultar Pagos Inscripcion' : 'Ver Pagos Inscripcion']"></button>
            <button type="button"
                @click="mostrarEntregaCertificado = !mostrarEntregaCertificado; mostrarPagosInscripcion = false"
                class="btn ml-4 flex justify-center bg-blue-800 focus:border-blue-900 hover:bg-blue-700 hover:text-white"
                x-text="[mostrarEntregaCertificado == true ? 'Ocultar Detalles Certificado' : 'Ver Detalles Certificado']"></button>
        </div>
        <div x-show="mostrarPagosInscripcion" class="bg-white overflow-hidden my-4 shadow-sm sm:rounded-lg"
            x-transition:enter="transition duration-200 transform ease-out"
            x-transition:enter-start="scale-75"
            x-transition:leave="transition duration-100 transform ease-in"
            x-transition:leave-end="opacity-0 scale-90">
            <div class="px-6 pt-6">
                @include('admin.inscripcionesTalleres.registrar-pago-inscripcion')
            </div>
        </div>
        <div x-show="mostrarEntregaCertificado" class="bg-white overflow-hidden my-4 shadow-sm sm:rounded-lg"
            x-transition:enter="transition duration-200 transform ease-out"
            x-transition:enter-start="scale-75"
            x-transition:leave="transition duration-100 transform ease-in"
            x-transition:leave-end="opacity-0 scale-90">
            <div class="px-6 pt-6">
                @include('admin.inscripcionesTalleres.detalle-certificado')
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
@stop
@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let costo = document.querySelector(".costoModulo span:nth-child(2)");
            let pagoAnterior = document.querySelector("#pagoTotalAnterior");
            Livewire.emit("costoModulo", parseInt(costo.textContent));
        });

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

        function mensajes(respuesta, mensajeExito, mensajeError){
            if(respuesta.data === 'good'){
                Swal.fire(mensajeExito, '', 'success')
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: mensajeError,
                });
            }
            return;
        }

        function imprimirRecibo(e, id){
            e.preventDefault();
            console.log(id);
            axios.post('/admin/inscripcion-taller/reporte-pago', {id:id})
                .then(resp => {
                    window.open("{{asset('/')}}" + "Comprobante_de_Ingreso.pdf", "_blank");
                });
        }

        const btnHabilitarCertificado = document.getElementById('habilitarCertificado'),
        inscripcionId = document.getElementById('inscripcion_id').value;

        if (btnHabilitarCertificado !== null) {
            btnHabilitarCertificado.addEventListener('change', () => {
                if(btnHabilitarCertificado.checked){
                    Swal.fire({
                    title: '¿Desea hacer la solicitud del certificado?',
                    showCancelButton: true,
                    confirmButtonText: 'Solicitar',
                    showLoaderOnConfirm: false,
                    }).then((result) => {
                        if(result.dismiss === "cancel" && result.dismiss === "backdrop") {
                            toastr.info('Se canceló la solicitud del certificado');
                            btnHabilitarCertificado.checked = false;
                            return;
                        }else{
                            axios.post("/admin/inscripcion-taller/habilitarCertificado",{ id: inscripcionId})
                            .then(resp => {
                                mensajes(resp, 'Certificado del taller solicitado correctamente','Ocurrió un error al solicitar el certificado! Intentelo nuevamente')
                                setTimeout(() => {
                                    location.reload();
                                }, 1500);
                            });
                        }
                    })
                }else{
                    axios.post("/admin/inscripcion-taller/deshabilitarCertificado",{ id: inscripcionId})
                    .then(resp => {
                        mensajes(resp, 'Se canceló la solicitud del certificado','Ocurrió un error al solicitar el certificado! Intentelo nuevamente')
                        setTimeout(() => { location.reload(); }, 1500);
                    });
                }
            });
        }

        let entregado_a = document.getElementById('entregado_a'),
            fecha_entregado = document.getElementById('fecha_entregado')
            certificado_id = document.getElementById('certificado_id'),
            mostrarEntrega = document.getElementById('mostrarEntrega');

        function realizarEntrega(e){
            e.preventDefault();
            const data = {
                'entregado_a': entregado_a.value,
                'fecha_entregado': fecha_entregado.value,
                'certificado_id': certificado_id.value,
            }
            axios.post('/admin/certificados-talleres/entregaCertificado', data)
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
    </script>
@stop
