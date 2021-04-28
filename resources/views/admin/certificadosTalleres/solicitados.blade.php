@extends('adminlte::page')

@section('title', 'Certificados Solicitados')

@section('content_header')
@stop

@section('content')
    <div>
        <div class="w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-gray-500 uppercase text-2xl mt-1 mb-3 text-center">Solicitud de Certificados de talleres</h1>
                <div class="shadow-sm border-b overflow-hidden rounded border-gray-200 sm:rounded-lg">
                    @if ($solicitados->count())
                        <div class="table-responsive">
                            <table class="table-tail">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="text-xs font-medium pl-2 text-gray-500 uppercase w-40 p-2">Nombre del Estudiante</th>
                                    <th scope="col" class="text-xs font-medium pl-4 text-gray-500 uppercase w-40">Taller</th>
                                    <th scope="col" class="text-xs font-medium pl-2 text-gray-500 uppercase text-center w-20 pr-4">Carga Horaria</th>
                                    <th scope="col" class="text-xs font-medium pl-2 text-gray-500 uppercase w-40">Docente</th>
                                    <th scope="col" class="table-tail-th text-center">Horario</th>
                                    <th scope="col" class="table-tail-th text-center">Impreso</th>
                                    <th scope="col" class="table-tail-thr text-center">Acciones</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 relative">
                                    @foreach ($solicitados as $index => $item)
                                        <tr>
                                            <td class="w-40 px-3">
                                                <div class="text-sm text-gray-900">{{$item->estudiante->nombre_completo}}</div>
                                            </td>
                                            <td class="w-40 pl-4 pb-2">
                                                <div class="text-sm text-gray-900">
                                                    {{ Str::title($item->planificacionTaller->taller->nombre)}}
                                                </div>
                                            </td>
                                            <td class="w-20 text-center pr-4">
                                                <div class="text-sm text-gray-900">
                                                    {{ Str::title($item->planificacionTaller->carga_horaria)}}
                                                </div>
                                            </td>
                                            <td class="">
                                                <div class="text-sm text-gray-900">{{$item->planificacionTaller->docente->nombre_completo}}</div>
                                            </td>
                                            <td class="table-tail-td text-center">
                                                <div class="text-sm text-gray-900">
                                                    {{ Str::title($item->planificacionTaller->horario->dias)}}
                                                </div>
                                                <div class="text-sm text-gray-800">
                                                    {{$item->planificacionTaller->horario->hora_inicio->format('H:i')}} - {{$item->planificacionTaller->horario->hora_fin->format('H:i')}}
                                                </div>
                                            </td>
                                            <td class="table-tail-td text-center">
                                                <div class="text-sm text-gray-900">
                                                    <div class="custom-control ml-3 custom-switch" onchange="activarImpresion(event, {{$item->id}})">
                                                        <input type="checkbox" class="custom-control-input" id="estadoImpresion_{{$index}}"
                                                            {{$item->impresion == "1" ? 'checked' : ''}}>
                                                        <label class="custom-control-label uppercase" for="estadoImpresion_{{$index}}"></label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="table-tail-td text-center text-sm font-medium">
                                                <a href="{{ route('admin.certificadosTalleres.generarCertificado', $item->id) }}"
                                                    target="_blank"
                                                    class="btn text-sm bg-blue-600 focus:border-blue-800 hover:bg-blue-700 hover:text-white">
                                                    Generar Certificado
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="flex justify-center py-4">
                            <span class="font-bold uppercase text-red-500 text-sm">Aún no existen solicitudes de certificados</span>
                        </div>
                    @endif
                </div>
                <div class="py-2">
                    {{ $solicitados->links() }}
                </div>
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
        function activarImpresion(e, id){
            if(e.target.checked){
                axios.post("/admin/certificados-talleres/activarImpresion", {id : id})
                .then( resp => {
                    if(resp.status === 200){
                        toastr.success('Correcto', 'La habilitación para la impresión fue correcta');
                    }else{
                        toastr.error('Incorrecto', 'Hubó un error, inténtelo de nuevo!');
                    }
                })
            }else{
                axios.post("/admin/certificados-talleres/desactivarImpresion", {id : id})
                .then( resp => {
                    if(resp.status === 200){
                        toastr.success('Correcto', 'La deshabilitación para la impresión fue correcta');
                    }else{
                        toastr.error('Incorrecto', 'Hubó un error, inténtelo de nuevo!');
                    }
                })
            }
        }
    </script>
@stop
