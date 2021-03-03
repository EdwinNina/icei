<x-app-layout>
    <div class="w-full bg-white shadow-md rounded-md py-5 px-8">
        <h1 class="text-gray-500 uppercase text-2xl mt-5 text-center">Registrar Modulo de Carrera</h1>
        <form action="{{ route('admin.modulo.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mt-4">
                <x-required-label for="version" value="Version" />
                <x-jet-input id="version" type="text" class="mt-1 block w-full"
                    name="version" autofocus value="{{ old('version')}}" />
                <x-jet-input-error for="version" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-required-label for="titulo" value="Titulo" />
                <x-jet-input id="titulo" type="text" class="mt-1 block w-full"
                    name="titulo" value="{{ old('titulo')}}"/>
                <x-jet-input-error for="titulo" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-required-label for="temario" value="Temario" />
                <div class="rounded-md shadow-sm">
                    <div class="mt-1 bg-white">
                        <div class="body-content" wire:ignore>
                            <trix-editor
                                class="trix-content"
                                x-ref="trix"
                                input="temario"
                            ></trix-editor>
                            <input type="hidden" name="temario" id="temario" value="{{ old('temario')}}">
                        </div>
                    </div>
                </div>
                <x-jet-input-error for="temario" class="mt-2" />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 mt-4">
                <div>
                    <x-required-label for="cargaHoraria" value="Carga horaria" />
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                            Horas
                        </span>
                        <input type="number" name="cargaHoraria" id="cargaHoraria" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" value="{{ old('cargaHoraria')}}">
                    </div>
                    <x-jet-input-error for="cargaHoraria" class="mt-2" />
                </div>
                <div>
                    <x-required-label for="carrera" value="Pertenece a la carrera" />
                    <select id="carrera" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="carrera" value="{{ old('carrera')}}">
                        <option value="" selected disabled>-- Seleccionar Carrera --</option>
                        @foreach ($carreras as $carrera)
                            <option value="{{ $carrera->id }}">{{$carrera->titulo}}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="carrera" class="mt-2" />
                </div>
            </div>
            <div class="mt-4">
                <div class="flex flex-col sm:flex-row">
                    <figure class="flex-none mx-auto sm:-mx-0 mb-5 sm:mr-10">
                        <img src="{{ asset('images/placeholder.png')}}"
                            class="rounded w-56 h-32 shadow-md border-gray-300 border" id="image">
                    </figure>
                    <div class="flex-grow">
                        <x-required-label for="portada" value="Portada del curso" />
                        <x-jet-input id="portada" type="file" class="mt-1 block w-full"
                        name="portada" accept="image/*"/>
                        <x-jet-input-error for="portada" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <x-back-button href="{{ route('admin.modulo.index') }}" class="mr-2">Volver</x-back-button>
                <x-jet-danger-button type="submit">
                    {{ __('Guardar') }}
                </x-jet-danger-button>
            </div>
        </form>
    </div>
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

</x-app-layout>

