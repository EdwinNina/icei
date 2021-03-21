<h1 class="text-gray-500 uppercase text-2xl mt-5 text-center">Nuevo Estudiante</h1>
    <div class="w-full">
        <div class="overflow-hidden bg-white sm:rounded-lg px-5 py-2">
            <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200">Datos Personales</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-3 mt-4">
                <div>
                    <x-required-label for="nombre" value="Nombre" />
                    <x-jet-input id="nombre" type="text" wire:model="nombre" class="mt-1 block w-full" wire:keydown.debounce.1000ms="createCode()"/>
                    <x-jet-input-error for="nombre" class="mt-2" />
                </div>
                <div>
                    <div class="flex text-xs justify-between items-start">
                        <x-jet-label for="paterno" value="Paterno" />
                        <span class="text-red-500 ml-1 text-right">Sino cuenta con apellido paterno Por Favor digite "-" o "."</span>
                    </div>
                    <x-jet-input id="paterno" type="text" wire:model="paterno" class="mt-1 block w-full" wire:keydown.debounce.1000ms="createCode()"/>
                    <x-jet-input-error for="paterno" class="mt-2" />
                </div>
                <div>
                    <x-required-label for="materno" value="Materno" />
                    <x-jet-input id="materno" type="text" wire:model="materno" class="mt-1 block w-full" wire:keydown.debounce.1000ms="createCode()"/>
                    <x-jet-input-error for="materno" class="mt-2" />
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center">
                    <div class="flex-auto mr-3">
                        <x-required-label for="carnet" value="Cedula de identidad" />
                        <x-jet-input id="carnet" type="number" wire:model="carnet"
                            class="mt-1 block w-full codigo" wire:keydown.debounce.1000ms="createCode()"/>
                        <x-jet-input-error for="carnet" class="mt-2" />
                    </div>
                    <div class="mr-3">
                        <x-jet-label for="complemento" value="Complemento" />
                        <x-jet-input id="complemento" type="text" wire:model="complemento"
                            class="mt-1 block w-full"/>
                        <x-jet-input-error for="complemento" class="mt-2" />
                    </div>
                    <div class="flex-1">
                        <x-required-label for="expedido" value="Expedido"></x-required-label>
                        <select wire:model.lazy="expedido" id="expedido" class="custom-select sm:text-sm">
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
                <x-jet-input id="email" type="email" wire:model.lazy="email" class="mt-1 block w-full" />
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
            <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200">Referencias Familiares</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-3 mt-4">
                <div>
                    <x-required-label for="nombreFamiliar" value="Nombre" />
                    <x-jet-input id="nombreFamiliar" type="text" wire:model.lazy="nombreFamiliar" class="mt-1 block w-full codigo" />
                    <x-jet-input-error for="nombreFamiliar" class="mt-2" />
                </div>
                <div>
                    <x-required-label for="paternoFamiliar" value="Paterno" />
                    <x-jet-input id="paternoFamiliar" type="text" wire:model.lazy="paternoFamiliar" class="mt-1 block w-full codigo" />
                    <x-jet-input-error for="paternoFamiliar" class="mt-2" />
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-3 mt-4">
                <div>
                    <x-required-label for="maternoFamiliar" value="Materno" />
                    <x-jet-input id="maternoFamiliar" type="text" wire:model.lazy="maternoFamiliar" class="mt-1 block w-full codigo" />
                    <x-jet-input-error for="maternoFamiliar" class="mt-2" />
                </div>
                <div class="flex-1 mr-3">
                    <x-required-label for="celularFamiliar" value="Celular" />
                    <x-jet-input id="celularFamiliar" type="number" wire:model.lazy="celularFamiliar" class="mt-1 block w-full" />
                    <x-jet-input-error for="celularFamiliar" class="mt-2" />
                </div>
            </div>

            <h2 class="text-sm uppercase text-blue-500 border-b-2 mt-4 border-gray-200">Datos Académicos</h2>
            <div class="mt-4">
                <div class="flex items-center">
                    <div class="flex-1 mr-3">
                        <x-required-label for="grado" value="Grado académico" />
                        <select wire:model.lazy="grado" id="grado" class="custom-select sm:text-sm">
                            <option value="" selected>-- Seleccionar grado --</option>
                            @foreach ($grados as $key => $grado)
                                <option value="{{ $key }}">{{$grado}}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="grado" class="mt-2" />
                    </div>
                    <div class="flex-1">
                        <x-required-label for="carrera" value="Carrera" />
                        <x-jet-input id="carrera" wire:model.lazy="carrera" type="text" class="block w-full"/>
                        <x-jet-input-error for="carrera" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center">
                    <div class="flex-1 sm:flex-auto mr-3">
                        <x-jet-label for="profesion" value="Profesión" />
                        <x-jet-input id="profesion" type="text" wire:model.lazy="profesion" class="block w-full"/>
                        <x-jet-input-error for="profesion" class="mt-2" />
                    </div>
                    <div class="flex-1 sm:flex-auto">
                        <x-required-label for="universidad" value="Universidad" />
                        <x-jet-input id="universidad" type="text" wire:model.lazy="universidad" class="block w-full"/>
                        <x-jet-input-error for="universidad" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="my-4 flex justify-end">
                <x-back-button href="{{ route('admin.estudiantes.index') }}" class="mr-2">Volver</x-back-button>
                @if ($estudianteId)
                    <x-jet-danger-button type="button" wire:click="update()">Guardar</x-jet-danger-button>
                @else
                    <x-jet-danger-button type="button" wire:click="save()" wire:loading.attr="disabled">Registrar</x-jet-danger-button>
            @endif
            </div>
        </div>
    </div>
