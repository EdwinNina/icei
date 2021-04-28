@extends('adminlte::page')

@section('title', 'Docentes')

@section('content_header')
@stop

@section('content')
    <div>
        <div class="w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="py-3 px-8">
                    <h1 class="text-2xl text-center uppercase font-bold">Actualizar perfil</h1>
                    <form action="{{ route('docente.perfil.update', $perfil) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mt-4">
                            <x-jet-label for="profesion" value="{{ __('Profesión') }}" />
                            <x-jet-input id="profesion" name="profesion" type="text" class="mt-1 block w-full" autofocus
                                value="{{ $perfil->profesion == '' ? old('profesion') : $perfil->profesion }}" />
                            <x-jet-input-error for="profesion" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-jet-label for="biografia" value="{{ __('Biografia') }}" />
                            <div class="rounded-md shadow-sm">
                                <div class="mt-1 bg-white">
                                    <div class="body-content">
                                        <trix-editor
                                            class="trix-content"
                                            x-ref="trix"
                                            input="biografia"
                                        ></trix-editor>
                                        <input type="hidden" id="biografia" name="biografia"
                                            value="{{ $perfil->biografia == '' ? old('biografia') : $perfil->biografia }}">
                                    </div>
                                </div>
                            </div>
                            <x-jet-input-error for="biografia" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <x-jet-label for="website" value="{{ __('Pagina web') }}" />
                            <x-jet-input id="website" name="website" type="text" class="mt-1 block w-full"
                                value="{{ $perfil->website == '' ? old('website') : $perfil->website }}"
                            />
                        </div>
                        <div class="mt-4">
                            <div class="flex flex-col md:flex-row">
                                <figure class="flex-none md:mr-8">
                                    <img src="{{ $perfil->foto == '' ? asset('images/profile-picture.png') : Storage::url('docentesAvatar/'. $perfil->foto)}}" alt="{{$perfil->docente->nombre}}"
                                        class="rounded-full w-32 h-32 shadow-md ring-2 ring-gray-400" id="image">
                                </figure>
                                @if ($perfil->foto != '')
                                    <input type="hidden" name="oldImagen" value="{{$perfil->foto}}">
                                @endif
                                <div class="flex-grow">
                                    <x-jet-label for="foto" value="{{ __('Foto') }}" />
                                    <x-jet-input type="file" name="foto" class="mt-1 block w-full" id="foto" accept="image/*" />
                                    <p class="text-gray-500 font-medium mt-3">La imagen que suba aparecerá como su avatar en la
                                        presentación de sus cursos
                                    </p>
                                </div>
                            </div>
                            <x-jet-input-error for="foto" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <div class="flex flex-col sm:flex-row">
                                @if ($perfil->curriculum != '')
                                    <div class="flex-none mx-auto sm:-mx-0 mb-5 sm:mr-10">
                                        <a href="{{ Storage::url('docentesCurriculum/' . $perfil->curriculum) }}" target="_blank">
                                            <img src="{{ asset('images/pdf-icon.png') }}" alt="" class="h-20 w-30 ml-7">
                                        </a>
                                        <p class="text-center ml-2 font-bold">Curriculum actual</p>
                                        <input type="hidden" name="oldCurriculum" value="{{$perfil->curriculum}}">
                                    </div>
                                @endif
                                <div class="flex-grow">
                                    <x-jet-label for="curriculum" value="{{ __('Curriculum') }}" />
                                    <x-jet-input id="curriculum" type="file" name="curriculum" class="mt-1 block w-full" accept="application/pdf"/>
                                </div>
                            </div>
                            <x-jet-input-error for="curriculum" class="mt-2" />
                        </div>
                        <div class="flex justify-end text-right mt-6">
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
    @trixassets
@stop
@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        const inputFile = document.getElementById('foto');

        inputFile.addEventListener('change', e => {
            let file = e.target.files[0];
            let reader = new FileReader();
            reader.onload = event => {
                document.getElementById('image').setAttribute('src', event.target.result);
            }
            reader.readAsDataURL(file);
        });
    </script>
@stop

