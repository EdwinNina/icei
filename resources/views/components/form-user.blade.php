<x-jet-dialog-modal wire:model="modalFormUserVisible">
    <x-slot name="title">
        Asignación de Usuario
    </x-slot>

    <x-slot name="content">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
            <section class="px-2">
                <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 mb-3">Datos Personales</h2>
                <p>Nombre Completo:</p>
                <span class="text-gray-600">
                    {{$nombre}} {{$paterno}} {{$materno}}
                </span>
                <p class="text-blue-500 font-semibold text-justify text-sm mt-2">
                    El sistema utilizará el correo del usuario como el correo de ingreso al sistema,
                    como tambien usará el codigo del estudiante generado para su contraseña que siguen
                    el patrón de las iniciales en mayuscula del paterno, materno y nombre seguido del
                    numero de carnet de identidad.
                    Tambien el sistema otorgará automaticamente el rol que le pertenece a este usuario.
                </p>
            </section>
            <section>
                <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 mb-3">Datos del usuario</h2>
                <div>
                    <x-jet-label for="userName" value="Nombre de usuario"/>
                    <x-jet-input id="userName" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="userName" readonly />
                    <x-jet-input-error for="userName" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="userEmail" value="Correo electronico"/>
                    <x-jet-input id="userEmail" class="block mt-1 w-full" type="email" wire:model.debounce.800ms="userEmail" readonly />
                    <x-jet-input-error for="userEmail" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="userPassword" value="Contraseña"/>
                    <div class="flex items-center">
                        <x-jet-input id="userPassword" class="block mt-1 w-full" type="{{$password ? 'password': 'text'}}" wire:model.debounce.800ms="userPassword" />
                        <span class="p-3 border bg-gray-100 rounded border-gray-200 hover:bg-gray-200 cursor-pointer focus:bg-gray-200
                            transition-all"
                            wire:click="$toggle('password')">
                            <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                          </svg>
                        </span>
                    </div>
                </div>
            </section>
        </div>
    </x-slot>
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$set('modalFormUserVisible', false)" class="mr-2">Volver</x-jet-secondary-button>
        <x-jet-danger-button wire:click="addUser()">Agregar usuario</x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>
