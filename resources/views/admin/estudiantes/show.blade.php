<x-jet-dialog-modal wire:model="modalShowVisible">
    <x-slot name="title">
        Informacion del Estudiante
    </x-slot>

    <x-slot name="content">
        <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 mb-3">Datos Personales</h2>
        <p>Nombre Completo: {{$nombre}} {{$paterno}} {{$materno}}</p>
        <p>Cédula de identidad: {{$carnet}} {{$expedido}}</p>
        <p>Correo electrónico: {{$email}}</p>
        <p>Celular: {{$celular}}</p>
        <h2 class="text-sm uppercase text-blue-500 border-b-2 border-gray-200 my-3">Datos Académicos</h2>
        <p>Grado: {{$grado}}</p>
        <p>Profesión: {{$profesion}}</p>
        <p>Carrera: {{$carrera}}</p>
        <p>Universidad: {{$universidad}}</p>
    </x-slot>

    <x-slot name="footer">
        <a href="{{ route('estudiante.index') }}" class="btn btn-dark mr-2 mb-2">Volver</a>
    </x-slot>
</x-jet-dialog-modal>
