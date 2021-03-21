@extends('adminlte::page')

@section('title', 'Crear Planificacion')

@section('content')
    <div class="w-full pb-4">
        <div class="bg-white shadow-sm overflow-hidden border-b rounded border-gray-200 px-8">
            <h1 class="uppercase text-2xl my-4 text-gray-500 text-center">Registrar Planificacion del Módulo</h1>
            <div class="flex justify-between my-5">
                <h2 class="text-gray-600"><span class="font-bold">Carrera:</span> {{$planificacion->carrera->titulo}}</h2>
                <p class="text-gray-600"><span class="font-bold">Horario: </span> {{$planificacion->horario->dias}}/{{$planificacion->horario->hora_fin}} - {{$planificacion->horario->hora_fin}}</p>
            </div>
            <form action="{{ route('admin.planificacionModulo.store') }}" method="post">
                @csrf
                <input type="hidden" name="planificacion_id" value="{{$planificacion->id}}">
                <div class="table-responsive">
                    <table class="table-tail">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="table-tail-th">Módulos</th>
                                    <th scope="col" class="table-tail-th">Horas</th>
                                    <th scope="col" class="table-tail-th">Fecha de Inicio</th>
                                    <th scope="col" class="table-tail-th">Fecha de Finalizacion</th>
                                    <th scope="col" class="table-tail-th">Observaciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($modulos as $key => $item)
                                <tr>
                                    <td class="w-5">
                                        <div class="text-sm text-center text-gray-900">{{ Str::substr($item->titulo, 0, 45) }}</div>
                                        <input type="hidden" name="registros[{{$key}}][modulo_id]" value="{{$item->id}}">
                                    </td>

                                    <td class="table-tail-td">
                                        <div class="text-sm text-gray-900">{{ $item->cargaHoraria }} Horas</div>
                                    </td>
                                    <td>
                                        <div class="text-sm text-gray-900">
                                            <x-jet-input type="date" name="registros[{{$key}}][fecha_inicio]" id=""/>
                                            <x-jet-input-error for="registros.*.fecha_inicio" class="my-2" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-sm text-gray-900">
                                            <x-jet-input type="date" name="registros[{{$key}}][fecha_fin]" id=""/>
                                            <x-jet-input-error for="registros.*.fecha_fin" class="my-2" />
                                        </div>
                                    </td>
                                    <td>
                                        <textarea name="registros[{{$key}}][observaciones]" id=""></textarea>
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
