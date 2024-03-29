@extends('adminlte::page')

@section('title', 'Estudiantes')

@section('content_header')
@stop

@section('content')
    <div class="w-full">
        @if (session('failures'))
        <div class="bg-red-500 border-l-8 px-5 py-2 rounded mb-3 border-red-600">
            <ul class="list-none">
                <p class="text-white text-center">HUBO UN ERROR EN LA IMPORTACIÓN!!</p>
                @foreach (session('failures') as $failure)
                    <div class="flex items-center justify-center">
                        <p class="text-white text-center">Existe error en la fila nro {{ $failure->row() }} en la columna {{ $failure->attribute() }} del archivo excel</p>
                    </div>
                    @foreach ($failure->errors() as $error)
                        <li class="text-white text-center">{{ $error }}</li>
                    @endforeach
                @endforeach
            </ul>
        </div>
        @endif
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @livewire('estudiante-component')
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
@stop
@section('js')
    <script src="{{ mix('js/app.js') }}" defer></script>

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
                                title: '¿Estas seguro de deshabilitar este registro? Porque ya tiene inscripciones realizadas',
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
                                    Livewire.emitTo('estudiante-component','deshabilitarRegistro',id);
                                    return;
                                }
                            });
                        }else{
                            Livewire.emitTo('estudiante-component','deshabilitarRegistro',id);
                        }
                    });
                }else{
                    Livewire.emitTo('estudiante-component','habilitarRegistro',id);
                    return;
                }
            });
        });

    </script>
@stop

