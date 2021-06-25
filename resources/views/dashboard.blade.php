@extends('adminlte::page')

@section('title', 'Panel administrativo')

@section('content_header')
    <h1 class="font-bold uppercase text-gray-500">Panel Administrativo</h1>
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
                                <i class="fas fa-sticky-note fa-2x text-blue-300"></i>
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
        <div class="w-full">
            <div class="bg-white shadow-md rounded-md pt-4">
                <h3 class="text-center font-bold uppercase text-gray-600">Cantidad de dinero ingresado en el Mes actual</h3>
                <div class="flex p-6 flex-col justify-between md:flex-row md:justify-between md:items-end md:m-5">
                    <div class="flex-1 md:mr-6">
                        <x-jet-label for="fecha_inicio" value="Fecha de Inicio" />
                        <x-jet-input type="date" id="fecha_inicio" class="w-full" />
                    </div>
                    <div class="flex-1">
                        <x-jet-label for="fecha_fin" value="Fecha Fin" />
                        <x-jet-input type="date" id="fecha_fin" class="w-full"/>
                    </div>
                    <div class="flex justify-end mt-4 md:mt-0">
                        <a href="" id="btnBuscar"
                            class="p-2 bg-green-600 text-white flex justify-center items-center rounded-md shadow-md
                                hover:bg-green-700 ml-2 md:mb-1">
                            @include('components.search-icon')
                        </a>
                        <a href="" id="btnLimpiar"
                            class="p-2 bg-purple-600 text-white flex justify-center items-center rounded-md shadow-md
                                hover:bg-purple-700 ml-2 md:mb-1">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div id="ingresosMes"></div>
            </div>
            <div class="bg-white shadow-md my-4 rounded-md pt-4">
                <h3 class="text-center font-bold uppercase text-gray-600">Cantidad de dinero ingresado por día</h3>
                <div id="ingresosDia"></div>
            </div>
        </div>
        <h2 class="text-blue-500 uppercase font-bold text-2xl my-3">Estado de Certificados por mes</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="bg-white p-4 rounded shadow">
                    <span class="font-light text-center text-gray-500">Cantidad de Certificados por Módulo</span>
                    <div id="estadoCertificadoModular"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-4 rounded shadow">
                    <span class="font-light text-center text-gray-500">Cantidad de Certificados de Talleres</span>
                    <div id="estadoCertificadoTaller"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-4 rounded shadow">
                    <span class="font-light text-center text-gray-500">Cantidad de Certificados por Carrera</span>
                    <div id="estadoCertificadoCarrera"></div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
@stop
@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        const fecha_inicio = document.querySelector('#fecha_inicio'),
              fecha_fin = document.querySelector('#fecha_fin'),
              btnBuscar = document.querySelector('#btnBuscar'),
              btnLimpiar = document.querySelector('#btnLimpiar');

        if (fecha_inicio.value == '' && fecha_fin.value == '') {
            axios.post('/admin/ingresos-mes')
                .then(response => {
                    let mes = response.data.map(item => nombreDia(item.mes.substring(3,item.mes.length)) + ' - ' + item.mes.substring(0,2));
                    let total = response.data.map(item => item.total);
                    var options = {
                        chart: {
                            "height": 300,
                            "type": 'line',
                        },
                        series: [{
                            name: 'Ingreso del Mes en Bs',
                            data: total
                        }],
                        xaxis: {
                            categories: mes
                        },
                        dataLabels: {
                            enabled: false
                        },
                        markers: {
                            size: 6
                        },
                        fill: {
                            type: 'gradient',
                        }
                    }

                    var chart = new ApexCharts(document.querySelector("#ingresosMes"), options);
                    chart.render();
                })
        }

        btnBuscar.addEventListener('click', e => {
            e.preventDefault();
            if (fecha_inicio.value != '' && fecha_fin.value != '') {
                axios.post('/admin/ingresos-mes', {
                    fecha_inicio : fecha_inicio.value,
                    fecha_fin : fecha_fin.value
                })
                .then(response => {
                    let mes = response.data.map(item => item.mes);
                    let total = response.data.map(item => item.total);
                    var options = {
                        chart: {
                            "height": 300,
                            "type": 'line',
                        },
                        series: [{
                            name: 'Ingreso del Mes en Bs',
                            data: total
                        }],
                        xaxis: {
                            categories: mes
                        },
                        dataLabels: {
                            enabled: false
                        },
                        markers: {
                            size: 6
                        },
                        fill: {
                            type: 'gradient',
                        }
                    }

                    var chart = new ApexCharts(document.querySelector("#ingresosMes"), options);
                    chart.render();

                    chart.updateSeries([{
                        data: total
                    }])
                })
            }
        });

        btnLimpiar.addEventListener('click', e => {
            e.preventDefault();
            fecha_inicio.value = '';
            fecha_fin.value = '';
            axios.post('/admin/ingresos-mes')
            .then(response => {
                let mes = response.data.map(item => nombreDia(item.mes.substring(3,item.mes.length)) + ' - ' + item.mes.substring(0,2));
                let total = response.data.map(item => item.total);
                var options = {
                    chart: {
                        "height": 300,
                        "type": 'line',
                    },
                    series: [{
                        name: 'Ingreso del Mes en Bs',
                        data: total
                    }],
                    xaxis: {
                        categories: mes
                    },
                    dataLabels: {
                        enabled: false
                    },
                    markers: {
                        size: 6
                    },
                    fill: {
                        type: 'gradient',
                    }
                }

                var chart = new ApexCharts(document.querySelector("#ingresosMes"), options);
                chart.render();

                chart.updateSeries([{
                    data: total
                }])
            })
        });


        axios.post('/admin/ingresos-anio')
        .then(response => {
            let mes = response.data.map(item => nombreMes(item.mes));
            let total = response.data.map(item => item.total);
            var options = {
                chart: {
                    height: 300,
                    type: 'bar',
                },
                series: [{
                    name: 'Total Ingreso Bs',
                    data: total
                }],
                xaxis: {
                    categories: mes
                },
                dataLabels: {
                    enabled: false
                },
                plotOptions: {
                    bar: {
                        distributed: true
                    }
                },
            }

            const chartDia = new ApexCharts(document.querySelector("#ingresosDia"), options);

            chartDia.render();
        })

        function nombreMes(mes){
            switch (mes) {
                case 'January':  return 'Enero'; break;
                case 'February': return 'Febrero'; break;
                case 'March': return 'Marzo'; break;
                case 'April': return 'Abril'; break;
                case 'May': return 'Mayo'; break;
                case 'June': return 'Junio'; break;
                case 'July': return 'Julio'; break;
                case 'August': return 'Agosto'; break;
                case 'September': return 'Septiembre'; break;
                case 'October': return 'Octubre'; break;
                case 'November': return 'Noviembre'; break;
                case 'December': return 'Diciembre'; break;
            }
        }

        function nombreDia(dia){
            switch (dia) {
                case 'Monday':  return 'Lunes'; break;
                case 'Tuesday': return 'Martes'; break;
                case 'Wednesday': return 'Miercoles'; break;
                case 'Thursday': return 'Jueves'; break;
                case 'Friday': return 'Viernes'; break;
                case 'Saturday': return 'Sabado'; break;
                case 'Sunday': return 'Domingo'; break;
            }
        }

        axios.post('/admin/estado-certificados')
            .then( response => {
                var opcionModulos = {
                    chart: {
                        type: 'donut',
                    },
                    series: [response.data.cantidadSolicitadosModulares,response.data.cantidadEntregadosModulares],
                    labels: ["Solicitados","Entregados"],
                    dataLabels: {
                        enabled: false
                    },
                }
                var opcionTalleres = {
                    chart: {
                        type: 'donut',
                    },
                    series: [response.data.cantidadSolicitadosTalleres, response.data.cantidadEntregadosTalleres],
                    labels: ["Solicitados","Entregados"],
                    dataLabels: {
                        enabled: false
                    },
                }

                var opcionCarrera = {
                    chart: {
                        type: 'donut',
                    },
                    series: [response.data.cantidadSolicitadosCarreras, response.data.cantidadEntregadosCarreras],
                    labels: ["Solicitados","Entregados"],
                    dataLabels: {
                        enabled: false
                    },
                }

                var chartModulo = new ApexCharts(document.querySelector("#estadoCertificadoModular"), opcionModulos);

                var chartTaller = new ApexCharts(document.querySelector("#estadoCertificadoTaller"), opcionTalleres);

                var chartCarrera = new ApexCharts(document.querySelector("#estadoCertificadoCarrera"), opcionCarrera);

                chartModulo.render();
                chartTaller.render();
                chartCarrera.render();
            });
    </script>
@stop
