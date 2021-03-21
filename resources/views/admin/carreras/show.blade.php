<x-jet-dialog-modal wire:model="modalShowVisible">
    <x-slot name="title">
        <h1 class="border-b-2 border-blue-500 border-opacity-40">Informacion de la Carrera</h1>
    </x-slot>

    <x-slot name="content">
        <p><span class="font-bold">Titulo: </span> <span class="text-gray-700">{{$titulo}}</span></p>
        <span class="font-bold">Descripción: </span>
        <div class="overscroll-auto overflow-y-scroll max-h-44">
            {!! $descripcion !!}
        </div>
        <p><span class="font-bold">Requisitos: </span> <span class="text-gray-700">{{$requisitos}}</span></p>
        <p><span class="font-bold">Carga Horaria: </span> <span class="text-gray-700">{{$cargaHoraria}} horas academicas</span></p>
        <p><span class="font-bold">Categoria: </span> <span class="text-gray-700">{{$categoria}}</span></p>
        {{-- <p><span class="font-bold">Docente a cargo del curso: </span> <span class="text-gray-700">
            {{$docenteNombre}} {{$docentePaterno}}</span></p> --}}
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('modalShowVisible', false)" wire:loading.attr="disabled">
            Cerrar
        </x-jet-secondary-button>
    </x-slot>
</x-jet-dialog-modal>
