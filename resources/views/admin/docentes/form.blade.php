<x-jet-dialog-modal wire:model="modalFormVisible">
    <x-slot name="title">Guardar Docente</x-slot>

    <x-slot name="content">
        <div class="mt-4">
            <div class="flex items-center">
                <div class="flex-auto mr-3">
                    <x-required-label for="carnet" value="Cedula de identidad" />
                    <x-jet-input id="carnet" type="number" wire:model.defer="carnet" class="mt-1 block w-full"/>
                    <x-jet-input-error for="carnet" class="mt-2" />
                </div>
                <div class="mr-3">
                    <x-jet-label for="complemento" value="Complemento" />
                    <x-jet-input id="complemento" type="text" wire:model.defer="complemento" class="mt-1 block w-full"/>
                    <x-jet-input-error for="complemento" class="mt-2" />
                </div>
                <div class="flex-1">
                    <x-required-label for="expedido" value="Expedido"></x-required-label>
                    <select wire:model.defer="expedido" id="expedido" class="custom-select w-auto sm:text-sm">
                        <option value="" selected>-- Seleccionar expedido --</option>
                        @foreach ($expedidos as $key => $expedido)
                            <option value="{{ $key }}">{{$expedido}}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="expedido" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-3 mt-4">
            <div>
                <x-required-label for="nombre" value="Nombre" />
                <x-jet-input id="nombre" type="text" class="mt-1 block w-full"
                    wire:model.debounce.800ms="nombre" autofocus />
                <x-jet-input-error for="nombre" class="mt-2" />
            </div>
            <div>
                <x-required-label for="paterno" value="Paterno" />
                <x-jet-input id="paterno" type="text" class="mt-1 block w-full" wire:model.defer="paterno"/>
                <x-jet-input-error for="paterno" class="mt-2" />
            </div>
            <div>
                <x-required-label for="materno" value="Materno" />
                <x-jet-input id="materno" type="text" class="mt-1 block w-full" wire:model.defer="materno"/>
                <x-jet-input-error for="materno" class="mt-2" />
            </div>
        </div>
        <div class="mt-4">
            <x-required-label for="email" value="Correo electrónico" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="email"/>
            <x-jet-input-error for="email" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-required-label for="celular" value="Celular" />
            <x-jet-input id="celular" type="number" class="mt-1 block w-full" wire:model.defer="celular"/>
            <x-jet-input-error for="celular" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeModal()">Cerrar</x-jet-secondary-button>
        @if ($docenteId)
            <x-jet-danger-button wire:click="update()" class="ml-2">Actualizar</x-jet-danger-button>
        @else
            <x-jet-danger-button wire:click="save()" class="ml-2">Registrar</x-jet-danger-button>
        @endif
    </x-slot>
</x-jet-dialog-modal>
