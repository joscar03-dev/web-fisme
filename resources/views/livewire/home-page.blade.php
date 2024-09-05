<div>
    <!-- Carrusel de Eventos -->
    <div class="relative w-full h-[500px] bg-gradient-to-r from-blue-900 to-blue-700 mb-12 overflow-hidden">
        @if ($eventCount > 0)
            <div class="flex h-full">
                <!-- Sección de texto -->
                <div class="w-1/2 flex items-center justify-center p-12" style="background-color: rgba(0, 31, 84, 0.9);">
                    <div class="text-left text-white">
                        <p class="text-teal-300 mb-2 text-lg font-semibold">
                            {{ \Carbon\Carbon::parse($eventos[$currentIndex]->fecha_inicio)->format('d \\d\\e F \\d\\e\\l Y') }}
                        </p>
                        <h2 class="text-5xl font-bold mb-6 leading-tight">{{ $eventos[$currentIndex]->nombre_evento }}</h2>
                        <a href="{{ route('evento.detalle', $eventos[$currentIndex]->id) }}"
                            class="bg-teal-500 hover:bg-teal-600 text-white font-bold py-3 px-8 rounded-full transition duration-300 inline-flex items-center">
                            <span>MÁS INFORMACIÓN</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
                <!-- Sección de imagen -->
                <div class="w-1/2 bg-cover bg-center transition-all duration-500 ease-in-out"
                    style="background-image: url('{{ asset('storage/' . $eventos[$currentIndex]->imagen_banner) }}');">
                </div>
            </div>

            <!-- Botones de navegación -->
            <button wire:click="prevSlide"
                class="absolute left-4 top-1/2 transform -translate-y-1/2 text-white bg-black bg-opacity-50 rounded-full p-3 hover:bg-opacity-75 transition duration-300">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>

            <button wire:click="nextSlide"
                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white bg-black bg-opacity-50 rounded-full p-3 hover:bg-opacity-75 transition duration-300">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <!-- Indicadores -->
            <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-3">
                @foreach ($eventos as $index => $evento)
                    <button wire:click="setSlide({{ $index }})" id="dot-{{ $index }}"
                        class="w-3 h-3 rounded-full {{ $index === $currentIndex ? 'bg-white scale-125' : 'bg-gray-400' }} transition duration-300 transform hover:scale-125"></button>
                @endforeach
            </div>
        @else
            <div class="relative w-full h-[500px] bg-cover bg-center"
                style="background-image: url('{{ asset('images/fisme.webp') }}');">
                <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                <div class="relative z-10 flex flex-col items-center justify-center h-full text-white px-4">
                    <h2 class="text-5xl font-bold mb-4 text-center">Ingeniería de Sistemas</h2>
                    <p class="text-2xl mb-6 text-center">Forma parte de la revolución tecnológica</p>
                    <a href="/carrera-ingenieria-sistemas"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-full transition duration-300 inline-flex items-center">
                        <span>Conoce más</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Catálogo de Eventos -->
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold mb-8 text-center text-gray-800">Próximos eventos</h2>

        <!-- Filtros -->
        <div class="flex flex-wrap justify-center space-x-4 mb-8">
            <select wire:model="tipo" class="p-2 border rounded-full bg-white shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Tipo de evento</option>
                <option value="conferencia">Conferencia</option>
                <option value="taller">Taller</option>
                <option value="seminario">Seminario</option>
            </select>

            <select wire:model="area" class="p-2 border rounded-full bg-white shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Área</option>
                <option value="tecnología">Tecnología</option>
                <option value="ciencias">Ciencias</option>
                <option value="arte">Arte</option>
            </select>
        </div>

        <!-- Catálogo de Eventos -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($eventos as $evento)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden transform transition duration-300 hover:scale-105">
                    <div class="relative">
                        <img class="w-full h-56 object-cover" src="{{ asset('storage/' . $evento->imagen_catalogo) }}"
                            alt="{{ $evento->nombre_evento }}">
                        <div class="absolute top-0 left-0 bg-blue-900 text-white p-3 rounded-br-lg">
                            <span class="block text-3xl font-bold">{{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d') }}</span>
                            <span class="block text-sm uppercase">{{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('M') }}</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-3 text-gray-800">{{ $evento->nombre_evento }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($evento->descripcion_breve, 100) }}</p>
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <svg class="h-5 w-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ $evento->lugar }}
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="h-5 w-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d/m/Y, H:i') }} -
                            {{ \Carbon\Carbon::parse($evento->fecha_fin)->format('H:i') }}
                        </div>
                    </div>
                    <div class="px-6 pb-6">
                        <a href="{{ route('evento.detalle', $evento->id) }}" class="block w-full text-center bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-full transition duration-300">
                            Más información
                        </a>
                    </div>
                    
                </div>
            @endforeach
        </div>
    </div>
</div>


<script>
    let currentIndex = 0;
    const eventCount = {{ $eventCount }};
    const eventos = @json($eventos);

    function setSlide(index) {
        currentIndex = index;
        updateSlide();
    }

    function prevSlide() {
        currentIndex = (currentIndex === 0) ? eventCount - 1 : currentIndex - 1;
        updateSlide();
    }

    function nextSlide() {
        currentIndex = (currentIndex === eventCount - 1) ? 0 : currentIndex + 1;
        updateSlide();
    }

    function updateSlide() {
        // Ocultar todas las diapositivas
        document.querySelectorAll('.bg-cover').forEach((slide, index) => {
            slide.classList.toggle('hidden', index !== currentIndex);
        });

        // Actualizar título, fecha, hora y enlace del evento
        document.getElementById('event-title').textContent = eventos[currentIndex].nombre_evento;
        document.getElementById('event-date').textContent =
            `Fecha: ${new Date(eventos[currentIndex].fecha_inicio).toLocaleDateString()} - ${new Date(eventos[currentIndex].fecha_fin).toLocaleDateString()}`;
        document.getElementById('event-time').textContent =
            `Hora: ${eventos[currentIndex].hora_inicio} - ${eventos[currentIndex].hora_salida}`;
        document.getElementById('event-link').setAttribute('href', eventos[currentIndex].enlace_inscripcion);

        // Actualizar los puntos del carrusel
        document.querySelectorAll('.w-4.h-4').forEach((dot, index) => {
            dot.classList.toggle('bg-white', index === currentIndex);
            dot.classList.toggle('bg-gray-400', index !== currentIndex);
        });
    }
</script>
