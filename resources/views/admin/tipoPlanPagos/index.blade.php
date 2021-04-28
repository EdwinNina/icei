@extends('adminlte::page')

@section('title', 'Tipo de Pagos')

@section('content_header')
@stop

@section('content')
    <div class="py-2">
        <div class="w-full">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('tipo-plan-pago-component')
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @trixassets

@stop

@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
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
                                title: '¿Estas seguro de deshabilitar este registro? Porque ya tiene registros inscripciones realizadas',
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
                                    Livewire.emitTo('tipo-plan-pago-component','deshabilitarRegistro',id);
                                    return;
                                }
                            });
                        }else{
                            Livewire.emitTo('tipo-plan-pago-component','deshabilitarRegistro',id);
                        }
                    });
                }else{
                    Livewire.emitTo('tipo-plan-pago-component','habilitarRegistro',id);
                    return;
                }
            });
        });
   </script>

@stop
