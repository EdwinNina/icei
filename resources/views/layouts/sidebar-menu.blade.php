{{-- <nav class="mt-10">
    <a class="flex items-center mt-4 py-2 px-6 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100 {{ request()->routeIs('dashboard') ? 'bg-gray-700 text-gray-100' : 'text-gray-500' }}" href="index.htm">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
        </svg>
        <span class="mx-3">Dashboard</span>
    </a>
    @can('admin.categoria.index')
        <a class="flex items-center mt-4 py-2 px-6 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100
        {{ request()->routeIs('admin.categoria.*') ? 'bg-gray-700 text-gray-100' : 'text-gray-500' }}"
            href="{{route('admin.categoria.index')}}">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
            </svg>
            <span class="mx-3">Categorias</span>
        </a>
    @endcan
    @can('admin.carrera.index')
        <a class="flex items-center mt-4 py-2 px-6 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100
        {{ request()->routeIs('admin.carreras.*') ? 'bg-gray-700 text-gray-100' : 'text-gray-500' }}"
            href="{{route('admin.carreras.index')}}">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
            </svg>
            <span class="mx-3">Carreras</span>
        </a>
    @endcan
    @can('admin.tipoPagos.index')
        <a class="flex items-center mt-4 py-2 px-6 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100
            {{ request()->routeIs('admin.horario.*') ? 'bg-gray-700 text-gray-100' : 'text-gray-500' }}"
            href="{{route('admin.horario.index')}}">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
            </svg>
            <span class="mx-3">Horarios</span>
        </a>
    @endcan
    @can('admin.modulo.index')
        <a class="flex items-center mt-4 py-2 px-6 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100
        {{ request()->routeIs('admin.modulo.*') ? 'bg-gray-700 text-gray-100' : 'text-gray-500' }}"
            href="{{route('admin.modulo.index')}}">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
            </svg>
            <span class="mx-3">Módulos de Carrera</span>
        </a>
    @endcan
    <a class="flex items-center mt-4 py-2 px-6 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100
    {{ request()->routeIs('admin.planificacionCarrera.index') ? 'bg-gray-700 text-gray-100' : 'text-gray-500' }}"
        href="{{route('admin.planificacionCarrera.index')}}">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
        </svg>
        <span class="mx-3">Planificación de Carrera</span>
    </a>
    @can('admin.estudiante.index')
        <a class="flex items-center mt-4 py-2 px-6 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100
        {{ request()->routeIs('admin.estudiante.*') ? 'bg-gray-700 text-gray-100' : 'text-gray-500' }}"
            href="{{route('admin.estudiante.index')}}">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
            </svg>
            <span class="mx-3">Estudiantes</span>
        </a>
    @endcan
    <a class="flex items-center mt-4 py-2 px-6 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100
    {{ request()->routeIs('admin.inscripciones.*') ? 'bg-gray-700 text-gray-100' : 'text-gray-500' }}"
        href="{{route('admin.inscripciones.index')}}">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
        </svg>
        <span class="mx-3">Inscripciones</span>
    </a>
    @can('admin.docente.index')
        <a class="flex items-center mt-4 py-2 px-6 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100
            {{ request()->routeIs('admin.docente.*') ? 'bg-gray-700 text-gray-100' : 'text-gray-500' }}" href="{{route('admin.docente.index')}}">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
            </svg>
            <span class="mx-3">Docentes</span>
        </a>
    @endcan
    @can('admin.tipoPagos.index')
    <a class="flex items-center mt-4 py-2 px-6 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100
        {{ request()->routeIs('admin.tipoPagos.*') ? 'bg-gray-700 text-gray-100' : 'text-gray-500' }}"
        href="{{ route('admin.tipoPagos.index') }}">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
        </svg>
        <span class="mx-3">Tipo de Pagos</span>
    </a>
    @endcan
    @can('admin.usuarios.index')
        <a class="flex items-center mt-4 py-2 px-6 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100
            {{ request()->routeIs('admin.usuarios.*') ? 'bg-gray-700 text-gray-100' : 'text-gray-500' }}"
            href="{{ route('admin.usuarios.index') }}">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
            </svg>
            <span class="mx-3">Usuarios</span>
        </a>
    @endcan
</nav> --}}
