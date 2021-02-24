<x-jet-dialog-modal wire:model="showModalDelete">
    <x-slot name="title">
        {{ __('Eliminar') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Estas seguro de eliminar este registro?') }}
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showModalDelete')" wire:loading.attr="disabled">
            {{ __('Cerrar') }}
        </x-jet-secondary-button>

        <x-jet-danger-button class="ml-2" wire:click="delete()" wire:loading.attr="disabled">
            {{ __('Eliminar') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>
