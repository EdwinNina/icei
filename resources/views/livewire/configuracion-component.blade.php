<div>
    <div class="p-6">
        <h1 class="text-gray-500 uppercase text-2xl text-center">Datos de la Empresa</h1>
        <div class="mt-4">
            <x-jet-label for="nombre" value="Nombre" />
            <x-jet-input id="nombre" type="text" wire:model.defer="nombre" class="mt-1 block w-full"/>
            <x-jet-input-error for="nombre" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-jet-label for="direccion" value="Dirección" />
            <x-jet-input id="direccion" type="text" wire:model.defer="direccion" class="mt-1 block w-full"/>
            <x-jet-input-error for="direccion" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-jet-label for="telefono" value="Teléfono" />
            <x-jet-input id="telefono" type="number" wire:model.defer="telefono" class="mt-1 block w-full"/>
            <x-jet-input-error for="telefono" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-jet-label for="celular" value="Celular" />
            <x-jet-input id="celular" type="number" wire:model.defer="celular" class="mt-1 block w-full"/>
            <x-jet-input-error for="celular" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-jet-label for="pagina_web" value="Página web" />
            <x-jet-input id="pagina_web" type="text" wire:model.defer="pagina_web" class="mt-1 block w-full"/>
            <x-jet-input-error for="pagina_web" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-jet-label for="director_academico" value="Nombre del Director Académico" />
            <x-jet-input id="director_academico" type="text" wire:model.defer="director_academico" class="mt-1 block w-full"/>
            <x-jet-input-error for="director_academico" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-jet-label for="nota_minima_aprobacion" value="Nota mínima de aprobación" />
            <x-jet-input id="nota_minima_aprobacion" type="number"
                wire:model.defer="nota_minima_aprobacion" class="mt-1 block w-full"/>
            <x-jet-input-error for="nota_minima_aprobacion" class="mt-2" />
        </div>
    </div>
    <div class="mt-4 py-3 px-6 bg-gray-100 flex justify-end">
        <x-jet-danger-button wire:click.prevent="update()">Guardar</x-jet-danger-button>
    </div>
</div>
