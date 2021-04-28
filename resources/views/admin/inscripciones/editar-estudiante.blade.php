<x-jet-dialog-modal wire:model="modalFormVisible">
    <x-slot name="title">Actualización Número telefonico</x-slot>

    <x-slot name="content">
        <div class="mt-4">
            <div class="flex-auto mr-3">
                <x-required-label for="estudiante_celular" value="Celular" />
                <x-jet-input id="estudiante_celular" type="number" wire:model.lazy="estudiante_celular" class="mt-1 block w-full"/>
                <x-jet-input-error for="estudiante_celular" class="mt-2" />
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('modalFormVisible',false)">Cerrar</x-jet-secondary-button>
        <x-jet-danger-button wire:click="update()" class="ml-2">Guardar</x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>
