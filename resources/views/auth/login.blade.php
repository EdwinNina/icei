<x-guest-layout>
    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">Iniciar Sesión</h2>
    <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">Ingresa a nuestra plataforma web para poder ver y conocer
        el avance academico que tienes en nuestra institución
    </div>

    <x-jet-validation-errors class="my-3" />

    @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
{{--         <div class="intro-x mt-8 w-96">
            <div>
                <x-jet-label for="email" value="Correo electrónico" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>
            <div class="mt-4">
                <x-jet-label for="password" value="Contraseña" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>
        </div> --}}
        <div class="flex flex-col mt-8 w-auto md:w-96">
            <div class="flex-1">
                <x-jet-label for="email" value="Correo electrónico" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>
            <div class="flex-1 mt-4">
                <x-jet-label for="password" value="Contraseña" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>
        </div>

        <div class="intro-x flex text-gray-700 dark:text-gray-600 text-xs sm:text-sm mt-4">
            <div class="block mt-4 flex-1">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">Recuerdame</span>
                </label>
            </div>
            <div class="flex items-center justify-center mt-4">
                <x-jet-button class="ml-4 w-32 flex justify-center">Ingresar</x-jet-button>
            </div>
        </div>
    </form>
</x-guest-layout>
