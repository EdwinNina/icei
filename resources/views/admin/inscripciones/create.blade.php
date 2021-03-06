<x-app-layout>
    <div class="py-2">
        <div class="w-full bg-white shadow-md rounded-md py-5 px-8">
            @livewire('inscripcion-form-component', [
                'estudiante' => $estudiante,
                'horarios' => $horarios,
                'carreras' => $carreras,
                'pagos' => $pagos,
            ])
        </div>
    </div>
</x-app-layout>
