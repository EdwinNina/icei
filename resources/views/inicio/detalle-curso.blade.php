@extends('layouts.layout')

@section('hero')
    <div class="bg-indigo-700 h-auto md:h-80 mb-10">
        <div class="w-full md:max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-6 p-8">
                    <section class="col-span-1 md:col-span-3">
                        <img src="{{Storage::url('carreraPortadas/'. $carrera->portada)}}" alt="{{$carrera->titulo}}"
                        class="h-60 md:h-80 w-full object-cover object-center rounded-md shadow-lg">
                    </section>
                    <section class="col-span-1 md:col-span-3 flex items-center ml-0 md:ml-10">
                        <div class="text-white mt-4 md:mt-0">
                            <h1 class="text-4xl font-bold uppercase">{{$carrera->titulo}}</h1>
                            <p class="text-xl">Requisitos: <span>{{ Str::title($carrera->requisitos) }}</span></p>
                            <p class="text-xl">Categoria: <span>{{ $carrera->categoria->nombre }}</span></p>
                            <p class="text-xl">Carga horaria: <span>{{ $carrera->cargaHoraria }} horas académicas</span></p>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="w-full md:max-w-7xl mx-auto px-8">
        @if ($carrera->descripcion)
            <p class="font-bold mt-0 md:mt-14">Breve descripcion del curso: </p>
            <p>{!! $carrera->descripcion !!}</p>
        @endif
        <div class="my-5">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                <section class="col-span-1 md:col-span-9 order-2 md:order-1">
                    <h2 class="text-2xl uppercase font-bold text-gray-700">Modulos del curso</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 gap-4 mt-5">
                        @if (count($carrera->modulos))
                            @foreach ($carrera->modulos as $modulo)
                                <div class="h-full border-2 border-opacity-60 rounded-lg shadow-lg overflow-hidden">
                                    <img class="lg:h-48 md:h-36 w-full object-cover object-center"
                                        src="{{Storage::url('moduloPortadas/' . $modulo->portada)}}" alt="blog">
                                    <div class="p-6 bg-white">
                                        <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">Version: {{$modulo->version}}</h2>
                                        <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ Str::title($modulo->titulo) }}</h1>
                                        <span class="font-light text-sm text-gray-700">Carga horaria: {{$modulo->cargaHoraria}} horas académicas</span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="flex justify-center">
                                <span class="font-bold uppercase text-blue-500">La carrera aún no tiene módulos</span>
                            </div>
                        @endif
                    </div>
                </section>
                <section class="col-span-1 md:col-span-3 order-1 md:order-2 mt-3">
                    @if ($carrera->planificacionCarrera)
                        @foreach ($carrera->planificacionCarrera as $index => $plan)
                            @if ($index == 0)
                                <div class="bg-white rounded shadow-md p-4">
                                    @php
                                        $docente = $plan->docente;
                                    @endphp
                                    <div class="flex items-center">
                                        <img src="{{Storage::url('docentesAvatar/'. $docente->perfil->foto)}}" alt="{{$docente->nombre}}"
                                        class="h-14 w-14 ring-2 ring-gray-400 object-cover object-center rounded-full shadow-md">
                                        <div>
                                            <p class="ml-3 font-bold text-gray-700">Docente: </p>
                                            <p class="ml-3 font-bold text-gray-600">{{$docente->nombre_completo}}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('docente.perfil.show', $docente->perfil->id) }}" class="btn mt-2 flex justify-center w-full bg-red-500 focus:border-red-600 hover:bg-red-600">
                                        Ver perfil
                                    </a>
                                </div>

                                @endif
                            @endforeach
                        @else
                        <div class="bg-white rounded shadow-md p-4">
                            <p class="text-gray-400">El docente aún no registro su perfil </p>
                        </div>
                        @endif
                </section>
            </div>
        </div>
    </div>
@endsection
