<x-jet-dialog-modal wire:model="modalFormVisible">
    <x-slot name="title">
        {{ __('Guardar Categoria') }}
    </x-slot>

    <x-slot name="content">
        <div class="mt-4">
            <x-jet-label for="nombre" value="{{ __('Titulo') }}" />
            <x-jet-input id="nombre" type="text" class="mt-1 block w-full" wire:model.debounce.800ms="nombre"
                wire:keyup="makeSlug"/>
            <x-jet-input-error for="nombre" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-jet-label for="slug" value="{{ __('Slug') }}" />
            <x-jet-input id="slug" type="text" class="mt-1 block w-full" wire:model.debounce.800ms="slug" readonly/>
            <x-jet-input-error for="slug" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeModal()">
            {{ __('Cerrar') }}
        </x-jet-secondary-button>
        @if ($categoriaId)
            <x-jet-danger-button wire:click="update()" class="ml-2">
                {{ __('Actualizar') }}
            </x-jet-danger-button>
        @else
            <x-jet-danger-button wire:click="save()" class="ml-2">
                {{ __('Guardar') }}
            </x-jet-danger-button>
        @endif
    </x-slot>
</x-jet-dialog-modal>
