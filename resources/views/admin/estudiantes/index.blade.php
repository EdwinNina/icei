<x-app-layout>
    @if (session('failures'))
    <div class="bg-red-500 border-l-4 px-5 py-2 rounded mb-3 border-red-600">
        <ul class="list-none">
            @foreach (session('failures') as $failure)
                @foreach ($failure->errors() as $error)
                    <li class="text-white text-center">{{ $error }}</li>
                @endforeach
            @endforeach
        </ul>
    </div>
    @endif

    <div class="w-full">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @livewire('estudiante-component')
        </div>
    </div>

</x-app-layout>
