<x-jet-dialog-modal wire:model="modalShowVisible">
    <x-slot name="title">
        <h1 class="border-b-2 border-blue-500 border-opacity-40">Informacion de la Carrera</h1>
    </x-slot>

    <x-slot name="content">
        <p><span class="font-bold">Titulo: </span> <span class="text-gray-700">{{$titulo}}</span></p>
        <p><span class="font-bold">Descripción: </span> <span class="text-gray-700">{!! $descripcion !!}</span></p>
        <p><span class="font-bold">Requisitos: </span> <span class="text-gray-700">{{$requisitos}}</span></p>
        <p><span class="font-bold">Carga Horaria: </span> <span class="text-gray-700">{{$cargaHoraria}} horas academicas</span></p>
        <p><span class="font-bold">Categoria: </span> <span class="text-gray-700">{{$categoria}}</span></p>
        <p><span class="font-bold">Docente a cargo del curso: </span> <span class="text-gray-700">
            {{$docenteNombre}} {{$docentePaterno}}</span></p>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('modalShowVisible', false)" wire:loading.attr="disabled">
            Cerrar
        </x-jet-secondary-button>
    </x-slot>
</x-jet-dialog-modal>


{{-- <x-app-layout>
    <div class="bg-indigo-700 h-80 mb-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="grid grid-cols-6 py-8">
                    <section class="col-span-3">
                        <img src="{{Storage::url('carreraPortadas/'. $carrera->portada)}}" alt="{{$carrera->titulo}}"
                        class="h-80 w-full object-cover object-center rounded-md shadow-lg">
                    </section>
                    <section class="col-span-3 flex items-center ml-10">
                        <div class="text-white">
                            <h1 class="text-4xl font-bold uppercase">{{$carrera->titulo}}</h1>
                            <p class="text-xl">Requisitos: <span>{{ $carrera->requisitos }}</span></p>
                            <p class="text-xl">Modalidad: <span>{{ $carrera->modalidad }}</span></p>
                            <p class="text-xl">Categoria: <span>{{ $carrera->categoria->nombre }}</span></p>
                            <p class="text-xl">Carga horaria: <span>{{ $carrera->cargaHoraria }} horas academicas</span></p>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-10 mb-10">
        @if ($carrera->descripcion)
            <p class="font-bold mt-14">Breve descripcion del curso: </p>
            <p>{!!$carrera->descripcion!!}</p>
        @endif
        <div class="mt-5">
            <div class="grid grid-cols-12 gap-4">
                <section class="col-span-9">
                    <h2 class="text-2xl uppercase font-bold text-gray-700">Modulos del curso</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 gap-4">
                        @foreach ($carrera->modulos as $modulo)
                            <div class="w-full py-6">
                                <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                                    <div class="bg-cover bg-center h-56 p-4" style="background-image: url({{Storage::url('moduloPortadas/' . $modulo->portada)}})">
                                    </div>
                                    <div class="p-4 h-20">
                                        <p class="uppercase text-xs tracking-wide font-bold text-gray-700">{{ $modulo->titulo }}</p>
                                        <p class="text-sm text-gray-900">Version: {{$modulo->version}}</p>
                                    </div>
                                    <a href="" class="btn mt-2 flex justify-center w-full bg-red-500 focus:border-red-600 hover:bg-red-600">
                                        Inscribirse
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
                <section class="col-span-3">
                    <div class="bg-white rounded shadow-md p-4">
                        <div class="flex items-center ">
                            <img src="{{Storage::url('docentesAvatar/'. $carrera->docente->perfil->foto)}}" alt="{{$carrera->docente->nombre}}"
                            class="h-14 w-14 ring-2 ring-gray-400 object-cover object-center rounded-full shadow-md">
                            <div>
                                <p class="ml-3 font-bold text-gray-700">Docente: </p>
                                <p class="ml-3 font-bold text-gray-600">{{$carrera->docente->nombre}} {{$carrera->docente->paterno}} {{$carrera->docente->materno}}</p>
                            </div>
                        </div>
                        <a href="{{ route('docente.perfil.show', $carrera->docente->id) }}" class="btn mt-2 flex justify-center w-full bg-red-500 focus:border-red-600 hover:bg-red-600">
                            Ver perfil
                        </a>
                    </div>
                </section>
            </div>
        </div>

    </div>
</x-app-layout> --}}
