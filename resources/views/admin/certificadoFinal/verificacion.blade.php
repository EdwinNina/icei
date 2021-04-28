@extends('adminlte::page')

@section('title', 'Certificado Finales')

@section('content_header')
@stop

@section('content')
    <div class="w-full">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 my-4">
            <h1 class="text-gray-500 uppercase text-2xl mb-4 text-center">Datos de la Carrera y Estudiante</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 mb-3">Datos del estudiante</h2>
                    <p>
                        <span class="font-bold">Nombre:</span>
                        <span>{{$estudiante->nombre_completo}}</span></p>
                    <p>
                        <span class="font-bold">Cédula de identidad:</span>
                        <span>{{$estudiante->carnet}} {{$estudiante->expedido}}</span>
                    </p>
                </div>
                <div>
                    <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 mb-3">Detalle de la Carrera</h2>
                    <p>
                        <span class="font-bold">Carrera:</span>
                        <span>{{ Str::title($carrera->titulo) }}</span>
                    </p>
                    <p>
                        <span class="font-bold">Carga Horaria:</span>
                        <span>{{ $carrera->cargaHoraria }} Horas Académicas</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            @if (count($encontradosPlanificacionNotas))
            <h1 class="text-gray-500 uppercase text-2xl mb-4 text-center">Módulos pasados por el estudiante</h1>
            <div class="shadow-sm overflow-hidden border-b rounded border-gray-200 sm:rounded-lg">
                <div class="table-responsive">
                    <table class="table-tail">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="table-tail-th">Módulos</th>
                                <th class="table-tail-th text-center">Nota1</th>
                                <th class="table-tail-th text-center">Nota2</th>
                                <th class="table-tail-th text-center">Nota Final</th>
                                <th class="table-tail-th text-center">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($encontradosPlanificacionNotas as $index => $nota)
                                @if (!is_null($nota))
                                    <tr>
                                        <td class="table-tail-td">{{$nota->planificacionModulo->modulo->titulo_completo}}</td>
                                        <td class="table-tail-td text-center">{{$nota->nota_1}}</td>
                                        <td class="table-tail-td text-center">{{$nota->nota_2}}</td>
                                        <td class="table-tail-td text-center">{{$nota->nota_final}}</td>
                                        <td class="table-tail-td text-center">{{$nota->nota_final >= $nota_minima_aprobacion ? 'Aprobado': 'Reprobado'}}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="table-tail-td">El estudiante aún no completo el modulo {{$index + 1}}</td>
                                        <td class="table-tail-td text-center">Sin nota</td>
                                        <td class="table-tail-td text-center">Sin nota</td>
                                        <td class="table-tail-td text-center">Sin nota final</td>
                                        <td class="table-tail-td text-center">No asignado</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @php $contador = 0; @endphp
            @foreach ($encontradosPlanificacionNotas as $index => $nota)
                @if (is_null($nota))
                    @php $contador++; @endphp
                @endif
            @endforeach
            @if ($contador == 0)
                @if ($carrera->certificado)
                    <p class="mt-3 text-gray-500 font-bold uppercase">Lista de certificados obtenidos</p>
                    <ul class="mt-1">
                        @foreach ($carrera->certificado as $index => $certificado)
                            @if ($index == 0)
                                <li>
                                    <a
                                        href="{{ route('admin.certificadoFinal.detalleCertificado', $certificado->id) }}"
                                        class="text-blue-500 hover:underline hover:text-blue-600"
                                    >Volver al Detalle del Certificado Original</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif
                <div x-data="{mostrarFormulario: false}">
                    <div class="flex justify-end mt-4">
                        <button type="button"
                        @click="mostrarFormulario = !mostrarFormulario;"
                        class="btn flex justify-center bg-blue-800 focus:border-blue-900 hover:bg-blue-700 hover:text-white"
                        x-text="[mostrarFormulario == true ? 'Ocultar Formulario Solicitud' : 'Ver Formulario Solicitud']"></button>
                    </div>
                    <div x-show="mostrarFormulario"
                        x-transition:enter="transition duration-200 transform ease-out"
                        x-transition:enter-start="scale-75"
                        x-transition:leave="transition duration-100 transform ease-in"
                        x-transition:leave-end="opacity-0 scale-90">
                        <form action="{{route('admin.certificadoFinal.guardarCertificado')}}" method="post">
                            @csrf
                            <input type="hidden" name="carrera_id" value="{{$carrera->id}}">
                            <input type="hidden" name="estudiante_id" value="{{$estudiante->id}}">
                            <input type="hidden" name="planificacion_carrera_id" value="{{$planificacion_carrera_id}}">
                            <div class="flex justify-center items-start p-4 rounded shadow w-2/3 mt-3 bg-gray-100 mx-auto">
                                <div>
                                    <x-required-label for="costo" value="Ingrese el Costo del Certificado" />
                                    <x-jet-input type="number" id="costo" name="costo" />
                                    <x-jet-input-error for="costo" />
                                </div>
                                <div class="mx-4">
                                    <x-required-label for="solicitud" value="Habilite la solicitud" />
                                    <label for="solicitud" class="flex items-center">
                                        <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                            name="solicitud" id="solicitud" value="1">
                                    </label>
                                    <x-jet-input-error for="solicitud" />
                                </div>
                                <div>
                                    <x-jet-danger-button type="submit">Registrar</x-jet-danger-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
            <div class="flex justify-end mt-4">
                <x-back-button href="{{ route('admin.certificadoFinal.index') }}">Volver</x-back-button>
            </div>
            @else
                <div class="flex justify-center items-center">
                    <span class="font-bold text-red-500">No existen registros con esos criterios de búsqueda</span>
                </div>
                <div class="flex justify-end mt-4">
                    <x-back-button href="{{ route('admin.certificadoFinal.index') }}">Volver</x-back-button>
                </div>
            @endif
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@stop

@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>

        const btnSolicitarCertificado = document.getElementById('solicitarCertificado'),
            estudiante_id = document.getElementById('estudiante_id').value,
            carrera_id = document.getElementById('carrera_id').value;

        btnSolicitarCertificado.addEventListener('change', () => {
            if(btnSolicitarCertificado.checked){
                Swal.fire({
                title: 'Ingrese el costo del Certificado',
                input: 'number',
                showCancelButton: true,
                confirmButtonText: 'Guardar',
                showLoaderOnConfirm: false,
                allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if(result.dismiss === "cancel") {
                        toastr.info('Se canceló la solicitud del Certificado');
                        btnSolicitarCertificado.checked = false;
                        return;
                    }else{
                        if (result.value !== "" ) {
                            let data = {
                                estudiante_id,
                                carrera_id,
                                total_certificado: result.value
                            }
                            axios.post("/admin/certificados-final/guardarCertificado",data)
                            .then(resp => {});
                        }else{
                            toastr.warning('Ingrese un monto valido');
                            btnSolicitarCertificado.checked = false;
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
    </script>
@stop
