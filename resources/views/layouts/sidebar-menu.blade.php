<nav class="mt-10">
    <a class="flex items-center mt-4 py-2 px-6 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ request()->routeIs('dashboard') ? 'bg-gray-700 text-gray-100' : 'text-gray-500' }}" href="index.htm">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
        </svg>
        <span class="mx-3">Dashboard</span>
    </a>
    <a class="flex items-center mt-4 py-2 px-6 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ request()->routeIs('categoria.*') ? 'bg-gray-700 text-gray-100' : 'text-gray-500' }}"
        href="{{route('categoria.index')}}">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
        </svg>
        <span class="mx-3">Categorias</span>
    </a>
    <a class="flex items-center mt-4 py-2 px-6 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ request()->routeIs('admin.carrera.*') ? 'bg-gray-700 text-gray-100' : 'text-gray-500' }}"
        href="{{route('admin.carrera.index')}}">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
        </svg>
        <span class="mx-3">Carreras</span>
    </a>
    <a class="flex items-center mt-4 py-2 px-6 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ request()->routeIs('horario.*') ? 'bg-gray-700 text-gray-100' : 'text-gray-500' }}"
        href="{{route('horario.index')}}">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
        </svg>
        <span class="mx-3">Horarios</span>
    </a>
    <a class="flex items-center mt-4 py-2 px-6 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ request()->routeIs('admin.modulo.*') ? 'bg-gray-700 text-gray-100' : 'text-gray-500' }}"
        href="{{route('admin.modulo.index')}}">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
        </svg>
        <span class="mx-3">Módulos de Carrera</span>
    </a>
    <a class="flex items-center mt-4 py-2 px-6 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ request()->routeIs('estudiante.*') ? 'bg-gray-700 text-gray-100' : 'text-gray-500' }}"
        href="{{route('estudiante.index')}}">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
        </svg>
        <span class="mx-3">Estudiantes</span>
    </a>
    <a class="flex items-center mt-4 py-2 px-6 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ request()->routeIs('docente.*') ? 'bg-gray-700 text-gray-100' : 'text-gray-500' }}" href="{{route('docente.index')}}">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
        </svg>
        <span class="mx-3">Docentes</span>
    </a>

</nav>
