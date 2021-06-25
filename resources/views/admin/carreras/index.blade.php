@extends('adminlte::page')

@section('title', 'Carreras')

@section('content_header')
@stop

@section('content')
    <div>
        @if (session('message'))
        <div class=" border-l-4 px-5 py-2 rounded mb-3
            {{session('message') === 'good' ? 'bg-green-500 border-green-600' : 'bg-red-500 border-red-600'}}">
            <span class="text-white text-center">
                {{ session('message') === 'good'
                    ? 'El módulo se registró con exito'
                    : 'Ocurrió un error, intentelo de nuevo'
                }}
            </span>
        </div>
        @endif
        <div class="w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @livewire('carrera-component')
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('css/lightbox.min.css') }}">
@stop
@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('js/lightbox-plus-jquery.min.js') }}"></script>

    <script>
        window.livewire.on('messageFailed', () => {
            toastr.error('Incorrecto', 'Hubo un error, intentelo de nuevo!');
        });

        window.livewire.on('customMessage', message => {
            toastr.success('Correcto', message);
        });

        const registros = document.querySelectorAll('.custom-control-input');
        registros.forEach(registro => {
            registro.addEventListener('change', (e) => {
                let id = registro.dataset.id;
                if(e.target.checked){
                    Livewire.emit('verificacion',id);
                    window.livewire.on('exist', value => {
                        if(value == 1){
                            Swal.fire({
                                title: '¿Estas seguro de deshabilitar este registro? Porque ya tiene planificaciones asignadas',
                                type: 'warning',
                                showCancelButton: true,
                                showConfirmButton: true,
                                confirmButtonText: 'Si',
                                cancelButtonColor: '#d33',
                                cancelButtonText: 'No'
                            }).then((result) => {
                                if(result.dismiss === "cancel" || result.dismiss === "backdrop") {
                                    toastr.info('Se canceló la deshabilitación de este registro');
                                    e.target.checked = false;
                                    return;
                                }else{
                                    Livewire.emitTo('carrera-component','deshabilitarRegistro',id);
                                }
                            });
                        }else{
                            Livewire.emitTo('carrera-component','deshabilitarRegistro',id);
                        }
                    });
                }else{
                    Livewire.emitTo('carrera-component','habilitarRegistro',id);
                }
            });
        });
    </script>
@stop
