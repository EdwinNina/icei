<x-jet-dialog-modal wire:model="modalShowVisible">
    <x-slot name="title">
        <h1 class="border-b-2 border-blue-500 border-opacity-40">Informacion del Módulo</h1>
    </x-slot>

    <x-slot name="content">
        <div class="grid grid-cols-2 gap-4 -mb-px">
            <section>
                <img src="{{ Storage::url('moduloPortadas/'. $portada) }}" alt="{{$titulo}}"
                    class="w-full max-h-48 rounded shadow-sm mb-2">
                <p class="text-center"><span class="text-blue-500">{{$version}} - {{Str::title($titulo)}}</span></p>
                <p class="mt-4"><span class="font-bold">Carga Horaria: </span> <span class="text-gray-700">{{$cargaHoraria}} horas academicas</span></p>
                <p><span class="font-bold">Carrera: </span> <span class="text-gray-700">{{Str::title($carrera)}}</span></p>
            </section>
            <section class="overscroll-auto overflow-y-scroll max-h-64">
                <p><span class="font-bold">Temario: </span>
                    <span class="text-gray-700 text-xs list-disc">{!!$temario!!}</span>
                </p>
            </section>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('modalShowVisible', false)">Cerrar</x-jet-secondary-button>
    </x-slot>
</x-jet-dialog-modal>
