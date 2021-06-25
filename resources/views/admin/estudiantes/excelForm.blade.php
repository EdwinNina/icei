<x-jet-dialog-modal wire:model="modalFormVisible">
    <x-slot name="title">
        Importar datos desde excel
        <p class="text-sm text-blue-500"> * El formato del archivo excel debe estar en el siguiente formato</p>
        <ul class="text-xs font-bold text-gray-700 flex list-none px-0">
            <li class="p-1 border border-gray-700">Cedula</li>
            <li class="p-1 border border-gray-500">Expedido</li>
            <li class="p-1 border border-gray-500">Paterno</li>
            <li class="p-1 border border-gray-500">Materno</li>
            <li class="p-1 border border-gray-500">Nombre</li>
            <li class="p-1 border border-gray-500">Email</li>
            <li class="p-1 border border-gray-500">Celular</li>
            <li class="p-1 border border-gray-500">Grado</li>
            <li class="p-1 border border-gray-500">Profesion</li>
            <li class="p-1 border border-gray-500">Universidad</li>
            <li class="p-1 border border-gray-500">Carrera</li>
        </ul>
            </tr>
        </table>
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
