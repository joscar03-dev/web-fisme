<!-- resources/views/livewire/eventos.blade.php -->
<section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-wrap w-full mb-20">
            <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">Eventos Próximos</h1>
                <div class="h-1 w-20 bg-blue-500 rounded"></div>
            </div>
            <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">Explora los próximos eventos organizados por nuestra
                comunidad. Encuentra actividades que te interesen y regístrate para participar.</p>
        </div>
        <div class="flex flex-wrap -m-4">
            @foreach ($eventos as $evento)
                <div class="xl:w-1/4 md:w-1/2 p-4">
                    <div class="bg-gray-100 p-6 rounded-lg">
                        <img class="h-40 rounded w-full object-cover object-center mb-6"
                            src="{{ url('storage', $evento->imagen_catalogo) }}" alt="{{ $evento->nombre_evento }}">

                        <h3 class="tracking-widest text-blue-500 text-xs font-medium title-font">
                            {{ $evento->tema->nombre_tema ?? 'Sin tema' }}</h3>
                        <h2 class="text-lg text-gray-900 font-medium title-font mb-4">{{ $evento->nombre_evento }}</h2>
                        <p class="leading-relaxed text-base">{{ $evento->descripcion_breve }}</p>
                        <p class="text-gray-500 mt-2 text-sm">
                            {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d M Y') }} -
                            {{ \Carbon\Carbon::parse($evento->fecha_fin)->format('d M Y') }}
                        </p>

                        <a href="{{ $evento->enlace_inscripcion }}"
                            class="text-blue-500 inline-flex items-center mt-3">Más información
                            <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $eventos->links() }} <!-- Paginación -->
    </div>
</section>
