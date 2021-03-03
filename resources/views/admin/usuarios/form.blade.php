<x-jet-dialog-modal wire:model="modalFormVisible">
    <x-slot name="title">Guardar Usuario</x-slot>

    <x-slot name="content">
        <div>
            <x-required-label for="name" value="Nombre de usuario"/>
            <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="name" :value="old('name')" autofocus autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-required-label for="email" value="Correo electronico"/>
            <x-jet-input id="email" class="block mt-1 w-full" type="email" wire:model.debounce.800ms="email" :value="old('email')" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>
        @if (!$usuarioId)
            <div class="mt-4">
                <x-required-label for="password" value="Contraseña"/>
                <x-jet-input id="password" class="block mt-1 w-full" type="password" wire:model.debounce.800ms="password" autocomplete="new-password" />
                <x-jet-input-error for="password" class="mt-2" />
            </div>
        @endif
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('modalFormVisible', false)">Cerrar</x-jet-secondary-button>
        @if ($usuarioId)
            <x-jet-danger-button wire:click="update()" class="ml-2" wire:loading.attr="disabled">Actualizar</x-jet-danger-button>
        @else
            <x-jet-danger-button wire:click="save()" class="ml-2" wire:loading.attr="disabled">Guardar</x-jet-danger-button>
        @endif
    </x-slot>
</x-jet-dialog-modal>
