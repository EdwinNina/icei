<x-jet-dialog-modal wire:model="modalFormVisible">
    <x-slot name="title">
        {{ __('Guardar Horario') }}
    </x-slot>

    <x-slot name="content">
        <div class="mt-4">
            <x-jet-label for="titulo" value="{{ __('Titulo') }}" />
            <x-jet-input id="titulo" type="text" class="mt-1 block w-full"
                wire:model.debounce.800ms="titulo" autofocus />
            <x-jet-input-error for="titulo" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-jet-label for="titulo" value="{{ __('Descripción') }}" />
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
        <div class="mt-4">
            <x-jet-label for="requisitos" value="{{ __('Requisitos') }}" />
            <x-jet-input id="requisitos" type="text" class="mt-1 block w-full"
                wire:model.debounce.800ms="requisitos" />
            <x-jet-input-error for="requisitos" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-3 mt-4">
            <div>
                <x-jet-label for="cargaHoraria" value="{{ __('Carga Horaria') }}" />
                <x-jet-input id="cargaHoraria" type="number" class="mt-1 block w-full"
                    wire:model.debounce.800ms="cargaHoraria" />
                <x-jet-input-error for="cargaHoraria" class="mt-2" />
            </div>
            <div>
                <x-jet-label for="modalidad" value="{{ __('Modalidad') }}" />
                <select id="modalidad" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model="modalidad">
                    <option value="" selected disabled>-- Seleccionar modalidad --</option>
                    <option value="presencial">Presencial</option>
                    <option value="semi-presencial">Semi presencial</option>
                    <option value="virtual">Virtual</option>
                </select>
                <x-jet-input-error for="modalidad" class="mt-2" />
            </div>
            <div>
                <x-jet-label for="category_id" value="{{ __('Categoria del curso') }}" />
                <select id="turno" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" wire:model="category_id">
                    <option value="" selected disabled>-- Seleccionar categoria --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{$category->nombre}}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="category_id" class="mt-2" />
            </div>
        </div>
        <div class="mt-4">
            @if ($portada)
                <img src="{{ $portada->temporaryUrl() }}" class="h-10 w-10">
            @endif
            <x-jet-label for="category_id" value="{{ __('Portada del curso') }}" />
            <x-jet-input id="portada" type="file" class="mt-1 block w-full"
            wire:model.debounce.800ms="portada" />
            <x-jet-input-error for="portada" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-jet-label for="teacher_id" value="{{ __('Docente a cargo') }}" />
            <select id="teacher_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                wire:model="teacher_id">
                <option value="" selected disabled>-- Seleccionar docente --</option>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{$teacher->nombre}} {{$teacher->paterno}} {{$teacher->materno}}</option>
                @endforeach
            </select>
            <x-jet-input-error for="teacher_id" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeModal()">
            {{ __('Close') }}
        </x-jet-secondary-button>
        @if ($cursoId)
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
