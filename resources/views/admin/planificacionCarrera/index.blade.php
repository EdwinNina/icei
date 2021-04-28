@extends('adminlte::page')

@section('title', 'Planificacion de Carrera')

@section('content')
    <div>
        <div class="w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @livewire('planificacion-carrera-component')
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
@stop
@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        window.livewire.on('customMessage', message => {
            toastr.success('Correcto', message);
        });

        window.livewire.on('messageFailed', () => {
            toastr.error('Incorrecto', 'Hubo un error, intentelo de nuevo!');
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
                                title: '¿Estas seguro de deshabilitar este registro? Porque ya tiene planificaciones realizadas',
                                type: 'warning',
                                showCancelButton: true,
                                showConfirmButton: false,
                                cancelButtonColor: '#d33',
                                cancelButtonText: 'No'
                            }).then((result) => {
                                if(result.dismiss === "cancel" || result.dismiss === "backdrop") {
                                    toastr.info('Se canceló la deshabilitación de este registro');
                                    e.target.checked = false;
                                    return;
                                }else{
                                    Livewire.emitTo('planificacion-carrera-component','deshabilitarRegistro',id);
                                    return;
                                }
                            });
                        }else{
                            Livewire.emitTo('planificacion-carrera-component','deshabilitarRegistro',id);
                        }
                    });
                }else{
                    Livewire.emitTo('planificacion-carrera-component','habilitarRegistro',id);
                    return;
                }
            });
        });
    </script>
@stop
