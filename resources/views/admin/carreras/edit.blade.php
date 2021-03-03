<x-app-layout>
    <div class="py-2">
        <div class="w-full bg-white shadow-md rounded-md py-5 px-8">
            <h1 class="text-gray-500 uppercase text-2xl mt-5 text-center">Registrar Carrera</h1>
            <form action="{{ route('admin.carrera.update', $carrera) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mt-4">
                    <x-jet-label for="titulo" value="{{ __('Titulo') }}" />
                    <x-jet-input id="titulo" type="text" class="mt-1 block w-full"
                        name="titulo" autofocus value="{{$carrera->titulo}}" />
                    <x-jet-input-error for="titulo" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-jet-label for="titulo" value="{{ __('Descripción') }}" />
                    <div class="rounded-md shadow-sm">
                        <input type="hidden" name="descripcion" id="descripcion" value="{{$carrera->descripcion}}">
                        <trix-editor
                            class="trix-content trix"
                            input="descripcion"
                        ></trix-editor>
                    </div>
                    <x-jet-input-error for="descripcion" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-jet-label for="requisitos" value="{{ __('Requisitos') }}" />
                    <x-jet-input id="requisitos" type="text" class="mt-1 block w-full"
                        name="requisitos" value="{{$carrera->requisitos}}"/>
                    <x-jet-input-error for="requisitos" class="mt-2" />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-3 mt-4">
                    <div>
                        <x-jet-label for="cargaHoraria" value="{{ __('Carga Horaria') }}" />
                        <x-jet-input id="cargaHoraria" type="number" class="mt-1 block w-full"
                            name="cargaHoraria" value="{{$carrera->cargaHoraria}}"/>
                        <x-jet-input-error for="cargaHoraria" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="category_id" value="{{ __('Categoria del curso') }}" />
                        <select id="turno" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="categoria_id">
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{$carrera->category_id == $categoria->id ? 'selected': ''}}>{{$categoria->nombre}}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="category_id" class="mt-2" />
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex flex-col sm:flex-row">
                        <figure class="flex-none mx-auto sm:-mx-0 mb-5 sm:mr-10">
                            <img src="{{ $carrera->portada == '' ? asset('images/profile-picture.png') : Storage::url('carreraPortadas/'. $carrera->portada)}}" alt="{{$carrera->titulo}}"
                                class="rounded w-56 h-32 shadow-md" id="image">
                                <input type="hidden" name="oldCover" value="{{$carrera->portada}}">
                        </figure>
                        <div class="flex-grow">
                            <x-jet-label for="portada" value="{{ __('Portada del curso') }}" />
                            <x-jet-input id="portada" type="file" class="mt-1 block w-full"
                            name="portada" accept="image/*" />
                            <x-jet-input-error for="portada" class="mt-2" />
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <x-jet-label for="docente_id" value="{{ __('Docente a cargo') }}" />
                    <select id="docente_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        name="docente_id">
                        @foreach ($docentes as $docente)
                            <option value="{{ $docente->id }}" {{$carrera->docente_id == $docente->id ? 'selected' : ''}}>{{$docente->nombre}}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="docente_id" class="mt-2" />
                </div>
                <div class="flex justify-end mt-4">
                    <x-jet-danger-button type="submit">
                        {{ __('Guardar') }}
                    </x-jet-danger-button>
                </div>
            </form>
        </div>
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

