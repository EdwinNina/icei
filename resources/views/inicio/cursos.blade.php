@extends('layouts.layout')

@section('hero')
    <x-hero image="images/hero2.jpg">
        <x-slot name="titulo1">Conoce nuestros cursos</x-slot>
        <x-slot name="titulo2">y especializate en alguno de ellos</x-slot>
        <x-slot name="subtitulo">Ofrecemos una gama variada de cursos los cuales van especizalidados en el area que tu requiras</x-slot>
    </x-hero>
@endsection

@section('content')
<section class="text-gray-400 body-font">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-wrap w-full mb-20">
            <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-800">Todos nuestros cursos</h1>
            <div class="h-1 w-20 bg-yellow-500 rounded"></div>
            </div>
            <p class="lg:w-1/2 w-full leading-relaxed text-gray-700 text-opacity-90">Mayoria de nuestros cursos cuentan con muchos
            módulos enfocados en cada tema para llevarte una enseñanza muy profesional</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 gap-4">
            @foreach ($carreras as $carrera)
                <div class="w-full py-6">
                    <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                        <div class="bg-cover bg-center h-56 p-4" style="background-image: url({{Storage::url('carreraPortadas/' . $carrera->portada)}})">
                        </div>
                        <div class="p-4">
                            <p class="uppercase text-xs tracking-wide font-bold text-yellow-500">{{ $carrera->titulo }}</p>
                            <p class="text-sm text-gray-900 mt-2">Categoria: {{$carrera->categoria->nombre}}</p>
                            <p class="text-sm text-gray-900">Cuenta con {{$carrera->cargaHoraria}} horas académicas</p>
                        </div>
                        <a href="{{route('detalleCurso',$carrera)}}" class="btn mt-2 flex justify-center w-full bg-red-500 focus:border-red-600 hover:bg-red-600 hover:underline">
                            Ver Curso
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
</div>
  </section>
@endsection
