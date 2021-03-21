@extends('adminlte::page')

@section('title', 'Modulos')

@section('content_header')
@stop

@section('content')
    <div>
        <div class="w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-3 px-8">
                <h1 class="text-gray-500 uppercase text-2xl mt-3 text-center">Editar Modulo de {{$modulo->titulo}}</h1>
                <form action="{{ route('admin.modulos.update', $modulo) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mt-4">
                        <x-jet-label for="version" value="{{ __('Version') }}" />
                        <x-jet-input id="version" type="text" class="mt-1 block w-full"
                            name="version" value="{{$modulo->version}}" />
                        <x-jet-input-error for="version" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="titulo" value="{{ __('Titulo') }}" />
                        <x-jet-input id="titulo" type="text" class="mt-1 block w-full"
                            name="titulo" value="{{$modulo->titulo}}" />
                        <x-jet-input-error for="titulo" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="temario" value="{{ __('Temario') }}" />
                        <div class="rounded-md shadow-sm">
                            <div class="mt-1 bg-white">
                                <input type="hidden" name="temario" id="temario" value="{{$modulo->temario}}">
                                <trix-editor
                                    class="trix-content trix"
                                    input="temario"
                                ></trix-editor>
                            </div>
                        </div>
                        <x-jet-input-error for="temario" class="mt-2" />
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 mt-4">
                        <div>
                            <x-jet-label for="cargaHoraria" value="{{ __('Carga Horaria') }}" />
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                    Horas
                                </span>
                                <input type="number" name="cargaHoraria" id="cargaHoraria" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
                                value="{{$modulo->cargaHoraria}}">
                            </div>
                            <x-jet-input-error for="cargaHoraria" class="mt-2" />
                        </div>
                        <div>
                            <x-jet-label for="carrera" value="{{ __('Pertenece al curso') }}" />
                            <select id="carrera" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="carrera">
                                <option value="" selected disabled>-- Seleccionar categoria --</option>
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera->id }}" {{$modulo->carrera_id == $carrera->id ? 'selected': ''}}>{{$carrera->titulo}}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="carrera" class="mt-2" />
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex flex-col sm:flex-row">
                            <figure class="flex-none mx-auto sm:-mx-0 mb-5 sm:mr-10">
                                <img src="{{ $modulo->portada == '' ? asset('images/profile-picture.png') : Storage::url('moduloPortadas/'. $modulo->portada)}}" alt="{{$modulo->titulo}}"
                                    class="rounded w-56 h-32 shadow-md" id="image">
                                    <input type="hidden" name="oldCover" value="{{$modulo->portada}}">
                            </figure>
                            <div class="flex-grow sm:ml-10 ml-0">
                                <x-jet-label for="portada" value="{{ __('Portada del curso') }}" />
                                <x-jet-input id="portada" type="file" class="mt-1 block w-full"
                                name="portada" accept="image/*" />
                                <x-jet-input-error for="portada" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end my-4">
                        <x-back-button href="{{ route('admin.modulos.index') }}" class="mr-2">Volver</x-back-button>
                        <x-jet-danger-button type="submit">Guardar</x-jet-danger-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    @trixassets
@stop
@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        const inputFile = document.getElementById('portada');

        inputFile.addEventListener('change', e => {
            let file = e.target.files[0];
            let reader = new FileReader();
            reader.onload = event => {
                document.getElementById('image').setAttribute('src', event.target.result);
            }
            reader.readAsDataURL(file);
        });
    </script>
    <script>
        window.livewire.on('messageSuccess', value => {
            switch (value) {
                case 'create':
                    toastr.success('Correcto', 'Registro agregado correctamente');
                    break;
                case 'update':
                    toastr.success('Correcto', 'Registro actualizado correctamente');
                break;
            }
        });

        window.livewire.on('messageFailed', () => {
            toastr.error('Incorrecto', 'Hubo un error, intentelo de nuevo!');
        });
    </script>
@stop


