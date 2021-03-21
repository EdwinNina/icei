<x-jet-dialog-modal wire:model="showModalDelete">
    <x-slot name="title">
        {{$titulo}}
    </x-slot>

    <x-slot name="content">
        {{ $mensaje }}
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showModalDelete')" wire:loading.attr="disabled">
            {{ __('Cerrar') }}
        </x-jet-secondary-button>

        @if ($estadoRegistro === 1)
            <x-jet-danger-button class="ml-2" wire:click="enable()" wire:loading.attr="disabled">
                Habilitar
            </x-jet-danger-button>
        @else
            <x-jet-danger-button class="ml-2" wire:click="delete()" wire:loading.attr="disabled">
                Deshabilitar
            </x-jet-danger-button>
        @endif
    </x-slot>
</x-jet-dialog-modal>
