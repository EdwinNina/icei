<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="https://kit.fontawesome.com/0d316eb6d8.js" crossorigin="anonymous"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-50">
            <header class="body-font bg-white shadow-md">
                <div class="container mx-auto flex flex-wrap py-3 px-6 flex-col md:flex-row items-center">
                    <img src="{{asset('images/logo.png')}}" alt="ICEI TECH" class="max-h-10">
                    <nav class="md:ml-auto md:mr-auto flex flex-wrap items-center text-base justify-center">
                        <a class="mr-5 border-b-2 border-yellow-500 text-gray-600 hover:text-gray-900 hover:underline {{request()->routeIs('inicio') ? 'text-yellow-500' : ''}}"
                            href="{{ route('inicio') }}">Inicio</a>
                        <a class="mr-5 hover:text-gray-900 hover:underline {{request()->is('cursos/*') ? 'text-yellow-500' : ''}}"
                            href="{{ route('cursos') }}">Cursos</a>
                    </nav>
                    @auth
                        @livewire('navigation-menu')
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0 hover:underline">Ingresar</a>
                    @endauth
                </div>
            </header>
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
