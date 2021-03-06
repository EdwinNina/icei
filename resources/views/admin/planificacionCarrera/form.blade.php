<x-jet-dialog-modal wire:model="modalFormVisible">
    <x-slot name="title">
        <div class="flex items-center justify-between">
            <h1>Guardar Planificacion de Carrera</h1>
            <span>Gestión: {{$gestion}}</span>
        </div>
    </x-slot>
    <x-slot name="content">
        <div class="mt-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <x-required-label for="carrera_id" value="Carrera" />
                    <select class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none   focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="carrera_id" wire:model="carrera_id" value="{{ old('carrera_id') }}">
                        <option value="" selected disabled>-- Seleccionar carrera --</option>
                        @foreach ($carreras as $carrera)
                            <option value="{{ $carrera->id }}">{{ $carrera->titulo }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="carrera_id" class="mt-2" />
                </div>
                <div>
                    <x-required-label for="modalidad" value="Modalidad" />
                    <select class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none   focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        id="modalidad" wire:model="modalidad" value="{{ old('modalidad') }}">
                        <option value="" selected disabled>-- Seleccionar modalidad --</option>
                        @foreach ($modalidades as $key => $modalidad)
                            <option value="{{ $key }}">{{ $modalidad }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="modalidad" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="mt-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <x-required-label for="costo_carrera" value="Costo de la Carrera" />
                    <x-jet-input id="costo_carrera" type="number" class="mt-1 block w-full" wire:model.debounce.800ms="costo_carrera" value="{{ old('costo_carrera') }}"/>
                    <x-jet-input-error for="costo_carrera" class="mt-2" />
                </div>
                <div>
                    <x-required-label for="costo_modulo" value="Costo del modulo" />
                    <x-jet-input id="costo_modulo" type="number" class="mt-1 block w-full" wire:model.debounce.800ms="costo_modulo" value="{{ old('costo_modulo') }}"/>
                    <x-jet-input-error for="costo_modulo" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="mt-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <x-required-label for="fecha_inicio" value="Inicio del curso" />
                    <x-jet-input id="fecha_inicio" type="date" class="mt-1 block w-full" wire:model.debounce.800ms="fecha_inicio" value="{{ old('fecha_inicio') }}"/>
                    <x-jet-input-error for="fecha_inicio" class="mt-2" />
                </div>
                <div>
                    <x-required-label for="fecha_fin" value="Finalización del curso" />
                    <x-jet-input id="fecha_fin" type="date" class="mt-1 block w-full" wire:model.debounce.800ms="fecha_fin" value="{{ old('fecha_fin') }}"/>
                    <x-jet-input-error for="fecha_fin" class="mt-2" />
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('modalFormVisible')">Cerrar</x-jet-secondary-button>
        @if ($planificacionId)
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
