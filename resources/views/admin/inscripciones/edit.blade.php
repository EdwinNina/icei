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
        <a href="{{ route('admin.inscripciones.index') }}"
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
                    <h1 class="text-gray-500 uppercase text-2xl mt-1 mb-3 text-center">Actualizar datos de asignación del alumno</h1>
{{--                     <button type="button"
                        class="btn bg-yellow-500 focus:bg-yellow-600 hover:bg-yellow-600 hover:text-white"
                        onclick="anularInscripcion({{$inscripcion->id}})">Anular Inscripción
                    </button> --}}
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
                        <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200">Detalle de la Carrera o Módulo tomado</h2>
                        <input type="hidden" id="inscripcion_id" value="{{$inscripcion->id}}">
                        <p><span class="font-bold">Codigo:</span> {{$inscripcion->planificacionCarrera->codigo}}</p>
                        <p><span class="font-bold">Carrera:</span> {{ Str::title($inscripcion->modulo->carrera->titulo)}}</p>
                        <p class="obtenerModulo">
                            <span class="font-bold">Módulo:</span>
                            <span>{{$inscripcion->modulo->titulo_completo}}</span>
                        </p>
                        <p><span class="font-bold">Horario:</span> {{$inscripcion->planificacionCarrera->horario->horario_completo}}</p>
                        <p><span class="font-bold">Modalidad:</span> {{$inscripcion->planificacionCarrera->modalidad->nombre}}</p>
                        <p class="costoModulo">
                            <span class="font-bold">Costo del Modulo (Bs):</span>
                            <span>{{$inscripcion->planificacionCarrera->costo_modulo}}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div x-data="{mostrarPagosInscripcion: true, mostrarPagosExamen: false, mostrarPagosCertificado : false, mostrarCambioDeCarrera: false}">
        <h2 class="text-sm uppercase font-bold text-yellow-500 border-b-2 mt-4 border-gray-200">Otras acciones a realizar</h2>
        <div class="flex flex-col md:flex-row md:justify-end md:items-end flex-wrap mt-4">
            <button type="button"
                @click="mostrarPagosInscripcion = !mostrarPagosInscripcion; mostrarPagosCertificado = false; mostrarPagosExamen = false; mostrarCambioDeCarrera = false;"
                class="btn flex justify-center bg-blue-800 focus:border-blue-900 hover:bg-blue-700 hover:text-white"
                x-text="[mostrarPagosInscripcion == true ? 'Ocultar Pagos Inscripcion' : 'Ver Pagos Inscripcion']"></button>
            <button type="button"
                @click="mostrarPagosExamen = !mostrarPagosExamen; mostrarPagosInscripcion = false; mostrarPagosCertificado = false; mostrarCambioDeCarrera = false"
                class="btn mt-4 md:mt-0 md:mx-4 flex justify-center bg-blue-800 focus:border-blue-900 hover:bg-blue-700 hover:text-white"
                x-text="[mostrarPagosExamen == true ? 'Ocultar Pagos Examen 2T' : 'Ver Pagos Examen 2T']"></button>
            <button type="button"
                @click="mostrarPagosCertificado = !mostrarPagosCertificado; mostrarPagosInscripcion = false; mostrarPagosExamen = false; mostrarCambioDeCarrera = false"
                class="btn mt-4 md:mt-0 flex justify-center bg-blue-800 focus:border-blue-900 hover:bg-blue-700 hover:text-white"
                x-text="[mostrarPagosCertificado == true ? 'Ocultar Pagos Certificado' : 'Ver Pagos Certificado']">
            </button>
            <button type="button"
                @click="mostrarCambioDeCarrera = !mostrarCambioDeCarrera; mostrarPagosInscripcion = false; mostrarPagosCertificado= false; mostrarPagosExamen = false"
                class="btn mt-4 md:mt-0 md:ml-4 flex justify-center bg-yellow-500 focus:border-yellow-600 hover:bg-yellow-600 hover:text-white">
                Cambiar Carrera
            </button>
        </div>
        <div x-show="mostrarPagosInscripcion" class="bg-white overflow-hidden my-4 shadow-sm sm:rounded-lg"
            x-transition:enter="transition duration-200 transform ease-out"
            x-transition:enter-start="scale-75"
            x-transition:leave="transition duration-100 transform ease-in"
            x-transition:leave-end="opacity-0 scale-90">
            <div class="px-6 pt-6">
                @include('admin.inscripciones.registrar-pago-inscripcion')
            </div>
        </div>
        <div x-show="mostrarPagosExamen" class="bg-white overflow-hidden my-4 shadow-sm sm:rounded-lg"
            x-transition:enter="transition duration-200 transform ease-out"
            x-transition:enter-start="scale-75"
            x-transition:leave="transition duration-100 transform ease-in"
            x-transition:leave-end="opacity-0 scale-90">
            <div class="px-6 pt-6">
                @include('admin.inscripciones.registrar-pago-2t')
            </div>
        </div>
        <div x-show="mostrarPagosCertificado" class="bg-white overflow-hidden my-4 shadow-sm sm:rounded-lg"
            x-transition:enter="transition duration-200 transform ease-out"
            x-transition:enter-start="scale-75"
            x-transition:leave="transition duration-100 transform ease-in"
            x-transition:leave-end="opacity-0 scale-90">
            <div class="px-6 pt-6">
                @include('admin.inscripciones.registrar-pago-certificado')
            </div>
        </div>
        <div x-show="mostrarCambioDeCarrera" class="bg-white overflow-hidden my-4 shadow-sm sm:rounded-lg"
            x-transition:enter="transition duration-200 transform ease-out"
            x-transition:enter-start="scale-75"
            x-transition:leave="transition duration-100 transform ease-in"
            x-transition:leave-end="opacity-0 scale-90">
            <div class="px-6 pt-6">
                @include('admin.inscripciones.cambio-carrera')
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

/*         function anularInscripcion(id){
            Swal.fire({
                title: '¿Estas seguro de anular esta inscripción?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, anular!',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.value) {
                    axios.post("/admin/inscripciones/anular",{ id: id })
                    .then( resp => {
                        if(resp.data === 'good'){
                            toastr.success('Correcto', 'Inscripción anulada correctamente');
                            window.location.href = "{{ route('admin.inscripciones.index')}}";
                        }else{
                            toastr.error('Incorrecto', 'Hubo un error, intentelo de nuevo!');
                        }
                    })
                }
                if(result.dismiss === "cancel") {
                    toastr.info('Se cancelo la accion de deshabilitación');
                }
            })
        }*/

        const btnHabilitar2t = document.getElementById('habilitar2t'),
            btnSolicitarFotos = document.getElementById('solicitarFotos'),
            btnHabilitarCertificado = document.getElementById('habilitarCertificado'),
            inscripcionId = document.getElementById('inscripcion_id').value,
            estudianteId = document.getElementById('estudiante').value;

        if (btnHabilitar2t !== null) {
            btnHabilitar2t.addEventListener('change', () => {
                if(btnHabilitar2t.checked){
                    Swal.fire({
                    title: 'Ingrese el costo del examen de 2T',
                    input: 'number',
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    showLoaderOnConfirm: false,
                    allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                        if(result.dismiss === "cancel" || result.dismiss === "backdrop") {
                            toastr.info('Se canceló la habilitación del 2T');
                            btnHabilitar2t.checked = false;
                            return;
                        }else{
                            if (result.value !== "" ) {
                                axios.post("/admin/inscripciones/habilitar2t",{ id: inscripcionId, monto: result.value })
                                .then(resp => {
                                    mensajes(resp, 'Examen 2t habilitado correctamente!','Ocurrio un error al habilitar el 2t! Intentelo nuevamente')
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1500);
                                });
                            }else{
                                toastr.warning('Ingrese un monto valido');
                                btnHabilitar2t.checked = false;
                            }
                        }
                    })
                }else{
                    axios.post("/admin/inscripciones/deshabilitar2t",{ id: inscripcionId})
                    .then(resp => {
                        mensajes(resp, 'Examen 2t deshabilitado correctamente!','Ocurrio un error al deshabilitar el 2t! Intentelo nuevamente')
                        setTimeout(() => { location.reload(); }, 1500);
                    });
                }
            });
        }

        if (btnHabilitarCertificado !== null) {
            btnHabilitarCertificado.addEventListener('change', () => {
                if(btnHabilitarCertificado.checked){
                    Swal.fire({
                    title: 'INGRESE EL COSTO DEL CERTIFICADO',
                    input: 'number',
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    showLoaderOnConfirm: false,
                    allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                        if(result.dismiss === "cancel" || result.dismiss === "backdrop") {
                            toastr.info('Se canceló la generación del certificado');
                            btnhabilitarCertificado.checked = false;
                            return;
                        }else{
                            if (result.value !== "" ) {
                                let data = {
                                    id: inscripcionId,
                                    monto: result.value,
                                    estudiante: estudianteId,
                                }
                                axios.post("/admin/inscripciones/habilitarCertificado", data)
                                .then(resp => {
                                    mensajes(resp, 'Habilitación para generación del certificado correctamente!','Ocurrio un error al habilitar el Certificado! Intentelo nuevamente')
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1500);
                                });
                            }else{
                                toastr.warning('Ingrese un monto valido');
                                btnhabilitarCertificado.checked = false;
                            }
                        }
                    })
                }else{
                    axios.post("/admin/inscripciones/deshabilitarCertificado",{ id: inscripcionId})
                    .then(resp => {
                        mensajes(resp, 'Se deshabilitó la generación del certificado correctamente!','Ocurrio un error al deshabilitar el 2t! Intentelo nuevamente')
                        setTimeout(() => { location.reload(); }, 1500);
                    });
                }
            });
        }

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
                        if(result.dismiss === "cancel" || result.dismiss === "backdrop") {
                            toastr.info('Se canceló la aceptación de fotografías');
                            btnSolicitarFotos.checked = false;
                            return;
                        }else{
                            axios.post("/admin/certificados/solicitarFotos", {id : inscripcionId})
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
                    axios.post("/admin/certificados/cancelarSolicitarFotos",{ id: inscripcionId})
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
            axios.post('/admin/inscripciones/reporte-pago', {id:id})
                .then(resp => {
                    window.open("{{asset('/')}}" + "Comprobante_de_Ingreso.pdf", "_blank");
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
            axios.post('/admin/certificados/entregaCertificado', data)
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

        function anularPago(e,id,opcion){
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
                            switch (opcion) {
                                case "inscripcion":
                                    axios.post('/admin/inscripciones/cambiarEstadoPagoInscripcion',{
                                        idPago:id,
                                        idInscripcion:inscripcionId,
                                        opcion: 'inscripcion'
                                    })
                                    .then(resp => {
                                        toastr.success('Correcto', 'Los registro de pago se anuló correctamente');
                                        setTimeout(() => {
                                            location.reload();
                                        }, 1500);
                                    });
                                break;
                                case "examen":
                                    axios.post('/admin/inscripciones/cambiarEstadoPagoInscripcion',{
                                        idPago:id,
                                        idInscripcion:inscripcionId,
                                        opcion: 'examen'
                                    })
                                    .then(resp => {
                                        toastr.success('Correcto', 'Los registro de pago se anuló correctamente');
                                        setTimeout(() => {
                                            location.reload();
                                        }, 1500);
                                    });
                                break;
                                case "certificado":
                                    axios.post('/admin/inscripciones/cambiarEstadoPagoInscripcion',{
                                        idPago:id,
                                        idInscripcion:inscripcionId,
                                        opcion: 'certificado'
                                    })
                                    .then(resp => {
                                        toastr.success('Correcto', 'Los registro de pago se anuló correctamente');
                                        setTimeout(() => {
                                            location.reload();
                                        }, 1500);
                                    });
                                break;
                            }
                        }else{
                            toastr.error('Incorrecto', 'Hubó un error, inténtelo de nuevo!');
                        }
                    });
                }
            })
        }
    </script>
@stop
