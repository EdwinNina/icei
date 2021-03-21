@extends('adminlte::page')

@section('title', 'Carreras')

@section('content_header')
@stop

@section('content')
    <div>
        <div class="w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-2 px-4">
                <h1 class="text-gray-500 uppercase text-2xl mt-5 text-center">Registrar Carrera</h1>
                <form action="{{ route('admin.carreras.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-4">
                        <x-required-label for="titulo" value="Titulo" />
                        <x-jet-input id="titulo" type="text" class="mt-1 block w-full" name="titulo" autofocus />
                        <x-jet-input-error for="titulo" class="mt-2" value="{{ old('titulo') }}"/>
                    </div>
                    <div class="mt-4">
                        <x-required-label for="descripcion" value="Descripción" />
                        <div class="rounded-md shadow-sm">
                            <input type="hidden" name="descripcion" id="descripcion">
                            <trix-editor
                                class="trix-content trix"
                                input="descripcion"
                            ></trix-editor>
                        </div>
                        <x-jet-input-error for="descripcion" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-required-label for="requisitos" value="Requisitos" />
                        <x-jet-input id="requisitos" type="text" class="mt-1 block w-full" name="requisitos" value="{{ old('requisitos') }}" />
                        <x-jet-input-error for="requisitos" class="mt-2" />
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-3 mt-4">
                        <div>
                            <x-required-label for="cargaHoraria" value="Carga Horaria" />
                            <x-jet-input id="cargaHoraria" type="number" class="mt-1 block w-full" name="cargaHoraria" value="{{ old('cargaHoraria') }}" />
                            <x-jet-input-error for="cargaHoraria" class="mt-2" />
                        </div>
                        <div>
                            <x-required-label for="categoria_id" value="Categoria del curso" />
                            <select id="categoria_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="categoria_id" value="{{ old('categoria_id') }}">
                                <option value="" selected disabled>-- Seleccionar categoria --</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="categoria_id" class="mt-2" />
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex flex-col sm:flex-row">
                            <figure class="flex-none mx-auto mb-5">
                                <img src="{{asset('images/placeholder.png')}}"
                                        class="rounded w-56 h-32 shadow-md border-gray-300 border" id="image">
                            </figure>
                            <div class="flex-grow ml-10">
                                <x-jet-label for="portada" value="{{ __('Portada del curso') }}" />
                                <x-jet-input id="portada" type="file" class="mt-1 block w-full" name="portada" accept="image/*"/>
                                <x-jet-input-error for="portada" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end my-4">
                        <x-back-button href="{{ route('admin.carreras.index') }}" class="mr-2">Volver</x-back-button>
                        <x-jet-danger-button type="submit">Registrar</x-jet-danger-button>
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
