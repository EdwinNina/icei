@extends('adminlte::page')

@section('title', 'Crear Planificacion')

@section('content')
    <div class="w-full pb-4">
        <div class="bg-white shadow-sm overflow-hidden border-b rounded border-gray-200 px-8">
            <h1 class="uppercase text-2xl my-4 text-gray-500 text-center">Registrar Planificacion del Módulo</h1>
            <div class="flex justify-between my-4">
                <div>
                    <p class="text-gray-600"><span class="font-bold">Codigo:</span> {{$planificacion->codigo }}</p>
                    <p class="text-gray-600"><span class="font-bold">Carrera: </span> {{ Str::title($planificacion->carrera->titulo)}}</p>
                </div>
                <div>
                    <p class="text-gray-600"><span class="font-bold">Docente: </span> {{$planificacion->docente->nombre_completo}}</p>
                    <p class="text-gray-600"><span class="font-bold">Horario: </span> {{$planificacion->horario->horario_completo}} </p>
                </div>
            </div>
            <form action="{{ route('admin.planificacionModulo.store') }}" method="post">
                @csrf
                <input type="hidden" name="planificacion_id" value="{{$planificacion->id}}">
                <div class="table-responsive">
                    <table class="table-tail">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="table-tail-th">Módulos</th>
                                    <th scope="col" class="text-xs font-medium pl-2 text-gray-500 uppercase">Horas</th>
                                    <th scope="col" class="table-tail-th text-center">Aula</th>
                                    <th scope="col" class="table-tail-th">Fecha de Inicio</th>
                                    <th scope="col" class="table-tail-th">Fecha de Finalizacion</th>
                                    <th scope="col" class="table-tail-th">Observaciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($modulos as $key => $item)
                                <tr>
                                    <td class="w-5">
                                        <div class="text-sm text-center text-gray-900">{{ Str::title(Str::substr($item->titulo, 0, 45)) }}</div>
                                        <input type="hidden" name="registros[{{$key}}][modulo_id]" value="{{$item->id}}">
                                    </td>
                                    <td class="w-12">
                                        <div class="text-sm text-center text-gray-900">{{ $item->cargaHoraria }}</div>
                                    </td>
                                    <td class="w-auto pr-2">
                                        <select name="registros[{{$key}}][aula_id]" class="custom-select">
                                            <option value="" selected>Seleccionar</option>
                                            @foreach ($aulas as $aula)
                                                <option value="{{$aula->id}}">{{$aula->curso_completo}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <div class="text-sm text-gray-900">
                                            <x-jet-input type="date" name="registros[{{$key}}][fecha_inicio]" class="w-44"/>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-sm text-gray-900">
                                            <x-jet-input type="date" name="registros[{{$key}}][fecha_fin]" class="w-44"/>
                                        </div>
                                    </td>
                                    <td>
                                        <textarea class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 mr-2 py-2 px-3"
                                        name="registros[{{$key}}][observaciones]"></textarea>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="my-4 flex justify-end items-center">
                    <x-back-button href="{{route('admin.planificacionCarrera.index')}}">Volver</x-back-button>
                    <x-jet-danger-button type="submit" class="ml-2">Registrar</x-jet-danger-button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    @trixassets
@stop
@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
@stop
