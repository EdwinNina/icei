<x-jet-dialog-modal wire:model="modalFormVisible">
    <x-slot name="title">Guardar Tipo de Pago</x-slot>

    <x-slot name="content">
        <div class="mt-4">
            <x-required-label for="nombre" value="Nombre" />
            <x-jet-input id="nombre" type="text" class="mt-1 block w-full" wire:model.debounce.800ms="nombre"/>
            <x-jet-input-error for="nombre" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-required-label for="descripcion" value="Decripción" />
            <div class="rounded-md shadow-sm">
                <div class="mt-1 bg-white">
                    <div class="body-content" wire:ignore>
                        <trix-editor
                            class="trix-content"
                            x-ref="trix"
                            wire:model.debounce.100000ms="descripcion"
                            wire:key="trix-content-unique-key"
                        ></trix-editor>
                    </div>
                </div>
            </div>
            <x-jet-input-error for="descripcion" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeModal()" wire:loading.attr="disabled">
            {{ __('Cerrar') }}
        </x-jet-secondary-button>
        @if ($tipoPagoId)
            <x-jet-danger-button wire:click="update()" class="ml-2" wire:loading.attr="disabled">
                {{ __('Actualizar') }}
            </x-jet-danger-button>
        @else
            <x-jet-danger-button wire:click="save()" class="ml-2" wire:loading.attr="disabled">
                {{ __('Guardar') }}
            </x-jet-danger-button>
        @endif
    </x-slot>
</x-jet-dialog-modal>
