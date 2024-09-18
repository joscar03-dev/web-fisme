<div class="bg-gradient-to-b from-gray-100 to-white">
    <div class="relative bg-gradient-to-r from-[#001f54] to-[#4b6587] text-white p-10 rounded-b-3xl shadow-2xl overflow-hidden">
        <!-- SVG Background -->
        <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="grid" width="20" height="20" patternUnits="userSpaceOnUse">
                    <path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5" />
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid)" />
            <g class="animate-pulse">
                @for ($i = 0; $i < 50; $i++)
                    <circle cx="{{ rand(0, 100) }}%" cy="{{ rand(0, 100) }}%" r="1" fill="#ffffff"
                        opacity="{{ rand(10, 30) / 100 }}">
                        <animate attributeName="r" values="0;3;0" dur="{{ rand(3, 7) }}s" repeatCount="indefinite" />
                    </circle>
                @endfor
            </g>
        </svg>
        
        <!-- Imágenes de fondo -->
        <img src="/images/CIRCUITO.png" alt="" class="absolute inset-0 w-full h-full object-cover opacity-30">
        <img src="/images/IA.png" alt="" class="absolute top-0 left-0 h-full object-contain opacity-50" style="left: 40%;">
    
        <div class="flex flex-col items-center justify-center relative z-10 text-center">
            <!-- Hero Content -->
            <div class="w-full max-w-4xl space-y-8 animate-fade-in-up">
                <!-- Nombre del Evento -->
                <div class=" p-4">
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight mb-4 text-transparent bg-clip-text bg-gradient-to-r from-gray-400 via-[#00dffd] to-gray-500 font-sans shadow-lg glow-effect">
                        {{ $evento->nombre_evento }}
                    </h1>
                    <h4 class="text-2xl text-white mt-2">Facultad de Ingeniería de Sistemas y Mecánica Eléctrica</h4>
                </div>
    
                <!-- Cronómetro integrado al hero -->
                <div class="flex flex-wrap justify-center items-center space-x-4 text-white text-2xl font-bold mb-8">
                    @foreach (['Days', 'Hours', 'Minutes', 'Seconds'] as $unit)
                        <div class="timer text-center bg-opacity-20 bg-white backdrop-filter backdrop-blur-lg rounded-lg p-4 shadow-lg">
                            <span class="countdown-element font-mono text-4xl md:text-5xl block" data-unit="{{ strtolower($unit) }}">00</span>
                            <p class="text-xs uppercase tracking-wide mt-2">{{ $unit }}</p>
                        </div>
                        @if (!$loop->last)
                            <span class="text-4xl font-thin hidden md:block">:</span>
                        @endif
                    @endforeach
                </div>
    
                <!-- Modalidad del Evento -->
                <div class="bg-opacity-20 bg-white backdrop-filter backdrop-blur-lg rounded-lg p-4 shadow-lg inline-block">
                    <p class="text-lg font-semibold">
                        Modalidad del Evento:
                        <span class="text-yellow-300">Presencial</span> y
                        <span class="text-green-300">Virtual</span>
                    </p>
                </div>
    
                <!-- Botones de acción -->
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4 mt-8">
                    <a href="{{ route('event.registration', ['slug' => $evento->slug]) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-full shadow-lg transition duration-300 transform hover:scale-105 flex items-center justify-center text-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Inscribirme
                    </a>
                    <button class="bg-gray-700 hover:bg-gray-800 text-white font-bold py-3 px-6 rounded-full shadow-lg transition duration-300 transform hover:scale-105 flex items-center justify-center text-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Agregar a Google Calendar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <section class="py-16 px-4 mx-auto max-w-screen-xl overflow-hidden">
        <div class="grid md:grid-cols-2 gap-8 items-center" x-data="scrollAnimation()" x-ref="container">
            <!-- Texto y detalles del evento -->
            <div class="space-y-8 transform transition-transform duration-1000"
                :class="{ 'translate-x-0 opacity-100': inView, '-translate-x-full opacity-0': !inView }"
                x-ref="description">
                <h2 class="text-2xl md:text-3xl font-bold text-[#1d4570] leading-tight text-justify">
                    {{ $evento->descripcion_breve }}
                </h2>
                <div class="overflow-hidden bg-[#133E6B] rounded-lg p-4 shadow-lg">
                    <div class="relative h-20" x-data="carousel()">
                        <!-- Fechas -->
                        <div class="absolute inset-0 transition-all duration-500 ease-in-out" x-show="activeIndex === 0"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform translate-y-full"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform -translate-y-full">
                            <h2 class="text-xl font-semibold text-white mb-1 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Fechas:
                            </h2>
                            <p class="text-base text-white ml-7">
                                {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d/m/Y') }} -
                                {{ \Carbon\Carbon::parse($evento->fecha_fin)->format('d/m/Y') }}
                            </p>
                        </div>
                        <!-- Hora -->
                        <div class="absolute inset-0 transition-all duration-500 ease-in-out" x-show="activeIndex === 1"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform translate-y-full"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform -translate-y-full">
                            <h2 class="text-xl font-semibold text-white mb-1 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Hora:
                            </h2>
                            <p class="text-base text-white ml-7">
                                {{ \Carbon\Carbon::parse($evento->hora_inicio)->format('H:i') }} -
                                {{ \Carbon\Carbon::parse($evento->hora_salida)->format('H:i') }}
                            </p>
                        </div>
                        <!-- Lugar -->
                        <div class="absolute inset-0 transition-all duration-500 ease-in-out"
                            x-show="activeIndex === 2" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform translate-y-full"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform -translate-y-full">
                            <h2 class="text-xl font-semibold text-white mb-1 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Lugar:
                            </h2>
                            <p class="text-base text-white ml-7">
                                {{ $evento->lugar }}
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Botón de reserva -->
                <a href="#"
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    Reserva tu lugar
                </a>
            </div>

            <!-- Imagen del evento -->
            <div class="transform transition-transform duration-1000"
                :class="{ 'translate-x-0 opacity-100': inView, 'translate-x-full opacity-0': !inView }" x-ref="image">
                <img class="w-full h-auto object-cover rounded-lg shadow-md transform hover:scale-105 transition duration-300"
                    src="{{ asset('storage/' . $evento->imagen_banner) }}" alt="Imagen del evento">
            </div>
        </div>

        <!-- Sección de temas destacados -->
        <div class="mt-16" x-data="topicsAnimation()" x-ref="topicsContainer">
            <h2 class="text-3xl font-bold text-[#1d4570] mb-8">Temas Destacados</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <template x-for="(topic, index) in topics" :key="index">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition-all duration-500"
                        :class="{ 'translate-y-0 opacity-100': topicsInView, 'translate-y-full opacity-0': !topicsInView }"
                        :style="transition - delay: $ { index * 100 } ms">
                        <div class="h-2 bg-gradient-to-r from-blue-500 to-[#00dffd]"></div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-[#1d4570] mb-2" x-text="topic.title"></h3>
                            <p class="text-sm text-gray-600" x-text="topic.description"></p>
                        </div>
                    </div>
                </template>
            </div>
        </div>

    </section>


    <!-- Línea de tiempo -->
    <div class="max-w-4xl mx-auto p-6 md:p-8">
        <div class="relative flex justify-between items-center mb-10">
            <div class="absolute inset-x-0 top-1/2 h-1 bg-gradient-to-r from-blue-500 to-purple-600 hidden md:block">
            </div>

            <div id="dateContainer" class="w-full flex justify-between items-center">
                @foreach ($fechas as $fecha)
                    <div wire:click="seleccionarFecha('{{ $fecha->format('Y-m-d') }}')"
                        class="relative z-10 text-center cursor-pointer transition-transform duration-300 ease-in-out transform hover:scale-110">
                        <div
                            class="p-4 rounded-full text-xl font-bold transition-colors duration-300 
                        {{ $fechaSeleccionada == $fecha->format('Y-m-d') ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white' : 'bg-white text-gray-700 border-2 border-gray-300' }}">
                            {{ $fecha->format('d') }}
                        </div>
                        <p class="text-sm mt-2 text-gray-700 font-semibold">Día {{ $fecha->format('d') }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div id="eventContent"
            class="bg-gradient-to-br from-[#1e2c4f] to-[#4b6587] text-white p-8 rounded-lg shadow-lg transition-all duration-300 ease-in-out overflow-hidden">


            <div class="overflow-hidden">
                <div class="flex flex-col space-y-4"> <!-- Eliminado md:flex-row -->
                    @forelse ($temasDelDia as $index => $tema)
                        @foreach ($tema->ponentes as $ponente)
                            <div class="flex-none w-full bg-white bg-opacity-10 backdrop-blur-md rounded-lg shadow-lg p-4 transform transition-all duration-300 hover:scale-105"
                                x-data="{ showDetails: false }" x-on:mouseenter="showDetails = true"
                                x-on:mouseleave="showDetails = false">
                                <div class="flex items-center space-x-4 overflow-hidden">
                                    <img src="{{ url('storage', $ponente->imagen) }}"
                                        alt="Imagen de {{ $ponente->nombre }} {{ $ponente->apellidos }}"
                                        class="w-20 h-20 object-cover rounded-full">
                                    <div class="flex-grow">
                                        <h4 class="text-lg font-semibold text-white truncate">
                                            {{ $ponente->nombre }} {{ $ponente->apellidos }}
                                        </h4>
                                        <p class="text-sm font-medium text-indigo-300 truncate">
                                            {{ $ponente->institucion }}
                                        </p>
                                        <p class="text-sm font-semibold text-blue-300 mt-2">
                                            {{ Carbon\Carbon::parse($tema->hora_inicio)->format('H:i') }} -
                                            {{ Carbon\Carbon::parse($tema->hora_fin)->format('H:i') }}
                                        </p>
                                        <p class="text-sm font-medium text-white truncate">{{ $tema->nombre_tema }}
                                        </p>
                                    </div>
                                </div>

                                <div x-show="showDetails" x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 transform scale-95"
                                    x-transition:enter-end="opacity-100 transform scale-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100 transform scale-100"
                                    x-transition:leave-end="opacity-0 transform scale-95"
                                    class="mt-4 bg-white bg-opacity-20 p-4 rounded-lg max-w-full overflow-hidden">
                                    <h4 class="text-xl font-semibold text-white mb-2">
                                        {{ $ponente->nombre }} {{ $ponente->apellidos }}
                                    </h4>
                                    <p class="text-sm font-medium text-indigo-300 mb-2">
                                        {{ $ponente->institucion }}
                                    </p>
                                    <p class="text-white text-sm leading-relaxed mb-4">
                                        {{ $ponente->biografia_breve }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @empty
                        <p class="text-center text-gray-300">No hay temas programados para este día.</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

    <!-- Sección de partners -->
    <section class="bg-gray-100  py-16">
        <div class="container mx-auto px-2">
            <div class="flex flex-col text-center w-full mb-20">
                <h1 class="sm:text-4xl text-3xl font-bold title-font mb-4 text-[#1d4570]">Nuestros Partners
                </h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base text-gray-500">

                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center justify-center">
                <!-- partners 1 -->
                <div
                    class="bg-white p-6 rounded-lg shadow-lg transform hover:translate-y-2 hover:shadow-2xl transition-all duration-300 ease-in-out flex items-center justify-center">
                    <img src="/images/odoo_logo.png" alt="Auspiciador 1" class="w-full h-24 object-contain">
                </div>
                <!--partners 2 -->
                <div
                    class="bg-white p-6 rounded-lg shadow-lg transform hover:translate-y-2 hover:shadow-2xl transition-all duration-300 ease-in-out flex items-center justify-center">
                    <img src="/images/logo-oracle.jpg" alt="Auspiciador 2" class="w-full h-24 object-contain">
                </div>
                <!-- partners 3 -->
                <div
                    class="bg-white p-6 rounded-lg shadow-lg transform hover:translate-y-2 hover:shadow-2xl transition-all duration-300 ease-in-out flex items-center justify-center">
                    <img src="/images/fortinet.png" alt="Auspiciador 3" class="w-full h-24 object-contain">
                </div>
            </div>
        </div>
    </section>

    <section class="text-gray-600 body-font overflow-hidden bg-gradient-to-r from-gray-100 to-gray-200">
        <div class="container px-5 py-24 mx-auto">
            <!-- Título de la sección -->
            <div class="flex flex-col text-center w-full mb-20">
                <h1 class="sm:text-4xl text-3xl font-bold title-font mb-4 text-[#1d4570]">Precios del Evento Académico
                </h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base text-gray-600">Selecciona tu tipo de asistente
                    para conocer el precio. ¡Aprovecha nuestras tarifas especiales!</p>
            </div>

            <!-- Sección de tarjetas de precios -->
            <div class="flex flex-wrap justify-center">
                <!-- Tarjeta de precio -->
                <div class="p-4 xl:w-1/3 md:w-1/2 w-full">
                    <div
                        class="h-full p-6 rounded-lg border-2 border-[#00dffd] flex flex-col relative overflow-hidden shadow-2xl hover:shadow-3xl transition-all duration-300 bg-white">
                        <h2 class="text-sm tracking-widest title-font mb-1 font-semibold text-[#1d4570] uppercase">
                            Estudiante FISME</h2>
                        <h1
                            class="text-5xl text-[#00dffd] leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                            <span>S/50</span>
                            <span class="text-lg ml-1 font-normal text-gray-500">/persona</span>
                        </h1>
                        <p class="flex items-center text-gray-600 mb-2">
                            <span
                                class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-[#00dffd] text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>Acceso a todas las conferencias
                        </p>
                        <p class="flex items-center text-gray-600 mb-2">
                            <span
                                class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-[#00dffd] text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>Material digital del evento
                        </p>
                        <p class="flex items-center text-gray-600 mb-6">
                            <span
                                class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-[#00dffd] text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>Certificado de participación
                        </p>
                        <button
                            class="flex items-center mt-auto text-white bg-[#1d4570] border-0 py-2 px-4 w-full focus:outline-none hover:bg-[#00dffd] rounded transition-colors duration-300 ease-in-out">
                            Inscribirse
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- Repetir las tarjetas para otros tipos de asistentes -->
                <!-- Otra tarjeta -->
                <div class="p-4 xl:w-1/3 md:w-1/2 w-full">
                    <div
                        class="h-full p-6 rounded-lg border-2 border-[#00dffd] flex flex-col relative overflow-hidden shadow-2xl hover:shadow-3xl transition-all duration-300 bg-white">
                        <h2 class="text-sm tracking-widest title-font mb-1 font-semibold text-[#1d4570] uppercase">
                            Docente FISME</h2>
                        <h1
                            class="text-5xl text-[#00dffd] leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                            <span>S/60</span>
                            <span class="text-lg ml-1 font-normal text-gray-500">/persona</span>
                        </h1>
                        <p class="flex items-center text-gray-600 mb-2">
                            <span
                                class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-[#00dffd] text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>Acceso a todas las conferencias
                        </p>
                        <p class="flex items-center text-gray-600 mb-2">
                            <span
                                class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-[#00dffd] text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>Material digital del evento
                        </p>
                        <p class="flex items-center text-gray-600 mb-6">
                            <span
                                class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-[#00dffd] text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>Certificado de participación
                        </p>
                        <button
                            class="flex items-center mt-auto text-white bg-[#1d4570] border-0 py-2 px-4 w-full focus:outline-none hover:bg-[#00dffd] rounded transition-colors duration-300 ease-in-out">
                            Inscribirse
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="p-4 xl:w-1/3 md:w-1/2 w-full">
                    <div
                        class="h-full p-6 rounded-lg border-2 border-[#00dffd] flex flex-col relative overflow-hidden shadow-2xl hover:shadow-3xl transition-all duration-300 bg-white">
                        <h2 class="text-sm tracking-widest title-font mb-1 font-semibold text-[#1d4570] uppercase">
                            Egresados FISME</h2>
                        <h1
                            class="text-5xl text-[#00dffd] leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                            <span>S/60</span>
                            <span class="text-lg ml-1 font-normal text-gray-500">/persona</span>
                        </h1>
                        <p class="flex items-center text-gray-600 mb-2">
                            <span
                                class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-[#00dffd] text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>Acceso a todas las conferencias
                        </p>
                        <p class="flex items-center text-gray-600 mb-2">
                            <span
                                class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-[#00dffd] text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>Material digital del evento
                        </p>
                        <p class="flex items-center text-gray-600 mb-6">
                            <span
                                class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-[#00dffd] text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>Certificado de participación
                        </p>
                        <button
                            class="flex items-center mt-auto text-white bg-[#1d4570] border-0 py-2 px-4 w-full focus:outline-none hover:bg-[#00dffd] rounded transition-colors duration-300 ease-in-out">
                            Inscribirse
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>


                <!-- Otra tarjeta -->
                <div class="p-4 xl:w-1/3 md:w-1/2 w-full">
                    <div
                        class="h-full p-6 rounded-lg border-2 border-[#00dffd] flex flex-col relative overflow-hidden shadow-2xl hover:shadow-3xl transition-all duration-300 bg-white">
                        <h2 class="text-sm tracking-widest title-font mb-1 font-semibold text-[#1d4570] uppercase">
                            Docente UTRM</h2>
                        <h1
                            class="text-5xl text-[#00dffd] leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                            <span>S/70</span>
                            <span class="text-lg ml-1 font-normal text-gray-500">/persona</span>
                        </h1>
                        <p class="flex items-center text-gray-600 mb-2">
                            <span
                                class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-[#00dffd] text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>Acceso a todas las conferencias
                        </p>
                        <p class="flex items-center text-gray-600 mb-2">
                            <span
                                class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-[#00dffd] text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>Material digital del evento
                        </p>
                        <p class="flex items-center text-gray-600 mb-6">
                            <span
                                class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-[#00dffd] text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>Certificado de participación
                        </p>
                        <button
                            class="flex items-center mt-auto text-white bg-[#1d4570] border-0 py-2 px-4 w-full focus:outline-none hover:bg-[#00dffd] rounded transition-colors duration-300 ease-in-out">
                            Inscribirse
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="p-4 xl:w-1/3 md:w-1/2 w-full">
                    <div
                        class="h-full p-6 rounded-lg border-2 border-[#00dffd] flex flex-col relative overflow-hidden shadow-2xl hover:shadow-3xl transition-all duration-300 bg-white">
                        <h2 class="text-sm tracking-widest title-font mb-1 font-semibold text-[#1d4570] uppercase">
                            Público General- Estudiante</h2>
                        <h1
                            class="text-5xl text-[#00dffd] leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                            <span>S/85</span>
                            <span class="text-lg ml-1 font-normal text-gray-500">/persona</span>
                        </h1>
                        <p class="flex items-center text-gray-600 mb-2">
                            <span
                                class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-[#00dffd] text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>Acceso a todas las conferencias
                        </p>
                        <p class="flex items-center text-gray-600 mb-2">
                            <span
                                class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-[#00dffd] text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>Material digital del evento
                        </p>
                        <p class="flex items-center text-gray-600 mb-6">
                            <span
                                class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-[#00dffd] text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>Certificado de participación
                        </p>
                        <button
                            class="flex items-center mt-auto text-white bg-[#1d4570] border-0 py-2 px-4 w-full focus:outline-none hover:bg-[#00dffd] rounded transition-colors duration-300 ease-in-out">
                            Inscribirse
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="p-4 xl:w-1/3 md:w-1/2 w-full">
                    <div
                        class="h-full p-6 rounded-lg border-2 border-[#00dffd] flex flex-col relative overflow-hidden shadow-2xl hover:shadow-3xl transition-all duration-300 bg-white">
                        <h2 class="text-sm tracking-widest title-font mb-1 font-semibold text-[#1d4570] uppercase">
                            Público general - profesionales</h2>
                        <h1
                            class="text-5xl text-[#00dffd] leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                            <span>S/100</span>
                            <span class="text-lg ml-1 font-normal text-gray-500">/persona</span>
                        </h1>
                        <p class="flex items-center text-gray-600 mb-2">
                            <span
                                class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-[#00dffd] text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>Acceso a todas las conferencias
                        </p>
                        <p class="flex items-center text-gray-600 mb-2">
                            <span
                                class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-[#00dffd] text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>Material digital del evento
                        </p>
                        <p class="flex items-center text-gray-600 mb-6">
                            <span
                                class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-[#00dffd] text-white rounded-full flex-shrink-0">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                                    <path d="M20 6L9 17l-5-5"></path>
                                </svg>
                            </span>Certificado de participación
                        </p>
                        <button
                            class="flex items-center mt-auto text-white bg-[#1d4570] border-0 py-2 px-4 w-full focus:outline-none hover:bg-[#00dffd] rounded transition-colors duration-300 ease-in-out">
                            Inscribirse
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="flex justify-center">
                <!-- Botón para abrir el modal -->
                <button type="button"
                    class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium  border-transparent text-white bg-[#1d4570]  w-30% focus:outline-none hover:bg-[#00dffd] rounded transition-colors duration-300 ease-in-outdisabled:opacity-50 disabled:pointer-events-none"
                    aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-small-modal"
                    data-hs-overlay="#hs-small-modal">
                    Cómo realizar el pago
                </button>
                <div id="hs-small-modal"
                    class="hs-overlay hs-overlay-backdrop-open:bg-blue-950/90 hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none dark:hs-overlay-backdrop-open:bg-blue-950/90"
                    role="dialog" tabindex="-1" aria-labelledby="hs-custom-backdrop-label">
                    <div
                        class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                        <div
                            class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                            <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                                <h3 class="font-bold text-gray-800 dark:text-white text-xl">
                                    Pasos para la Inscripción
                                </h3>
                                <button type="button"
                                    class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                                    aria-label="Close" data-hs-overlay="#hs-small-modal">
                                    <span class="sr-only">Close</span>
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 6 6 18"></path>
                                        <path d="m6 6 12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="p-4 overflow-y-auto max-h-[70vh]">
                                <ol class="relative border-l border-blue-500 space-y-8 ml-3">
                                    <li class="mb-10 ml-6">
                                        <span
                                            class="absolute flex items-center justify-center w-8 h-8 bg-blue-500 rounded-full -left-4 ring-4 ring-white">
                                            <span class="text-white text-lg font-bold">1</span>
                                        </span>
                                        <h3 class="mb-2 text-lg font-semibold text-gray-900">Realizar el depósito</h3>
                                        <p class="text-base text-gray-700">
                                            Deposita el monto de inscripción a las siguientes cuentas de la UNTRM:
                                        </p>
                                        <ul class="mt-2 list-disc list-inside text-base text-gray-700">
                                            <li>Banco de la Nación-CTA CTE 00261022419
                                            </li>
                                            <li>Banco de la Nación-CCI 01826100026102241984

                                            </li>
                                            <li>BANCO DE CRÉDITO -CTA CTE: 290-4216956-0-05

                                            </li>
                                            <li>BANCO DE CRÉDITO - CCI : 002 290 00421695600 551

                                            </li>
                                        </ul>
                                        <img src="/placeholder.svg?height=150&width=300"
                                            alt="Imagen de depósito bancario" class="mt-3 rounded-lg shadow-md">
                                    </li>
                                    <li class="mb-10 ml-6">
                                        <span
                                            class="absolute flex items-center justify-center w-8 h-8 bg-blue-500 rounded-full -left-4 ring-4 ring-white">
                                            <span class="text-white text-lg font-bold">2</span>
                                        </span>
                                        <h3 class="mb-2 text-lg font-semibold text-gray-900">Ingresar a la página del
                                            evento</h3>
                                            
                                        <p class="text-base text-gray-700">
                                            Visita la página oficial del evento y haz clic en el botón "Inscribirse".
                                        </p>
                                        <img src="/placeholder.svg?height=150&width=300"
                                            alt="Imagen de la página del evento" class="mt-3 rounded-lg shadow-md">
                                    </li>
                                    <li class="mb-10 ml-6">
                                        <span
                                            class="absolute flex items-center justify-center w-8 h-8 bg-blue-500 rounded-full -left-4 ring-4 ring-white">
                                            <span class="text-white text-lg font-bold">3</span>
                                        </span>
                                        <h3 class="mb-2 text-lg font-semibold text-gray-900">Registrar tus datos</h3>
                                        <p class="text-base text-gray-700">
                                            Completa el formulario de inscripción con tus datos personales y de
                                            contacto.
                                        </p>
                                        <img src="/placeholder.svg?height=150&width=300"
                                            alt="Imagen de formulario de registro" class="mt-3 rounded-lg shadow-md">
                                    </li>
                                    <li class="ml-6">
                                        <span
                                            class="absolute flex items-center justify-center w-8 h-8 bg-blue-500 rounded-full -left-4 ring-4 ring-white">
                                            <span class="text-white text-lg font-bold">4</span>
                                        </span>
                                        <h3 class="mb-2 text-lg font-semibold text-gray-900">Cargar el comprobante de
                                            pago</h3>
                                        <p class="text-base text-gray-700">
                                            En la sección de carga de imagen, sube una foto clara del comprobante de
                                            depósito.
                                        </p>
                                        <img src="/placeholder.svg?height=150&width=300"
                                            alt="Imagen de carga de comprobante" class="mt-3 rounded-lg shadow-md">
                                    </li>
                                </ol>
                            </div>
                            <div
                                class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-neutral-700">
                                <button type="button"
                                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                                    data-hs-overlay="#hs-small-modal">
                                    Cerrar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>

    </section>
    @php
    $touristAttractions = [
        [
            'id' => 1,
            'name' => 'Catarata de Gocta',
            'description' => 'Una de las cataratas más altas del mundo ubicada cerca de Bagua.',
            'image' => '/images/catarata-gocta.jpg',
            'link' => '/gocta'
        ],
        [
            'id' => 2,
            'name' => 'Fortaleza de Kuelap',
            'description' => 'Una increíble fortaleza preincaica ubicada en la región de Amazonas.',
            'image' => '/images/kuelap.webp',
            'link' => '/kuelap'
        ],
        [
            'id' => 3,
            'name' => 'Caverna de Quiocta',
            'description' => 'Un lugar místico lleno de historia y belleza natural cerca de Bagua.',
            'image' => '/images/quiocta.jpg',
            'link' => '/quiocta'
        ]
    ];
    @endphp
    
    <section class="py-16 bg-gradient-to-b from-gray-50 to-white w-full">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl sm:text-5xl font-bold text-center mb-12 text-[#1d4570] ">
                Lugar del Evento
            </h2>
    
            <div class="flex flex-col lg:flex-row items-center justify-between space-y-8 lg:space-y-0 lg:space-x-12 mb-16">
                <div class="lg:w-1/2 space-y-6 text-center lg:text-left">
                    <h3 class="text-2xl sm:text-3xl font-semibold text-[#133e6b]">
                        Auditorio de la Facultad de Ingeniería de Sistemas y Mecánica Eléctrica - UNTRM
                    </h3>
                    <p class="text-lg text-gray-700">
                        Jr. Libertad Número, Bagua, Amazonas, Perú
                    </p>
                    <a
                        href="/contact/"
                        class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-[#133e6b] hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg"
                    >
                        Ver en Mapa
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
    
                <div class="lg:w-1/2">
                    <div class="relative overflow-hidden rounded-xl shadow-2xl">
                        <img
                            src="/images/auditorio-untrm.jpg"
                            alt="Lugar del Evento"
                            class="w-full h-64 object-cover transform transition duration-300 hover:scale-105"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 text-white">
                                <p class="text-lg font-semibold">Auditorio UNTRM</p>
                                <p class="text-sm">Capacidad: 500 personas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <h3 class="text-3xl text-center font-semibold mt-16 mb-8 text-[#133e6b]">
                Bagua: Ciudad Calidad y Solidaria
            </h3>
    
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:scale-105">
                    <img class="w-full h-48 object-cover" src="{{ $touristAttractions[0]['image'] }}" alt="{{ $touristAttractions[0]['name'] }}" />
                    <div class="p-6">
                        <h4 class="text-xl font-semibold mb-2 text-[#133e6b]">{{ $touristAttractions[0]['name'] }}</h4>
                        <p class="text-gray-600 mb-4">{{ $touristAttractions[0]['description'] }}</p>
                        <a
                            href="{{ $touristAttractions[0]['link'] }}"
                            class="text-blue-500 hover:text-blue-700 font-medium transition-colors duration-300"
                        >
                            Ver más
                        </a>
                    </div>
                </div>
    
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:scale-105">
                    <img class="w-full h-48 object-cover" src="{{ $touristAttractions[1]['image'] }}" alt="{{ $touristAttractions[1]['name'] }}" />
                    <div class="p-6">
                        <h4 class="text-xl font-semibold mb-2 text-[#133e6b]">{{ $touristAttractions[1]['name'] }}</h4>
                        <p class="text-gray-600 mb-4">{{ $touristAttractions[1]['description'] }}</p>
                        <a
                            href="{{ $touristAttractions[1]['link'] }}"
                            class="text-blue-500 hover:text-blue-700 font-medium transition-colors duration-300"
                        >
                            Ver más
                        </a>
                    </div>
                </div>
    
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-300 hover:shadow-xl hover:scale-105">
                    <img class="w-full h-48 object-cover" src="{{ $touristAttractions[2]['image'] }}" alt="{{ $touristAttractions[2]['name'] }}" />
                    <div class="p-6">
                        <h4 class="text-xl font-semibold mb-2 text-[#133e6b]">{{ $touristAttractions[2]['name'] }}</h4>
                        <p class="text-gray-600 mb-4">{{ $touristAttractions[2]['description'] }}</p>
                        <a
                            href="{{ $touristAttractions[2]['link'] }}"
                            class="text-blue-500 hover:text-blue-700 font-medium transition-colors duration-300"
                        >
                            Ver más
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    


    <!-- Sección de auspiciadores -->
    <section class="bg-gray-100 py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-[#1d4570] mb-12">Nuestros auspiciadores</h2>
            <div class="flex flex-wrap justify-center gap-8">
                <!--  rb -->
                <div
                    class="w-40 h-40 bg-white shadow-lg rounded-lg flex items-center justify-center transform hover:scale-105 transition-transform duration-300 ease-in-out">
                    <img src="/images/RB.jpg" alt="rb" class="w-full h-full object-contain">
                </div>
                <!--  apu -->
                <div
                    class="w-40 h-40 bg-white shadow-lg rounded-lg flex items-center justify-center transform hover:scale-105 transition-transform duration-300 ease-in-out">
                    <img src="/images/APU.jpg" alt="apu"
                        class="w-full h-full object-contain">
                </div>
                <!--  -->
                <div
                    class="w-40 h-40 bg-white shadow-lg rounded-lg flex items-center justify-center transform hover:scale-105 transition-transform duration-300 ease-in-out">
                    <img src="/images/ARROZ.jpg" alt="principe" class="w-full h-full object-contain">
                </div>
            </div>
        </div>
    </section>

</div>

<script>
    function updateMobileDisplay() {
        const dateContainer = document.getElementById('dateContainer');
        const isMobile = window.innerWidth < 768;

        if (isMobile) {
            const currentIndex = Array.from(dateContainer.children).findIndex(
                child => child.querySelector('div').classList.contains('bg-[#1d4570]')
            );

            dateContainer.innerHTML = `
                <button wire:click="prevDate" class="p-2 rounded-full bg-[#1d4570] text-white hover:bg-blue-800 transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                </button>
                ${dateContainer.children[currentIndex].outerHTML}
                <button wire:click="nextDate" class="p-2 rounded-full bg-[#1d4570] text-white hover:bg-blue-800 transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </button>
            `;
        } else {
            Livewire.emit('refreshDates');
        }
    }

    window.addEventListener('resize', updateMobileDisplay);
    document.addEventListener('DOMContentLoaded', updateMobileDisplay);
    document.addEventListener('livewire:load', function() {
        Livewire.on('dateChanged', updateMobileDisplay);
    });

    function updateCountdown() {
        const now = new Date();
        const eventDate = new Date("{{ $evento->fecha_inicio }}");
        const difference = eventDate.getTime() - now.getTime();

        if (difference > 0) {
            const days = Math.floor(difference / (1000 * 60 * 60 * 24));
            const hours = Math.floor((difference / (1000 * 60 * 60)) % 24);
            const minutes = Math.floor((difference / 1000 / 60) % 60);
            const seconds = Math.floor((difference / 1000) % 60);

            document.querySelector('[data-unit="days"]').textContent = days.toString().padStart(2, '0');
            document.querySelector('[data-unit="hours"]').textContent = hours.toString().padStart(2, '0');
            document.querySelector('[data-unit="minutes"]').textContent = minutes.toString().padStart(2, '0');
            document.querySelector('[data-unit="seconds"]').textContent = seconds.toString().padStart(2, '0');
        } else {
            clearInterval(countdownInterval);
            document.querySelector('.flex.flex-wrap.justify-center').innerHTML = `
                <div class="text-center bg-opacity-20 bg-white backdrop-filter backdrop-blur-lg rounded-lg p-6 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="text-3xl font-bold">${new Date("{{ $evento->fecha_inicio }}").toLocaleDateString()}</span>
                </div>
            `;
        }
    }
    document.addEventListener('DOMContentLoaded', (event) => {
        const animatedElements = document.querySelectorAll('[data-animate]');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                }
            });
        }, {
            threshold: 0.1
        });

        animatedElements.forEach(el => observer.observe(el));

        // Simular carga de datos (reemplazar con tu lógica de carga real)

    });
    const countdownInterval = setInterval(updateCountdown, 1000);
    updateCountdown();

    function carousel() {
        return {
            activeIndex: 0,
            init() {
                setInterval(() => {
                    this.activeIndex = (this.activeIndex + 1) % 3;
                }, 3000);
            }
        }
    }

    function scrollAnimation() {
        return {
            inView: false,
            init() {
                this.checkView();
                window.addEventListener('scroll', () => this.checkView());
            },
            checkView() {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        this.inView = entry.isIntersecting;
                    });
                }, {
                    threshold: 0.1
                });

                observer.observe(this.$refs.container);
            }
        }
    }


    function topicsAnimation() {
        return {
            topics: [{
                    title: 'Data Science',
                    description: 'Analizando y utilizando datos para tomar decisiones informadas y resolver problemas complejos.'
                },
                {
                    title: 'IA - Deep Learning',
                    description: 'Explorando técnicas avanzadas de inteligencia artificial que simulan el funcionamiento del cerebro humano para aprender y tomar decisiones.'
                },
                {
                    title: 'Ciberseguridad',
                    description: 'Protegiendo sistemas, redes y datos de ataques digitales, asegurando la confidencialidad e integridad de la información.'
                },
                {
                    title: 'Biotecnología',
                    description: 'Aplicando principios biológicos y tecnológicos para desarrollar productos y procesos que mejoren la calidad de vida.'
                },
                {
                    title: 'Sistemas Empresariales',
                    description: 'Integrando procesos y tecnología para optimizar la gestión y operación de organizaciones.'
                },
                {
                    title: 'Entre otros',
                    description: 'Incluye una variedad de temas emergentes y relevantes en tecnología y ciencia.'
                }
            ],
            topicsInView: false,
            init() {
                this.checkTopicsView();
                window.addEventListener('scroll', () => this.checkTopicsView());
            },
            checkTopicsView() {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        this.topicsInView = entry.isIntersecting;
                    });
                }, {
                    threshold: 0.1
                });

                observer.observe(this.$refs.topicsContainer);
            }
        }
    }
</script>
