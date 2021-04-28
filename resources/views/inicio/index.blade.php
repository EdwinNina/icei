@extends('layouts.layout')

@section('hero')
<div class="relative h-screen w-full flex items-center justify-start text-left bg-cover bg-center" style="background-image:url(https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80);">
    <div class="absolute top-0 right-0 bottom-0 left-0 bg-gray-900 opacity-75"></div>
    <section class="px-10 lg:px-24 z-10">
        <div class="text-left">
        <h2 class="text-4xl tracking-tight leading-10 font-extrabold sm:text-5xl text-white sm:leading-none md:text-6xl">
            Capacitación
            <span class="text-indigo-400">Personalizada</span>
        </h2>
        <p class="mt-3 text-white sm:mt-5 sm:max-w-xl md:mt-5 text-lg font-light">
            Nuestro instituto es un centro de alta especialización con docentes certificados en Tecnologías de la Información, Sistemas, Telecomunicaciones y Electrónica.
        </p>
        <div class="mt-5 sm:mt-8 sm:flex justify-start">
            <div class="rounded-md shadow">
            <a href="{{ route('login')}}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo transition duration-150 ease-in-out md:py-4 md:text-lg md:px-10">
                Comienza
            </a>
        </div>
        </div>
    </div>
    </section>
</div>
@endsection

@section('content')
<section class="body-font bg-white">
    <div class="py-16 mx-auto">
        <div class="flex flex-wrap w-full mb-5 flex-col items-center text-center">
            <h2 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">Nuestra Especialización</h2>
            <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">Estas son algunas de las áreas en las cuales nosotros te ayudaremos
            a especializarte con todos nuestros cursos</p>
        </div>
        <div class="py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 mx-10 gap-4">
                <div class="text-center hover:shadow-xl p-4 rounded transition-all">
                    <img src="{{asset('images/redes.jpg')}}" class="h-44 mx-auto" alt="Administración de redes y networking">
                    <h3 class="uppercase font-bold">Administración de redes y networking</h3>
                    <p>Adentrate en el mundo de las telecomunicaciones y redes, con nuestro curso
                        aprenderas desde lo más basico hasta lo mas esencial utilizado en la vida real,
                        tomando en cuenta muy buenas prácticas.
                    </p>
                </div>
                <div class="text-center hover:shadow-xl p-4 rounded transition-all">
                    <img src="{{asset('images/soporte-tecnico.jpg')}}" class="h-44 mx-auto" alt="Soporte Técnico">
                    <h3 class="uppercase font-bold">Soporte Técnico</h3>
                    <p>Especializate en el área del soporte técnico con nuestros curso y/o talleres, en los
                        cuales aprenderas con mucha práctica la parte tanto de software como hadware de
                        computador y como saber responder ante cualquier situación.
                    </p>
                </div>
                <div class="text-center hover:shadow-xl p-4 rounded transition-all">
                    <img src="{{asset('images/desarrollo-web.jpg')}}" class="h-44 mx-auto" alt="Desarrollo Web Fullstack">
                    <h3 class="uppercase font-bold">Desarrollo Web Fullstack</h3>
                    <p>Conoce el mundo del desarrollo web y el desarrollo fullstack desde lo mas básico
                        hasta lo más experto, no solo aprenderas tecnologias sino que aprenderas a como
                        unirlas dependiendo de tus necesidades y se un experto tanto en el backend como frontend
                    </p>
                </div>
                <div class="text-center hover:shadow-xl p-4 rounded transition-all">
                    <img src="{{asset('images/aplicaciones-moviles.jpg')}}" class="h-44 mx-auto" alt="Programación y Desarrollo de Aplicaciones móviles">
                    <h3 class="uppercase font-bold">Programación y Desarrollo de Aplicaciones móviles</h3>
                    <p>Centrate en la creación de aplicaciones móviles como aplicaciones de escritorio
                        con el lenguaje de programación más robusto y usado en esta área como lo es
                        el lenguaje Java.
                    </p>
                </div>
            </div>
        </div>
    </div>
  </section>
  <section class="text-gray-400 bg-gray-900 body-font">
    <div class="container px-5 py-10 mx-auto">
      <div class="xl:w-1/2 lg:w-3/4 w-full mx-auto text-center">
        <p class="leading-relaxed text-lg">Los líderes se hacen, no nacen. Están hechos por duro esfuerzo, que es el precio que todos nosotros debemos pagar para alcanzar cualquier meta que valga la pena</p>
        <span class="inline-block h-1 w-10 rounded bg-yellow-500 mt-8 mb-6"></span>
        <h2 class="text-white font-medium title-font tracking-wider text-sm">Vince Lombardi</h2>
      </div>
    </div>
  </section>
  <section class="text-gray-400 body-font">
    <div class="container px-5 py-24 mx-auto">
      <div class="text-center mb-20">
        <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-800 mb-4">Nuestros valores</h1>
        <p class="text-base leading-relaxed xl:w-2/4 lg:w-3/4 mx-auto text-gray-600 text-opacity-80"
        >Nuestros valores e ideales hacia la eduación, fue que nos hicieron llegar hasta esta aqui y ser reconocidos como una de las mejores instituciones en la ciudad de La Paz</p>
        <div class="flex mt-6 justify-center">
          <div class="w-16 h-1 rounded-full bg-yellow-500 inline-flex"></div>
        </div>
      </div>
      <div class="flex flex-wrap sm:-m-4 -mx-4 md:mx-10 -mb-10 -mt-4 md:space-y-0 space-y-6">
        <div class="p-4 md:w-1/2 flex flex-col text-center items-center">
          <div class="flex-grow">
            <h2 class="text-gray-700 text-lg title-font font-medium mb-3">Misión</h2>
            <p class="leading-relaxed text-gray-500 text-base">
                Somos una empresa de base tecnológica y de formación tecnológica que ayuda a generar valor a sus clientes,
                a través de una formación de alto nivel apalancando el cumplimiento de sus objetivos estratégicos mediante
                 el uso de metodologías estructuradas y adaptables.</p>
          </div>
        </div>
        <div class="p-4 md:w-1/2 flex flex-col text-center items-center">
          <div class="flex-grow">
            <h2 class="text-gray-700 text-lg title-font font-medium mb-3">Visión</h2>
            <p class="leading-relaxed text-base text-gray-500">
                Ser reconocidos como una empresa con servicios de calidad, excelencia e integridad. Ser percibidos como un aliado estratégico
                en formación tecnológica y servicios tecnológicos a treves de la generación de valor y con un alto nivel de satisfacción de
                sus clientes, empleados y socios.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
