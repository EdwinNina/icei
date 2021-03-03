@props(['image'])

<section class="bg-yellow-500 text-gray-100 body-font" {{ $attributes }}>
    <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
        <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">

            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-100">{{ $titulo1 }}
            <br class="hidden lg:inline-block">{{ $titulo2 }}
            </h1>
            <p class="mb-8 leading-relaxed text-lg">{{$subtitulo}}</p>
        </div>
        <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
            <img class="object-cover object-center rounded" alt="hero" src="{{ asset($image) }}">
        </div>
    </div>
</section>
