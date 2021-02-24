<x-app-layout>
    @section('breads')
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
            <a href="">Modulo</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i>
            <a href="" class="breadcrumb--active">Horarios</a>
        </div>
    @endsection

    <div class="py-5">
        <div class="w-full">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('horario-component')
            </div>
        </div>
    </div>

</x-app-layout>
