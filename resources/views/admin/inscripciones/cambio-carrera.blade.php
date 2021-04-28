<div class="pb-4">
    <form action="{{ route('admin.inscripciones.cambiarCarrera', $inscripcion->id) }}" method="POST">
        @csrf
        @method('PUT')
        <h2 class="text-sm uppercase text-blue-500 border-b-2 mt-4 border-gray-200 mb-3">Nombre del Curso o Modulo de Formación Especializada</h2>
        @livewire('filtro-planificacion-component')
        <div class="flex justify-end mt-6 py-4">
            <x-back-button href="{{ route('admin.inscripciones.index') }}" class="mr-2">Volver</x-back-button>
            <x-jet-danger-button type="submit">Guardar</x-jet-danger-button>
        </div>
    </form>
</div>
