<div>
    @include('admin.inscripciones.editar-estudiante')
    <div class="grid grid-cols-1 md:grid-cols-6 lg:grid-cols-6 gap-3 mt-4">
        <div class="col-span-6 md:col-span-2 flex items-start flex-wrap md:flex-nowrap">
            <x-jet-label for="buscarPorCarnet" value="Buscar Estudiante por Carnet" class="w-full" />
            <x-jet-input type="text" wire:model.debounce.800ms="buscarPorCarnet" class="w-96 md:w-56" placeholer="Buscar...." required/>
            <a href="" wire:click.prevent="buscarEstudiante()"
                class="p-2 mt-1 bg-green-600 text-white flex justify-center items-center rounded-md shadow-md hover:bg-green-700 ml-1">
                @include('components.search-icon')
            </a>
            <x-jet-input-error for="buscarPorCarnet" class="mt-2" />
        </div>
        <section class="col-span-6 md:col-span-4 bg-gray-50 rounded-md p-2">
            <p class="text-blue-500 font-semibold uppercase border-b-2 border-gray-200 mb-1 text-center">Coincidencias Encontradas</p>
            <div class="overscroll-auto overflow-y-scroll max-h-44">
                @if ($estudianteEncontrado)
                    <table class="table-tail">
                        <thead class="bg-gray-500">
                            <tr class="text-center">
                                <th></th>
                                <th class="px-1 py-2 text-white">Carnet</th>
                                <th class="px-1 py-2 text-white">Paterno</th>
                                <th class="px-1 py-2 text-white">Materno</th>
                                <th class="px-1 py-2 text-white">Nombre</th>
                                <th class="px-1 py-2 text-white">Celular</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody >
                            @if (count($estudianteEncontrado) > 0)
                                @foreach ($estudianteEncontrado as $index => $item)
                                    <tr>
                                        <td><x-jet-input type="radio" name="estudiante_id" wire:model="estudiante_id" value="{{$item->id}}" /></td>
                                        <td class="px-1 py-2 text-center text-sm">{{$item->carnet}}</td>
                                        <td class="px-1 py-2 text-center text-sm">{{ Str::ucfirst($item->paterno)}}</td>
                                        <td class="px-1 py-2 text-center text-sm">{{ Str::ucfirst($item->materno)}}</td>
                                        <td class="px-1 py-2 text-center text-sm">{{ Str::title($item->nombre)}}</td>
                                        <td class="px-1 py-2 text-center text-sm">{{$item->celular}}</td>
                                        <td>
                                            <a href="" wire:click.prevent="edit({{$item->id}})"
                                                class="flex justify-center items-center mx-auto bg-yellow-500 rounded-full w-7 h-7 hover:bg-yellow-600 transition-all">
                                                @include('components.edit-icon')
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="6">
                                    <p class="text-red-500 text-center">La cédula de identidad no coincide con nuestros registros</p>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                @else
                    <p class="text-red-500 text-center">Digita la cédula de identidad para encontrar al estudiante</p>
                @endif
            </div>
        </section>
    </div>
    @if ($estudiante_id)
        <h2 class="text-sm uppercase text-blue-500 border-b-2 mt-4 border-gray-200 mb-3">Referencias Familiares</h2>
        <div class="mt-1 flex justify-between">
            <p>
                <span class="font-bold">Nombre: </span>
                <span>{{Str::ucfirst($paterno)}} {{Str::ucfirst($materno)}} {{Str::ucfirst($nombre)}}</span>
            </p>
            <p><span class="font-bold">Celular: </span><span>{{$celular}}</span></p>
            <input type="hidden" value="{{$nombreCompletoEstudiante->nombre_completo}}" class="nombre_estudiante">
            <input type="hidden" value="{{$nombreCompletoEstudiante->carnet}} {{$nombreCompletoEstudiante->expedido}}" class="carnet_estudiante">
        </div>
    @endif
</div>

@push('script')
    <script>
        window.livewire.on('messageSuccess', () => {
            toastr.success('Correcto', 'Celular actualizado correctamente');
        });
    </script>
@endpush
