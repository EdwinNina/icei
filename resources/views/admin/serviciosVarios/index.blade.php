@extends('adminlte::page')

@section('title', 'Servicios Varios')

@section('content_header')
@stop

@section('content')
    <div class="w-full">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @livewire('servicios-varios-component')
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
@stop
@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        window.livewire.on('changeStatus', value => {
            switch (value) {
                case 'habilitado':
                    toastr.success('Correcto', 'Registro habilitado correctamente');
                    break;
                case 'deshabilitado':
                    toastr.success('Correcto', 'Registro deshabilitado correctamente');
                break;
            }
        });
        window.livewire.on('customMessage', message => {
           toastr.success('Correcto', message);
        });

       function deshabilitarRegistro(e,id){
           if(e.target.checked){
               Swal.fire({
               title: '¿Estas seguro de deshabilitar este registro? Porque ya podría tener un servicio activo',
               type: 'warning',
               showCancelButton: true,
                                showConfirmButton: false,
                                cancelButtonColor: '#d33',
                                cancelButtonText: 'No'
               }).then((result) => {
                   if(result.dismiss === "cancel") {
                       toastr.info('Se canceló la deshabilitación de este registro');
                       e.target.checked = false;
                       return;
                   }else{
                       Livewire.emitTo('servicios-varios-component','deshabilitarRegistro',id);
                   }
               })
           }else{
               Livewire.emitTo('servicios-varios-component','habilitarRegistro',id);
           }
       }
    </script>
@stop
