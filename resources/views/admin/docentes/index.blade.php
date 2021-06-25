@extends('adminlte::page')

@section('title', 'Docentes')

@section('content_header')
@stop

@section('content')
    <div>
        <div class="w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @livewire('docente-component')
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
        window.livewire.on('messageSuccess', value => {
            switch (value) {
                case 'create':
                    toastr.success('Correcto', 'Registro agregado correctamente');
                    break;
                case 'update':
                    toastr.success('Correcto', 'Registro actualizado correctamente');
                break;
            }
        });
        window.livewire.on('customMessage', value => {
            toastr.success('Correcto', value);
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
                                title: '¿Estas seguro de deshabilitar este registro? Porque ya se le asigno planificaciones',
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
                                    Livewire.emitTo('docente-component','deshabilitarRegistro',id);
                                    return;
                                }
                            });
                        }else{
                            Livewire.emitTo('docente-component','deshabilitarRegistro',id);
                        }
                    });
                }else{
                    Livewire.emitTo('docente-component','habilitarRegistro',id);
                    return;
                }
            });
        });

    </script>
@stop

