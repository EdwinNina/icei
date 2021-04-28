@extends('adminlte::page')

@section('title', 'Certificado Finales')

@section('content_header')
    <h1>Búsqueda para Certificados Finales</h1>
@stop

@section('content')
    <div class="w-full">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <form action="{{ route('admin.certificadoFinal.busqueda') }}" method="POST">
                @csrf
                @livewire('buscador-estudiante-component')
                <div class="mt-4 grid grid-cols-5 gap-6 items-end">
                    <div class="col-span-3">
                        <x-required-label for="carrera" value="Carreras"/>
                        <select name="carrera" id="carrera" class="custom-select sm:text-sm">
                            <option value="" selected>Seleccionar</option>
                            @foreach ($carreras as $carrera)
                                <option value="{{$carrera->id}}">{{ Str::title($carrera->titulo) }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="carrera" class="mt-1" />
                    </div>
                    <div>
                        <x-required-label for="gestion" value="Gestión"/>
                        <select name="gestion" class="custom-select sm:text-sm">
                            <option value="" disabled>Seleccionar gestion</option>
                            @foreach ($gestiones as $key => $gestion)
                                <option value="{{ $key }}">{{$gestion}}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="gestion" class="mt-2" />
                    </div>
                    <button type="submit"
                        class="p-2 bg-green-600 text-white flex justify-center items-center
                            rounded-md shadow-md hover:bg-green-700">
                        @include('components.search-icon') <span class="ml-1">Buscar</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@stop

@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
@stop

@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
@stop
