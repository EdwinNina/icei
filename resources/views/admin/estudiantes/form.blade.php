    <h1 class="text-gray-500 uppercase text-2xl mt-5 text-center">Nuevo Estudiante</h1>
    <div class="py-5">
        <div class="w-full">
            <div class="overflow-hidden bg-white sm:rounded-lg p-5">
                <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200">Datos Personales</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-3 mt-4">
                    <div>
                        <x-required-label for="nombre" value="Nombre" />
                        <x-jet-input id="nombre" type="text" wire:model="nombre" class="mt-1 block w-full codigo" />
                        <x-jet-input-error for="nombre" class="mt-2" />
                    </div>
                    <div>
                        <x-required-label for="paterno" value="Paterno" />
                        <x-jet-input id="paterno" type="text" wire:model="paterno" class="mt-1 block w-full codigo" />
                        <x-jet-input-error for="paterno" class="mt-2" />
                    </div>
                    <div>
                        <x-required-label for="materno" value="Materno" />
                        <x-jet-input id="materno" type="text" wire:model="materno" class="mt-1 block w-full codigo" />
                        <x-jet-input-error for="materno" class="mt-2" />
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center">
                        <div class="flex-auto mr-3">
                            <x-required-label for="carnet" value="Cedula de identidad" />
                            <x-jet-input id="carnet" type="number" wire:model="carnet"
                                class="mt-1 block w-full codigo" wire:keydown="createCode()"/>
                            <x-jet-input-error for="carnet" class="mt-2" />
                        </div>
                        <div class="flex-1">
                            <x-required-label for="expedido" value="Expedido"></x-required-label>
                            <select wire:model="expedido" id="expedido" class="custom-select sm:text-sm">
                                <option value="" selected>-- Seleccionar expedido --</option>
                                @foreach ($expedidos as $key => $expedido)
                                    <option value="{{ $key }}">{{$expedido}}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="expedido" class="mt-2" />
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <x-required-label for="email" value="Correo electrónico" />
                    <x-jet-input id="email" type="email" wire:model="email" class="mt-1 block w-full" />
                    <x-jet-input-error for="email" class="mt-2" />
                </div>
                <div class="mt-4 mb-4">
                    <div class="flex flex-col sm:flex-row">
                        <div class="flex-1 mr-3">
                            <x-required-label for="celular" value="Celular" />
                            <x-jet-input id="celular" type="number" wire:model="celular" class="mt-1 block w-full" />
                            <x-jet-input-error for="celular" class="mt-2" />
                        </div>
                        <div class="flex-1 mr-3">
                            <x-required-label for="codigo" value="Código Estudiante" />
                            <x-jet-input id="codigo" type="text" wire:model="codigo" class="mt-1 block w-full" readonly/>
                        </div>
                    </div>
                </div>
                <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200">Datos Académicos</h2>
                <div class="mt-4">
                    <div class="flex items-center">
                        <div class="flex-1 mr-3">
                            <x-required-label for="grado" value="Grado académico" />
                            <select wire:model="grado" id="grado" class="custom-select sm:text-sm">
                                <option value="" selected>-- Seleccionar grado --</option>
                                @foreach ($grados as $key => $grado)
                                    <option value="{{ $key }}">{{$grado}}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="grado" class="mt-2" />
                        </div>
                        <div class="flex-1">
                            <x-required-label for="carrera" value="Carrera" />
                            <x-jet-input id="carrera" wire:model="carrera" type="text" class="block w-full"/>
                            <x-jet-input-error for="carrera" class="mt-2" />
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center">
                        <div class="flex-1 sm:flex-auto m-0 sm:mr-3">
                            <x-jet-label for="profesion" value="Profesión" />
                            <x-jet-input id="profesion" type="text" wire:model="profesion" class="block w-full"/>
                            <x-jet-input-error for="profesion" class="mt-2" />
                        </div>
                        <div class="flex-1 sm:flex-auto">
                            <x-required-label for="universidad" value="Universidad" />
                            <x-jet-input id="universidad" type="text" wire:model="universidad" class="block w-full"/>
                            <x-jet-input-error for="universidad" class="mt-2" />
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <x-back-button href="{{ route('admin.estudiante.index') }}" class="mr-2">Volver</x-back-button>
                    @if ($estudianteId)
                        <x-jet-button type="button" wire:click="update()">Guardar</x-jet-button>
                    @else
                        <x-jet-button type="button" wire:click="save()" wire:loading.attr="disabled">Registrar</x-jet-button>
                @endif
                </div>
            </div>
        </div>
    </div>
