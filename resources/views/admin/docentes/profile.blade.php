@extends('layouts.layout')

@section('content')
<div class="py-8 mb-20">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session('message'))
        <div class="bg-green-500 border-l-4 px-5 py-2 rounded mb-3 border-green-600">
            <span class="text-white text-center">{{session('message')}}</span>
        </div>
        @endif
        <div class="overflow-hidden">
            <div class="p-6">
                <h1 class="text-2xl text-center uppercase font-bold mb-2">Docente {{Str::title($perfil->docente->nombre)}}</h1>
                <div class="flex flex-col flex-wrap sm:flex-row sm:justify-between sm:items-center">
                    <figure>
                        <img src="{{ Storage::url('docentesAvatar/'. $perfil->foto)}}" alt="{{$perfil->docente->nombre}}"
                        class="rounded-full w-60 h-60 shadow-md ring-2 ring-gray-400 mx-auto">
                    </figure>
                    <section class="bg-white shadow-xl sm:rounded-lg p-3 flex-1 mt-10 sm:ml-10">
                        <p> <span class="font-bold uppercase">Nombre completo: </span> {{$perfil->docente->nombre }} {{$perfil->docente->paterno }} {{$perfil->docente->materno }}</p>
                        <p> <span class="font-bold uppercase">Profesion: </span>{{$perfil->profesion}}</p>
                        <p class="font-bold uppercase">Biografia: </p>
                        <span class="text-justify">{!! $perfil->biografia !!}</span>
                        @if ($perfil->website != '')
                            <p><span class="font-bold uppercase">Pagina web: </span><a href="https://{{$perfil->website}}" target="_blank" class="text-blue-500
                                hover:text-blue-600 hover:underline">{{$perfil->website}}</a></p>
                        @endif
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
