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
                <a href="{{ $evento->enlace_inscripcion }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Inscribirme</a>
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
                    <li class="mb-4 flex">
                        <img class="w-16 h-16 rounded-full mr-4" src="{{ asset('storage/' . $tema->ponente->imagen) }}"
                            alt="{{ $tema->ponente->nombre }}">
                        <div>
                            <h3 class="text-xl font-semibold">{{ $tema->ponente->nombre }}
                                {{ $tema->ponente->apellidos }}</h3>
                            <p class="text-gray-500 text-sm">{{ $tema->ponente->especialidad }}</p>
                            <p class="text-gray-500 text-sm">{{ $tema->ponente->institucion }}</p>
                        </div>
                    </li>
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
