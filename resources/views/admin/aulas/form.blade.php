<x-jet-dialog-modal wire:model="modalFormVisible">
    <x-slot name="title">Guardar Aula</x-slot>

    <x-slot name="content">
        <div class="mt-4">
            <div class="flex items-center">
                <div class="flex-auto mr-3">
                    <x-required-label for="aula" value="Aula" />
                    <x-jet-input id="aula" type="text" wire:model.defer="aula" class="mt-1 block w-full"/>
                    <x-jet-input-error for="aula" class="mt-2" />
                </div>
                <div class="mr-3">
                    <x-required-label for="piso" value="Número de Piso" />
                    <x-jet-input id="piso" type="text" wire:model.defer="piso" class="mt-1 block w-full"/>
                    <x-jet-input-error for="piso" class="mt-2" />
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('modalFormVisible', false)">Cerrar</x-jet-secondary-button>
        @if ($aulaId)
            <x-jet-danger-button wire:click="update()" class="ml-2">Actualizar</x-jet-danger-button>
        @else
            <x-jet-danger-button wire:click="save()" class="ml-2">Guardar</x-jet-danger-button>
        @endif
    </x-slot>
</x-jet-dialog-modal>
