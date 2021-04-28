<x-jet-dialog-modal wire:model="modalFormVisible">
    <x-slot name="title">
        Importar datos desde excel
        <p class="text-sm text-blue-500"> * El formato de la cabezera del archivo excel debe estar en el siguiente formato</p>
        <ul class="text-xs font-bold text-gray-700 flex list-none px-0">
            <li class="p-1 border border-gray-500">paterno</li>
            <li class="p-1 border border-gray-500">materno</li>
            <li class="p-1 border border-gray-500">nombre</li>
            <li class="p-1 border border-gray-500">carrera</li>
            <li class="p-1 border border-gray-500">modulo</li>
            <li class="p-1 border border-gray-500">nota</li>
            <li class="p-1 border border-gray-500">docente</li>
            <li class="p-1 border border-gray-500">fecha_inicio</li>
            <li class="p-1 border border-gray-500">fecha_fin</li>
        </ul>
    </x-slot>

    <x-slot name="content">
        <div class="mt-4">
            <x-jet-label for="excel" value="Seleccionar archivo excel" />
            <x-jet-input id="excel" type="file" class="mt-1 block w-full" wire:model="excel"
                accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
            <x-jet-input-error for="excel" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('modalFormVisible', false)" class="mr-2">Volver</x-jet-secondary-button>
        <x-jet-danger-button
            wire:click="import()"
            class="flex justify-center items-center"
            wire:loading.remove wire:target="import">
            {{$nombreBotonCarga}}
        </x-jet-danger-button>
        <span class="text-blue-500" wire:loading wire:target="import">Subiendo registros...</span>
    </x-slot>
</x-jet-dialog-modal>
