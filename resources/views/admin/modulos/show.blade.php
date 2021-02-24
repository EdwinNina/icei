<x-jet-dialog-modal wire:model="modalShowVisible">
    <x-slot name="title">
        <h1 class="border-b-2 border-blue-500 border-opacity-40">Informacion de la Carrera</h1>
    </x-slot>

    <x-slot name="content">
        <div class="grid grid-cols-2 gap-4">
            <section>
                <img src="{{ Storage::url('moduloPortadas/'. $portada) }}" alt="{{$titulo}}"
                    class="w-full h-1/2 rounded shadow-sm mb-2">
                <p><span class="text-gray-700">{{$version}} - {{$titulo}}</span></p>
                <p><span class="font-bold">Carga Horaria: </span> <span class="text-gray-700">{{$cargaHoraria}} horas academicas</span></p>
                <p><span class="font-bold">Carrera: </span> <span class="text-gray-700">{{$carrera}}</span></p>
            </section>
            <section>
                <p><span class="font-bold">Temario: </span> <span class="text-gray-700 text-sm">{!! $temario !!}</span></p>
            </section>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('modalShowVisible', false)" wire:loading.attr="disabled">
            Cerrar
        </x-jet-secondary-button>
    </x-slot>
</x-jet-dialog-modal>

{{-- <x-app-layout>
    <div class="bg-indigo-700 h-72">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="grid grid-cols-6 py-8">
                    <section class="col-span-3">
                        <img src="{{Storage::url('subjectsCover/'.$subject->portada)}}" alt="{{$subject->titulo}}"
                        class="h-80 w-full object-cover object-center rounded-md shadow-lg">
                    </section>
                    <section class="col-span-3 flex items-center ml-10">
                        <div class="text-white">
                            <h1 class="text-4xl font-bold uppercase">{{$subject->titulo}}</h1>
                            <p class="text-xl">Requisitos: <span>{{ $subject->requisitos }}</span></p>
                            <p class="text-xl">Modalidad: <span>{{ $subject->modalidad }}</span></p>
                            <p class="text-xl">Categoria: <span>{{ $subject->category->nombre }}</span></p>
                            <p class="text-xl">Carga horaria: <span>{{ $subject->cargaHoraria }} horas academicas</span></p>
                        </div>
                    </section>
                </div>
            </div>
            @if ($subject->descripcion)
                <p class="font-bold">Breve descripcion del curso: </p>
                <p>{!!$subject->descripcion!!}</p>
            @endif
            <div class="mt-5">
                <div class="grid grid-cols-12 gap-4">
                    <section class="col-span-9">
                        <h2 class="text-2xl uppercase font-bold text-gray-700">Modulos del curso</h2>
                    </section>
                    <section class="col-span-3">
                        <div class="bg-white rounded shadow-md p-4">
                            <div class="flex items-center ">
                                <img src="{{Storage::url('teachersAvatar/'. $subject->teacher->profile->foto)}}" alt="{{$subject->teacher->nombre}}"
                                class="h-14 w-14 ring-2 ring-gray-400 object-cover object-center rounded-full shadow-md">
                                <p class="ml-3 font-bold text-gray-600">Docente: {{$subject->teacher->nombre}}</p>
                            </div>
                            <a href="{{ route('teacher.profile.show', $subject->teacher->id) }}" class="btn mt-2 flex justify-center w-full bg-red-500 focus:border-red-600 hover:bg-red-600">
                                Ver perfil
                            </a>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
