<x-jet-dialog-modal wire:model="modalRoleVisible">
    <x-slot name="title">Asignar Rol</x-slot>

    <x-slot name="content">
        <div>
            <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 mb-3">Datos Usuario</h2>
            <x-jet-label for="name" value="Nombre de usuario"/>
            <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="name" readonly />
        </div>
        <div class="mt-4">
            <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 mb-3">Seleccionar Rol</h2>
            @foreach ($allRoles as $role)
                <label for="roles" class="flex items-center">
                    <x-jet-checkbox wire:model.defer="roles" value="{{$role->id}}"/>
                    <span class="ml-2 text-sm text-gray-600">{{ $role->name }}</span>
                </label>
            @endforeach
            <x-jet-input-error for="roles" class="mt-2" />
        </div>
        @if (count($currentRoles) > 0)
            <div class="mt-4">
                <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 mb-3">Rol actual del usuario</h2>
                <div class="flex justify-start items-center">
                    @foreach ($currentRoles as $role)
                    <div class="flex justify-center items-center">
                        <svg class="w-6 h-6 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-green-600 mr-3">{{ $role }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        @else
            <p class="text-red-400 mt-3">Este usuario no tiene roles aún</p>
        @endif
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('modalRoleVisible', false)">Cerrar</x-jet-secondary-button>
        <x-jet-danger-button wire:click="updateRole()" class="ml-2" wire:loading.attr="disabled">Asignar rol</x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>
