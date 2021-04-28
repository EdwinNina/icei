@extends('adminlte::page')

@section('title', 'Certificados Entregados')

@section('content_header')
@stop

@section('content')
    @livewire('certificados-entregados-component')
@stop

@section('css')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
@stop
@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
@stop
