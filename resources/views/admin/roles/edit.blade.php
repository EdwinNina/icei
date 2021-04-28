@extends('adminlte::page')

@section('title', 'Administración de Roles')

@section('content_header')
@stop

@section('content')
    <div>
        @if (session('message'))
            <div class=" border-l-4 px-5 py-2 rounded mb-3 bg-green-500 border-green-600">
                <span class="text-white text-center">
                    {{session('message')}}
                </span>
            </div>
        @endif
        <div class="w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-gray-500 uppercase text-2xl mt-1 mb-3 text-center">Edición de Roles</h1>
                    <form action="{{ route('admin.roles.update', $role->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="my-4">
                            <x-required-label for="nombre" value="Nombre del Rol" />
                            <x-jet-input type="text" name="nombre" class="w-full block"  value="{{$role->name}}"/>
                            <x-jet-input-error for="nombre" class="mt-2" />
                        </div>
                        <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 mb-3">Asignar permisos</h2>
                        <div class="mt-4">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @foreach ($permisos as $permiso)
                                    <div class="block mt-4 flex-1">
                                        <label for="permiso" class="flex items-center">
                                            <input type="checkbox"
                                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                                name="permisos[]"
                                                id="permiso"
                                                value="{{$permiso->id}}"
                                                {{ $role->hasPermissionTo($permiso->name) ? 'checked' : '' }}>
                                            <span class="ml-2 text-sm text-gray-600">{{$permiso->descripcion}}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end items-center">
                            <x-back-button href="{{route('admin.roles.index')}}">Volver</x-back-button>
                            <x-jet-danger-button type="submit" class="ml-2">Guardar</x-jet-danger-button>
                        </div>
                    </form>
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
@stop
