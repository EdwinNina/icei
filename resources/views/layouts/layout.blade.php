<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('images/logo2.png') }}" rel="shortcut icon">
        <meta name="author" content="ICEI">
        <title>ICEI TECH</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>

        <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
        @livewireStyles
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="bg-gray-100">
        <header class="body-font bg-white shadow-md">
            <div class="container mx-auto flex flex-wrap py-3 px-6 flex-col md:flex-row items-center">
                <img src="{{asset('images/logo.svg')}}" alt="ICEI TECH" class="max-h-16 w-auto">
                <nav class="md:ml-auto md:mr-auto flex flex-wrap items-center text-base justify-center">
                    <a class="mr-5 text-gray-600 hover:text-gray-900 hover:underline {{request()->routeIs('inicio') ? 'border-b-2 border-yellow-500 text-yellow-500' : ''}}"
                        href="{{ route('inicio') }}">Inicio</a>
                    <a class="mr-5 hover:text-gray-900 hover:underline {{request()->is('cursos/*') ? 'border-b-2 border-yellow-500 text-yellow-500' : ''}}"
                        href="{{ route('cursos') }}">Cursos</a>
                </nav>
                @auth
                    @livewire('navigation-menu')
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0 hover:underline">Ingresar</a>
                @endauth
            </div>
        </header>
        @yield('hero')
        <main>
            @yield('content')
        </main>
        <footer class="text-gray-400 bg-gray-900 body-font">
            <div class="container px-5 py-8 mx-auto flex items-center sm:flex-row flex-col">
              <a class="flex title-font font-medium items-center md:justify-start justify-center text-white">
                <img src="{{asset('images/logo2.png')}}" alt="ICEI TECH" class="max-h-10">
              </a>
              <p class="text-sm text-gray-400 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-800 sm:py-2 sm:mt-0 mt-4">© <span id="anio"></span> Empresa de la tecnologia de la información
              </p>
              <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
                <a href="https://www.facebook.com/instituto.icei.srl" target="_blank" class="text-gray-400">
                  <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                  </svg>
                </a>
              </span>
            </div>
        </footer>
    </body>
    @stack('modals')
    @livewireScripts
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const anio = document.getElementById('anio');
            const fecha = new Date();
            let onlyAnio = fecha.getFullYear();
            anio.textContent = onlyAnio;
        });
    </script>
</html>
