@extends('adminlte::page')

@section('title', 'Administración de Roles')

@section('content_header')
@stop

@section('content')
    <div>
        @if (session('message'))
            <div class=" border-l-4 px-5 py-2 rounded mb-3
                {{session('message') === 'good' ? 'bg-green-500 border-green-600' : 'bg-red-500 border-red-600'}}">
                <span class="text-white text-center">
                    {{ session('message') === 'good'
                        ? 'se realizo con exito'
                        : 'Ocurrió un error, intentelo de nuevo'
                    }}
                </span>
            </div>
        @endif
        <div class="w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-end py-3">
                        <a href="{{ route('admin.roles.create') }}" class="btn bg-gray-800 focus:border-gray-900 hover:bg-gray-700 hover:text-white">Nuevo</a>
                    </div>
                    @if ($roles->count())
                        <div class="shadow-sm border-b overflow-hidden rounded border-gray-200 sm:rounded-lg">
                            <div class="table-responsive">
                                <table class="table-tail">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="table-tail-th">Nro</th>
                                        <th scope="col" class="table-tail-th">Rol</th>
                                        <th scope="col" class="table-tail-thr w-36 text-center">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 relative">
                                        @foreach ($roles as $index => $item)
                                            <tr>
                                                <td class="table-tail-td">
                                                    <div class="text-sm text-gray-900">{{ $index+1 }}</div>
                                                </td>
                                                <td class="table-tail-td">
                                                    <div class="text-sm text-gray-900">{{ $item->name }}</div>
                                                </td>
                                                <td class="table-tail-td text-sm font-medium flex justify-center">
                                                    <a href="{{ route('admin.roles.edit', $item) }}"
                                                    class=" flex justify-center items-center mx-auto bg-yellow-500 rounded-full w-7 h-7 hover:bg-yellow-600 transition-all">
                                                        @include('components.edit-icon')
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="py-4">
                            {{ $roles->links() }}
                        </div>
                        @else
                            <p class="text-red-400 text-center mt-4 font-bold">No existen registros en la base de datos</p>
                        @endif
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
