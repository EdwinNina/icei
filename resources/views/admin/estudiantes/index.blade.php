<x-app-layout>
    @section('breads')
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="">Modulo</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="" class="breadcrumb--active">Estudiantes</a>
        </div>
    @endsection

    <div class="w-full">
        <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
            @livewire('estudiante-component')
        </div>
    </div>

</x-app-layout>
