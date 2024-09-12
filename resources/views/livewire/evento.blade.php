<div class="container mx-auto px-4 py-8">
    <!-- Título del evento y detalles principales -->
    <div class="bg-blue-900 text-white p-6 rounded-lg shadow-lg flex flex-col md:flex-row">
        <div class="md:w-2/3">
            <h1 class="text-4xl font-bold mb-4">{{ $evento->nombre_evento }}</h1>
            <p class="text-lg mb-4">{{ $evento->descripcion_breve }}</p>

            <ul class="mb-6">
                <li class="mb-2">
                    <strong>Fecha:</strong>
                    {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d \\d\\e F \\d\\e\\l Y') }}
                </li>
                <li class="mb-2"><strong>Hora:</strong> {{ $evento->hora_inicio }} - {{ $evento->hora_salida }}</li>
                <li class="mb-2"><strong>Lugar:</strong> {{ $evento->lugar }}</li>
                <li class="mb-2"><strong>Inversión:</strong>
                    {{ $evento->precio_inscripcion ?: 'Ingreso libre previa inscripción' }}</li>
                <li class="mb-2"><strong>Dirigido a:</strong> {{ $evento->organizador }}</li>
            </ul>

            <div class="flex space-x-4">
                <a href="{{ route('event.registration', ['eventoId' => $evento->id]) }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Inscribirme
                </a>
                <button class="bg-gray-700 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">Agregar a Google
                    Calendar</button>
            </div>
        </div>
        <div class="md:w-1/3 mt-6 md:mt-0">
            <img class="rounded-lg shadow-lg" src="{{ asset('storage/' . $evento->imagen_banner) }}"
                alt="{{ $evento->nombre_evento }}">
        </div>
    </div>

    <!-- Descripción extendida -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold mb-4">Descripción</h2>
        <p class="text-gray-700">{{ $evento->descripcion_larga }}</p>
    </div>

    <!-- Temas y ponentes -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <h2 class="text-2xl font-bold mb-4">Temas</h2>
            <ul>
                @foreach ($temas as $tema)
                    <li class="mb-4">
                        <h3 class="text-xl font-semibold">{{ $tema->nombre_tema }}</h3>
                        <p>{{ $tema->descripcion_tema }}</p>
                        <p class="text-gray-500 text-sm">Hora: {{ $tema->hora_inicio }} - {{ $tema->hora_fin }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
        <div>
            <h2 class="text-2xl font-bold mb-4">Ponentes</h2>
            <ul>
                @foreach ($temas as $tema)
                    @foreach ($tema->ponentes as $ponente)
                        <div
                            class="bg-white rounded-xl shadow-lg overflow-hidden transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-2xl">
                            <div class="relative">
                                <img src="{{ url('storage', $ponente->imagen) }}"
                                    alt="Imagen de {{ $ponente->nombre }} {{ $ponente->apellidos }}"
                                    class="w-full h-48 object-cover">
                                <img src="{{ url('storage', $ponente->logo_pais) }}"
                                    alt="Bandera de {{ $ponente->pais }}"
                                    class="absolute bottom-2 right-2 w-10 h-10 rounded-full border-2 border-white shadow-sm"
                                    title="{{ $ponente->pais }}">
                            </div>
                            <div class="p-6">
                                <h4 class="text-xl font-semibold text-gray-800 mb-2">{{ $ponente->nombre }}
                                    {{ $ponente->apellidos }}</h4>
                                <p class="text-sm font-medium text-indigo-600 mb-2">{{ $ponente->institucion }}</p>
                                <p class="text-gray-600 text-sm leading-relaxed line-clamp-3 mb-4">
                                    {{ $ponente->biografia_breve }}</p>
                                <button
                                    class="text-indigo-600 hover:text-indigo-800 text-sm font-medium focus:outline-none focus:underline"
                                    onclick="toggleBio(this, '{{ $ponente->id }}')">
                                    Leer más
                                </button>
                                <p id="bio-{{ $ponente->id }}"
                                    class="hidden text-gray-600 text-sm leading-relaxed mt-2">
                                    {{ $ponente->biografia_completa }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Eventos relacionados -->
    <div class="mt-12">
        <h2 class="text-2xl font-bold mb-4">Eventos Relacionados</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($eventosRelacionados as $relacionado)
                <div class="bg-white shadow rounded overflow-hidden">
                    <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $relacionado->imagen_catalogo) }}"
                        alt="{{ $relacionado->nombre_evento }}">
                    <div class="p-4">
                        <h3 class="text-xl font-bold mb-2">{{ $relacionado->nombre_evento }}</h3>
                        <p class="text-gray-700">{{ $relacionado->descripcion_breve }}</p>
                        <a href="{{ route('evento.detalle', $relacionado->id) }}"
                            class="text-blue-500 hover:text-blue-600">Ver más</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
