<x-jet-dialog-modal wire:model="modalFormVisible">
    <x-slot name="title">
        <h2 class="text-center uppercase text-gray-600 text-lg ">Formulario de Cancelación de congelamiento</h2>
    </x-slot>
    <x-slot name="content">
        <h2 class="text-sm uppercase text-blue-500 border-b-2 mb-3 border-gray-200">Módulo inscrito actualmente</h2>
        <label class="w-full block">Carrera: <span class="font-normal">{{$carrera}}</span> </label>
        <label class="w-full block">Módulo: <span class="font-normal">{{$modulo}}</span> </label>
        <h2 class="text-sm uppercase text-blue-500 border-b-2 my-3 border-gray-200">¿Desea congelar el módulo?</h2>
        <div class="flex ml-2 items-center">
            <input id="congelar" wire:model.lazy="congelacion" type="radio"
            class="focus:ring-indigo-500 w-4 text-indigo-600 border-gray-300" value="1"
            {{ ($congelacion == "1") ? "checked" : ""}}>
            <label for="congelar" class="ml-3 block text-sm font-medium text-gray-700">Congelado</label>
        </div>
        <div class="flex ml-2 items-center">
            <input id="descongelar" wire:model.lazy="congelacion" type="radio"
            class="focus:ring-indigo-500 w-4 text-indigo-600 border-gray-300" value="0"
            {{ ($congelacion == "0") ? "checked" : ""}}>
            <label for="descongelar" class="ml-3 block text-sm font-medium text-gray-700">Habilitado</label>
        </div>
        <h2 class="text-sm uppercase text-blue-500 border-b-2 my-3 border-gray-200">Fechas de congelamiento de módulo</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <p class="text-gray-500 text-sm">La fecha de congelación del módulo comienza desde la fecha actual de la petición hasta 3 meses a partir de la fecha actual</p>
            <div>
                <label class="w-full block">Desde: <span class="font-normal">{{ $fecha_congelacion_inicio}}</span></label>
                <label class="w-full block">Hasta: <span class="font-normal">{{$fecha_congelacion_fin}}</span></label>
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('modalFormVisible', false)">Cerrar</x-jet-secondary-button>
        @if ($opcionBoton)
            <x-jet-danger-button class="ml-3" wire:click.prevent="congelarModulo()">Guardar</x-jet-danger-button>
        @else
            <x-jet-danger-button class="ml-3" wire:click.prevent="descongelarModulo()">Guardar</x-jet-danger-button>
        @endif
    </x-slot>
</x-jet-dialog-modal>
