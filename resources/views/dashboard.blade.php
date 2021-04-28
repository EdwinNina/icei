@extends('adminlte::page')

@section('title', 'Panel administrativo')

@section('content_header')
    <h1>Panel Administrativo</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-l-8 rounded-md border-blue-500 shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-blue-500 text-uppercase mb-1">Cantidad de Estudiantes Registrados</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$cantidadEstudiantes}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-blue-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-l-8 rounded-md border-blue-500 shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-blue-500 text-uppercase mb-1">Cantidad de Carreras</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$cantidadCarreras}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-check fa-2x text-blue-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-l-8 rounded-md border-blue-500 shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-blue-500 text-uppercase mb-1">Ingreso total de Hoy</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$cantidadIngresoHoy}} Bs</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-alt text-blue-300 fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h2 class="text-blue-500 uppercase font-bold text-2xl mb-3">Estado de Certificados por mes</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="bg-white p-4 rounded shadow">
                    <span class="font-light text-center text-gray-500">Cantidad de Certificados por Módulo</span>
                    <canvas id="estadoCertificadoModular"></canvas>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-4 rounded shadow">
                    <span class="font-light text-center text-gray-500">Cantidad de Certificados de Talleres</span>
                    <canvas id="estadoCertificadoTaller"></canvas>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-4 rounded shadow">
                    <span class="font-light text-center text-gray-500">Cantidad de Certificados por Carrera</span>
                    <canvas id="estadoCertificadoCarrera"></canvas>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
@stop
@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script>
        axios.post('/admin/estado-certificados')
        .then( response => {
            const ctxModular = document.getElementById('estadoCertificadoModular').getContext('2d');
            myChart = new Chart(ctxModular, {
                type: 'doughnut',
                data: {
                    labels: ["Solicitados","Entregados"],
                    datasets: [{
                        label: "Cantidad de Certificados Modulares",
                        data: [response.data.cantidadSolicitadosModulares,response.data.cantidadEntregadosModulares],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 4
                    }],
                },
                options: {
                    parsing: {
                        xAxisKey: 'id',
                        yAxisKey: 'nested.value'
                    }
                }
            });

            const ctxTaller = document.getElementById('estadoCertificadoTaller').getContext('2d');
            myChart = new Chart(ctxTaller, {
                type: 'doughnut',
                data: {
                    labels: ["Solicitados","Entregados"],
                    datasets: [{
                        label: "Cantidad de Certificados Modulares",
                        data: [response.data.cantidadSolicitadosTalleres, response.data.cantidadEntregadosTalleres],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 4
                    }],
                },
                options: {
                    parsing: {
                        xAxisKey: 'id',
                        yAxisKey: 'nested.value'
                    }
                }
            });

            const ctxCarrera = document.getElementById('estadoCertificadoCarrera').getContext('2d');
            myChart = new Chart(ctxCarrera, {
                type: 'doughnut',
                data: {
                    labels: ["Solicitados","Entregados"],
                    datasets: [{
                        label: "Cantidad de Certificados Modulares",
                        data: [response.data.cantidadSolicitadosCarreras, response.data.cantidadEntregadosCarreras],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)'
                        ],
                        hoverOffset: 4
                    }],
                },
                options: {
                    parsing: {
                        xAxisKey: 'id',
                        yAxisKey: 'nested.value'
                    }
                }
            });
        });

        function diasSemana(fecha) {
            switch (fecha) {
                case 0: return "Domingo"; break;
                case 1: return "Lunes"; break;
                case 2: return "Martes"; break;
                case 3: return "Miercoles"; break;
                case 4: return "Jueves"; break;
                case 5: return "Viernes"; break;
                case 6: return "Sabado"; break;
            }
        }
    </script>
@stop
