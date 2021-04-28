@extends('adminlte::page')

@section('title', 'Estudiantes inscritos')

@section('content_header')
@stop

@section('content')
    @if (session('message'))
        <div class="bg-green-500 border-l-4 px-5 py-2 rounded mb-3 border-green-600">
            <span class="text-white text-center">{{session('message')}}</span>
        </div>
    @endif

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h1 class="text-gray-500 uppercase text-2xl text-center">Editar Centralizador de Notas</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 my-4 gap-4">
            <p><span class="font-bold">Docente:</span> <span>{{$planificacionModulo->planificacionCarrera->docente->nombre_completo}}</span></p>
            <p><span class="font-bold">Fecha inicio:</span>
                <span>{{ Carbon\Carbon::parse($planificacionModulo->fecha_inicio)->format('d-m-Y')}}</span>
            </p>
            <p><span class="font-bold">Carrera:</span> <span>{{ Str::title($planificacionModulo->planificacionCarrera->carrera->titulo) }}</span></p>
            <p><span class="font-bold">Fecha fin: </span><span>{{Carbon\Carbon::parse($planificacionModulo->fecha_fin)->format('d-m-Y')}}</span></p>
            <p><span class="font-bold">Módulo:</span> <span>{{$planificacionModulo->modulo->titulo_completo}}</span></p>
            <p><span class="font-bold">Horario:</span>
                <span>{{$planificacionModulo->planificacionCarrera->horario->hora_inicio->format('H:i')}} - {{$planificacionModulo->planificacionCarrera->horario->hora_fin->format('H:i')}}</span>
            </p>
            <p><span class="font-bold">Días:</span>
                <span>{{Str::title($planificacionModulo->planificacionCarrera->horario->dias)}}</span>
            </p>
            <p>
                <span class="font-bold">Aula:</span>
                <span>{{$planificacionModulo->aula == null ? 'Aula no asignada' : $planificacionModulo->aula->curso_completo}}</span>
            </p>
        </div>
        <div class="shadow-sm overflow-hidden border-b rounded border-gray-200 sm:rounded-lg my-4">
            <form action="{{ route('admin.notas.inscritos.store') }}" method="post">
                @csrf
                <input type="hidden" value="{{$configuracion->nota_minima_aprobacion}}" id="nota_minima">
                <div class="table-responsive">
                    <table class="table-tail">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="table-tail-th">Carnet</th>
                                <th class="table-tail-th">Nombre del Estudiante</th>
                                <th class="table-tail-th w-20">Form (60%)</th>
                                <th class="table-tail-th w-20">Sum (40%)</th>
                                <th class="table-tail-th w-20">Total</th>
                                <th class="table-tail-thr text-center">Observacion</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                $docente_id = $planificacionModulo->planificacionCarrera->docente->id;
                                $habilitar = $planificacionModulo->habilitar_notas;
                                $usuario = Auth::user()->usuarioGeneral;
                            @endphp
                            @foreach ($verificacion as $index => $item)
                                <input type="hidden" name="registros[{{$index}}][id]" value="{{$item->id}}">
                                <input type="hidden" name="registros[{{$index}}][planificacion_modulo_id]" value="{{$item->planificacion_modulo_id}}">
                                <tr>
                                    <td class="table-tail-td">
                                        <div class="text-sm text-gray-900">{{ $item->estudiante->carnet}} {{ $item->estudiante->expedido}}</div>
                                        <input type="hidden" name="registros[{{$index}}][estudiante_id]" value="{{$item->estudiante->id}}">
                                    </td>
                                    <td>
                                        <div class="text-sm text-gray-900">{{Str::ucfirst($item->estudiante->nombre_completo)}}</div>
                                    </td>
                                    @if ($usuario !== null)
                                        <td class="text-center">
                                            @if ($usuario->generable_id === $docente_id && $habilitar)
                                                <x-jet-input type="number" name="registros[{{$index}}][nota_1]" class="w-16 text-center"
                                                value="{{$item->nota_1}}" onkeyup="sumarNotaPrimero(this)" min="0" max="60"/>
                                            @else
                                                <span class="text-xs font-bold text-gray-600">{{$item->nota_1}}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($usuario->generable_id === $docente_id && $habilitar)
                                                <x-jet-input type="number" name="registros[{{$index}}][nota_2]" class="w-16 text-center"
                                                value="{{$item->nota_2}}" onkeyup="sumarNotaSegundo(this)" min="0" max="40"/>
                                            @else
                                                <span class="text-xs font-bold text-gray-600">{{$item->nota_2}}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($usuario->generable_id === $docente_id && $habilitar)
                                                <x-jet-input type="text" name="registros[{{$index}}][nota_final]"
                                                class="w-16 text-center" value="{{$item->nota_final}}" readonly/>
                                            @else
                                                <span class="text-xs font-bold text-gray-600">{{$item->nota_final}}</span>
                                            @endif
                                        </td>
                                    @else
                                        <td class="text-center">
                                            <x-jet-input type="number" name="registros[{{$index}}][nota_1]" class="w-16 text-center"
                                            value="{{$item->nota_1}}" onkeyup="sumarNotaPrimero(this)" min="0" max="60"/>
                                        </td>
                                        <td class="text-center">
                                            <x-jet-input type="number" name="registros[{{$index}}][nota_2]" class="w-16 text-center"
                                            value="{{$item->nota_2}}" onkeyup="sumarNotaSegundo(this)" min="0" max="40"/>
                                        </td>
                                        <td class="text-center">
                                            <x-jet-input type="text" name="registros[{{$index}}][nota_final]"
                                            class="w-16 text-center" value="{{$item->nota_final}}" readonly/>
                                        </td>
                                    @endif
                                    <td class="text-center">
                                        @if ($item->nota_final == null)
                                            <span class="font-bold text-sm">Sin nota asignada</span>
                                        @else
                                            <span class="text-sm font-bold {{$item->nota_final >= $configuracion->nota_minima_aprobacion ? 'text-green-500' : 'text-red-500'}}">
                                                {{$item->nota_final >= $configuracion->nota_minima_aprobacion ? 'Aprobado' : 'Reprobado'}}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="my-4 px-6 flex justify-end items-center">
                    <x-back-button href="{{ route('docente.notas.index')}}">Volver</x-back-button>
                    <x-jet-danger-button type="submit" class="ml-2">Registrar</x-jet-danger-button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
@stop
@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        const nota_minima = document.getElementById('nota_minima').value;
        function sumarNotaPrimero(e){
            let nota1 = parseInt(e.value);
            let nota2 = parseInt(e.parentNode.nextElementSibling.firstElementChild.value);
            let nota_final = e.parentNode.nextElementSibling.nextElementSibling.firstElementChild;
            let span = nota_final.parentNode.nextElementSibling.firstElementChild;
            let total = 0;
            if(!isNaN(nota1)){
                if (nota1 > 60) {
                    Swal.fire({
                        title: 'Oops...',
                        text: 'El valor maximo para esta nota es de 60, Intentalo de nuevo',
                    })
                    e.value = 60;
                    nota1 = parseInt(e.value);
                } else if (nota1<0) {
                    Swal.fire({
                        title: 'Oops...',
                        text: 'No puedes ingresar números negativos, Intentalo de nuevo',
                    })
                    e.value = 0;
                    nota1 = parseInt(e.value);
                }
            }
            if (!nota1) {
                total = nota2;
            }else{
                total = nota1 + nota2;
            }
            if(total >= nota_minima){
                span.textContent = "Aprobado"
                span.classList.remove('text-red-500');
                span.classList.add('text-green-500');
            }else{
                span.textContent = "Reprobado";
                span.classList.remove('text-green-500');
                span.classList.add('text-red-500');
            }
            nota_final.value = total.toString();
        }
        function sumarNotaSegundo(e){
            let nota1 = parseInt(e.parentNode.previousElementSibling.firstElementChild.value);
            let nota2 = parseInt(e.value);
            let nota_final = e.parentNode.nextElementSibling.firstElementChild;
            let span = nota_final.parentNode.nextElementSibling.firstElementChild;
            let total = 0;
            if(!isNaN(nota2)){
                if (nota2 > 40) {
                    Swal.fire({
                        title: 'Oops...',
                        text: 'El valor maximo para esta nota es de 40, Intentalo de nuevo',
                    })
                    e.value = 40;
                    nota1 = parseInt(e.value);
                    return;
                } else if (nota2<0) {
                    Swal.fire({
                        title: 'Oops...',
                        text: 'No puedes ingresar números negativos, Intentalo de nuevo',
                    })
                    e.value = 0;
                    nota2 = parseInt(e.value);
                }
            }
            if (!nota2) {
                total = nota1;
            }else{
                total = nota1 + nota2;
            }
            if(total >= nota_minima){
                span.textContent = "Aprobado"
                span.classList.remove('text-red-500');
                span.classList.add('text-green-500');
            }else{
                span.textContent = "Reprobado";
                span.classList.remove('text-green-500');
                span.classList.add('text-red-500');
            }

            nota_final.value=total.toString();
        }
    </script>
@stop
