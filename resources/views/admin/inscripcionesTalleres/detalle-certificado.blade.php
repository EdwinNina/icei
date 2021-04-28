<div class="my-4">
    @if ($inscripcion->saldo == "0")
        <input type="hidden" id="inscripcion_id" value="{{$inscripcion->id}}">
        <h2 class="text-sm uppercase my-3 text-blue-500 border-b-2 border-gray-200">Detalle de entrega de certificado</h2>
        <div class="flex justify-between items-center">
            <h3 class="text-blue-500 font-bold uppercase flex-auto">Active el check para poder solicitar el certificado del taller</h3>
            <div class="flex items-start">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="habilitarCertificado"
                        {{$inscripcion->certificado_habilitado == "1" ? 'checked' : ''}}>
                    <label
                        class="custom-control-label flex-1 uppercase"
                        for="habilitarCertificado">
                        {{ $inscripcion->certificado_habilitado == "1" ? 'Certificado solicitado' : 'Solicitar certificado'}}
                    </label>
                </div>
            </div>
        </div>
        <div class="flex justify-end flex-wrap items-center my-3 font-bold uppercase" x-data="{mostrarEntrega : false}">
            @if ($inscripcion->certificado_habilitado)
                @if ($inscripcion->certificado->impresion)
                    <div class="w-auto shadow px-2 py-1 border-l-8 border-purple-500 rounded-md text-sm text-purple-700">
                        <span>El certificado ya fue impreso en la fecha {{\Carbon\Carbon::parse($inscripcion->certificado->fecha_impresion)->translatedFormat('d F Y')}}</span>
                    </div>
                    @if (!$inscripcion->certificado->entregado)
                        <button
                            @click="mostrarEntrega = !mostrarEntrega"
                            class="btn ml-3 text-sm bg-blue-600 focus:border-blue-800 hover:bg-blue-700 hover:text-white">
                            Formulario entrega
                        </button>
                    @endif
                @else
                    <div class="w-auto shadow px-2 py-1 border-l-8 border-purple-500 rounded-md text-sm text-purple-700">
                        <span>La impresión del certificado aún esta pendiente</span>
                    </div>
                @endif
                    <div x-show="mostrarEntrega"
                    x-transition:enter="transition duration-200 transform ease-out"
                    x-transition:enter-start="scale-75"
                    x-transition:leave="transition duration-100 transform ease-in"
                    x-transition:leave-end="opacity-0 scale-90"
                    class="w-full block" id="mostrarEntrega">
                        <div class="mt-4 bg-gray-100 w-4/6 p-4 mx-auto">
                            <form action="" onsubmit="realizarEntrega(event)">
                                @csrf
                                @method('PUT')
                                @if ($inscripcion->certificado_habilitado)
                                    <input type="hidden" id="certificado_id" value="{{$inscripcion->certificado->id}}">
                                @endif
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <x-required-label for="entregado" value="Entregado a" />
                                        <textarea
                                            class="w-full h-24 text-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200
                                            focus:ring-opacity-50 rounded-md shadow-sm mt-1 py-2 px-3"
                                            name="entregado_a" form="entregado" id="entregado_a"></textarea>
                                        <x-jet-input-error for="entregado" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-jet-label for="fecha_entregado" value="Fecha de Entrega" />
                                        <x-jet-input type="date" class="w-full" name="fecha_entregado" id="fecha_entregado" value="{{date('Y-m-d')}}" readonly />
                                    </div>
                                </div>
                                <div class="flex justify-end my-2">
                                    <x-jet-danger-button type="submit">Guardar</x-jet-danger-button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if ($inscripcion->certificado->entregado)
                        <div class="w-auto ml-4 shadow px-2 py-1 border-l-8 border-green-500 rounded-md text-sm text-green-700">
                            <span>Certificado entregado</span>
                        </div>
                    @endif
            @endif
        </div>
    @else
        <div class="flex justify-center mt-2">
            <span class="text-center font-bold uppercase text-blue-500">El estudiante aún no completo el pago de su inscripción</span>
        </div>
        <div class="flex justify-end mt-3">
            <x-back-button href="{{ route('admin.inscripciones.index') }}" class="mr-2">Volver</x-back-button>
        </div>
    @endif
</div>

