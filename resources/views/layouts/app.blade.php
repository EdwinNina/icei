<!DOCTYPE html>
<html lang="es">
    <head>
        @trixassets
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('images/logo.svg') }}" rel="shortcut icon">

        <meta name="author" content="ICEI">
        <title>{{ config('app.name', 'ICEI') }}</title>
        <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
        />
        <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">
        <link rel="stylesheet" href="{{ asset('css/plantilla.css') }}" />
        <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
        <link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
        @yield('styles')
        @livewireStyles
        <script src="{{ mix('js/app.js')}}" defer></script>
    </head>
    <body>
                <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
                <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>

    <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-gray-900 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
        <div class="flex items-center justify-center mt-8">
            <div class="flex items-center">
                <svg class="h-12 w-12" viewbox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M364.61 390.213C304.625 450.196 207.37 450.196 147.386 390.213C117.394 360.22 102.398 320.911 102.398 281.6C102.398 242.291 117.394 202.981 147.386 172.989C147.386 230.4 153.6 281.6 230.4 307.2C230.4 256 256 102.4 294.4 76.7999C320 128 334.618 142.997 364.608 172.989C394.601 202.981 409.597 242.291 409.597 281.6C409.597 320.911 394.601 360.22 364.61 390.213Z" fill="#4C51BF" stroke="#4C51BF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M201.694 387.105C231.686 417.098 280.312 417.098 310.305 387.105C325.301 372.109 332.8 352.456 332.8 332.8C332.8 313.144 325.301 293.491 310.305 278.495C295.309 263.498 288 256 275.2 230.4C256 243.2 243.201 320 243.201 345.6C201.694 345.6 179.2 332.8 179.2 332.8C179.2 352.456 186.698 372.109 201.694 387.105Z" fill="white"></path>
                </svg>

                <span class="text-white text-2xl mx-2 font-semibold">Dashboard</span>
            </div>
        </div>
        @include('layouts.sidebar-menu')
    </div>
                <div class="flex-1 flex flex-col overflow-hidden">
                    <header class="flex justify-between items-center py-4 px-6 bg-white border-b-2 border-gray-400">
        <div class="flex items-center">
            <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                <svg class="h-6 w-6" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </button>

        </div>

        <div class="flex items-center">
            <div x-data="{ notificationOpen: false }" class="relative">
                <button @click="notificationOpen = ! notificationOpen" class="flex mx-4 text-gray-600 focus:outline-none">
                    <svg class="h-6 w-6" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 17H20L18.5951 15.5951C18.2141 15.2141 18 14.6973 18 14.1585V11C18 8.38757 16.3304 6.16509 14 5.34142V5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5V5.34142C7.66962 6.16509 6 8.38757 6 11V14.1585C6 14.6973 5.78595 15.2141 5.40493 15.5951L4 17H9M15 17V18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18V17M15 17H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>

                <div x-show="notificationOpen" @click="notificationOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

                <div x-show="notificationOpen" :hidden="!notificationOpen" class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl overflow-hidden z-10" style="width:20rem;">
                    <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:text-white hover:bg-indigo-600 -mx-2">
                        <img class="h-8 w-8 rounded-full object-cover mx-1" src="{{ asset('images/user1.jpg') }}" alt="avatar">
                        <p class="text-sm mx-2">
                            <span class="font-bold" href="#">Sara Salah</span> replied on the <span class="font-bold text-indigo-400" href="#">Upload Image</span> artical . 2m
                        </p>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:text-white hover:bg-indigo-600 -mx-2">
                        <img class="h-8 w-8 rounded-full object-cover mx-1" src="{{ asset('images/user2.jpg') }}" alt="avatar">
                        <p class="text-sm mx-2">
                            <span class="font-bold" href="#">Slick Net</span> start following you . 45m
                        </p>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:text-white hover:bg-indigo-600 -mx-2">
                        <img class="h-8 w-8 rounded-full object-cover mx-1" src="{{ asset('images/user3.jpg') }}" alt="avatar">
                        <p class="text-sm mx-2">
                            <span class="font-bold" href="#">Jane Doe</span> Like Your reply on <span class="font-bold text-indigo-400" href="#">Test with TDD</span> artical . 1h
                        </p>
                    </a>
                </div>
            </div>

            <div x-data="{ dropdownOpen: false }" class="relative">
                <button @click="dropdownOpen = ! dropdownOpen" class="relative block h-8 w-8 rounded-full overflow-hidden shadow focus:outline-none">
                    <img class="h-full w-full object-cover" src="{{ Auth::user()->profile_photo_url }}">
                </button>

                <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

                <div x-show="dropdownOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10">
                    <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">
                    Configuraciones</a>
                    @can('docente.perfil.edit')
                        <a href="{{ route('docente.perfil.edit', Auth::user()->id ) }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Mi Perfil</a>
                    @endcan
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">
                            Cerrar sesión
                        </a>
                    </form>

                </div>
            </div>
        </div>
    </header>
    <main class="flex-1 overflow-x-hidden overflow-y-auto">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    <div class="align-middle inline-block min-w-full overflow-hidden sm:rounded-lg">
                        {{$slot}}
                    </div>
                </div>
            </div>
        </div>
    </main>
                </div>
            </div>
    @stack('modals')
    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <script src="{{ asset('js/select2.min.js')}}"></script>
    <script src="{{ asset('js/plantilla.js') }}"></script>
    <script>
        window.livewire.on('messageSuccess', value => {
            switch (value) {
                case 'create':
                    toastr.success('Correcto', 'Registro agregado correctamente');
                    break;
                case 'update':
                    toastr.success('Correcto', 'Registro actualizado correctamente');
                break;
                default:
                    window.livewire.on('messageFailed', () => {
                        toastr.error('Incorrecto', 'Hubo un error, intentelo de nuevo!');
                    });
                break;
            }
        });
        window.livewire.on('customMessage', message => {
            toastr.success('Correcto', message);
        });

        window.livewire.on('deleteItem', () => {
            toastr.success('Correcto', 'Registro eliminado correctamente');
        });
        window.livewire.on('selectEstudiante', () => {
            $('#estudiantes').select2({
                placeholder: "Hola"
            });
        });
    </script>
    @yield('scripts')
  </body>
</html>
