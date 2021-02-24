<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-2xl text-center uppercase font-bold mb-5">Mi perfil</h1>
                    @if ($perfil->profesion == '')
                        <p class="text-center font-light text-gray-400">Aún no tienes informacion agregada a tu perfil</p>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2">
                            <figure>
                                <img src="{{ Storage::url('docentesAvatar/'. $perfil->foto)}}" alt="{{$perfil->docente->nombre}}"
                                class="rounded-full w-60 h-60 shadow-md ring-2 ring-gray-400 mx-auto">
                            </figure>
                            <section>
                                <p> <span class="font-bold uppercase">Nombre completo: </span> {{$perfil->docente->nombre }} {{$perfil->docente->paterno }} {{$perfil->docente->materno }}</p>
                                <p> <span class="font-bold uppercase">Profesion: </span>{{$perfil->profesion}}</p>
                                <p class="font-bold uppercase">Biografia: </p>
                                <span class="text-justify">{!! $perfil->biografia !!}</span>
                                @if ($perfil->website != '')
                                    <p><span class="font-bold uppercase">Pagina web: </span><a href="{{$perfil->website}}" target="_blank" class="text-blue-500
                                        hover:text-blue-600 hover:underline">{{$perfil->website}}</a></p>
                                @endif
                                <p class="my-3"><span class="font-bold uppercase">Curriculum: </span>
                                    <a href="{{Storage::url('docentesCurriculum/' . $perfil->curriculum)}}"
                                        target="_blank" class="mx-2 px-3 py-2 bg-indigo-500 hover:bg-indigo-600 text-white shadow-md rounded"
                                    >Ver curriculum
                                    </a>
                                </p>
                            </section>
                        </div>
                    @endif
                    <div class="text-center mt-5">
                        @if ($perfil->docente_id == 4)
                            <a href="{{ route('docente.profile.edit', $docente) }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150'">
                                Actualizar información
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
