<x-jet-dialog-modal wire:model="modalFormVisible">
    <x-slot name="title">
        {{ __('Guardar Horario') }}
    </x-slot>

    <x-slot name="content">
        <div class="mt-4">
            <x-jet-label for="dias" value="{{ __('Dias de clase') }}" />
            <select id="turno" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            wire:model="dias">
                <option value="" selected disabled>-- Seleccionar dias de clase --</option>
                <option value="lunes a viernes">Lunes a viernes</option>
                <option value="sabados">Sabados</option>
                <option value="domingos">Domingos</option>
            </select>
            <x-jet-input-error for="dias" class="mt-2" />
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-3 mt-4">
            <div>
                <x-jet-label for="hora_inicio" value="{{ __('Hora inicio') }}" />
                <x-jet-input id="hora_inicio" type="time" class="mt-1 block w-full"
                    wire:model.debounce.800ms="hora_inicio" autofocus />
                <x-jet-input-error for="hora_inicio" class="mt-2" />
            </div>
            <div>
                <x-jet-label for="hora_fin" value="{{ __('Hora Fin') }}" />
                <x-jet-input id="hora_fin" type="time" class="mt-1 block w-full" wire:model.debounce.800ms="hora_fin"/>
                <x-jet-input-error for="hora_fin" class="mt-2" />
            </div>
        </div>
        <div class="mt-4">
            <x-jet-label for="turno" value="{{ __('Turno') }}" />
            <select id="turno" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                wire:model="turno">
                <option value="" selected disabled>-- Seleccionar turno --</option>
                <option value="mañana">Mañana</option>
                <option value="tarde">Tarde</option>
                <option value="noche">Noche</option>
            </select>
            <x-jet-input-error for="turno" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeModal()">
            {{ __('Close') }}
        </x-jet-secondary-button>
        @if ($horarioId)
            <x-jet-danger-button wire:click="update()" class="ml-2">
                {{ __('Update') }}
            </x-jet-danger-button>
        @else
            <x-jet-danger-button wire:click="save()" class="ml-2">
                {{ __('Save') }}
            </x-jet-danger-button>
        @endif
    </x-slot>
</x-jet-dialog-modal>
