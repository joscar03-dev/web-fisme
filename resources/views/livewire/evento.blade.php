<div class="bg-gradient-to-b from-gray-100 to-white">
    <!-- Título del evento y detalles principales -->
    <!-- Título del evento y detalles principales -->
    <div
        class="relative bg-gradient-to-r from-[#001f54] to-[#4b6587] text-white p-10 rounded-b-3xl shadow-2xl overflow-hidden">
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

        <div class="flex flex-col items-center justify-center relative z-10 text-center">
            <!-- Hero Content -->
            <div class="w-full max-w-4xl space-y-8 animate-fade-in-up">
                <!-- Nombre del Evento -->
                <div class="bg-transparent p-4">
                    <h1
                        class="text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight mb-4 text-transparent bg-clip-text bg-gradient-to-r from-gray-400 via-[#00dffd] to-gray-500 font-sans shadow-lg glow-effect">
                        {{ $evento->nombre_evento }}
                    </h1>
                    <p class="text-sm text-white mt-2">Facultad de Ingeniería de Sistemas y Mecánica Eléctrica</p>
                </div>

                <!-- Cronómetro integrado al hero -->
                <div class="flex flex-wrap justify-center items-center space-x-4 text-white text-2xl font-bold mb-8">
                    @foreach (['Days', 'Hours', 'Minutes', 'Seconds'] as $unit)
                        <div
                            class="timer text-center bg-opacity-20 bg-white backdrop-filter backdrop-blur-lg rounded-lg p-4 shadow-lg">
                            <span class="countdown-element font-mono text-4xl md:text-5xl block"
                                data-unit="{{ strtolower($unit) }}">00</span>
                            <p class="text-xs uppercase tracking-wide mt-2">{{ $unit }}</p>
                        </div>
                        @if (!$loop->last)
                            <span class="text-4xl font-thin hidden md:block">:</span>
                        @endif
                    @endforeach
                </div>

                <!-- Modalidad del Evento -->
                <div
                    class="bg-opacity-20 bg-white backdrop-filter backdrop-blur-lg rounded-lg p-4 shadow-lg inline-block">
                    <p class="text-lg font-semibold">
                        Modalidad del Evento:
                        <span class="text-yellow-300">Presencial</span> y
                        <span class="text-green-300">Virtual</span>
                    </p>
                </div>

                <!-- Botones de acción -->
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4 mt-8">
                    <a href="{{ route('event.registration', ['eventoId' => $evento->id]) }}"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-full shadow-lg transition duration-300 transform hover:scale-105 flex items-center justify-center text-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Inscribirme
                    </a>
                    <button
                        class="bg-gray-700 hover:bg-gray-800 text-white font-bold py-3 px-6 rounded-full shadow-lg transition duration-300 transform hover:scale-105 flex items-center justify-center text-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Agregar a Google Calendar
                    </button>
                </div>
            </div>

        </div>
    </div>
    <section class="py-16 px-4 mx-auto max-w-screen-xl">
        <div class="grid md:grid-cols-2 gap-16 items-center">
            <div class="space-y-6">
                <h4 class="text-3xl font-light text-gray-900">{{ $evento->descripcion_breve }}</h4>
                <div class="space-y-4">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-700 mb-2">Fechas:</h2>
                        <p class="flex items-center text-lg text-gray-600">
                            <svg class="w-6 h-6 mr-2 text-indigo-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d/m/Y') }} -
                            {{ \Carbon\Carbon::parse($evento->fecha_fin)->format('d/m/Y') }}
                        </p>
                    </div>
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-700 mb-2">Hora:</h2>
                        <p class="flex items-center text-lg text-gray-600">
                            <svg class="w-6 h-6 mr-2 text-indigo-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ \Carbon\Carbon::parse($evento->hora_inicio)->format('H:i') }} -
                            {{ \Carbon\Carbon::parse($evento->hora_salida)->format('H:i') }}
                        </p>
                    </div>
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-700 mb-2">Lugar</h2>
                        <p class="flex items-center text-lg text-gray-600">
                            <svg class="w-6 h-6 mr-2 text-indigo-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $evento->lugar }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <img class="w-full h-64 object-cover rounded-lg shadow-md transform hover:scale-105 transition duration-300"
                    src="{{ asset('storage/' . $evento->imagen_banner) }}" alt="Imagen del evento 1">
                <img class="w-full h-64 object-cover rounded-lg shadow-md transform hover:scale-105 transition duration-300 mt-8"
                    src="{{ asset('storage/' . $evento->imagen_banner) }}" alt="Imagen del evento 2">
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
            class="bg-gradient-to-br from-[#1e2c4f] to-[#4b6587] text-white p-8 rounded-lg shadow-lg transition-all duration-300 ease-in-out">
            <h3 class="text-3xl font-bold mb-6">{{ Carbon\Carbon::parse($fechaSeleccionada)->format('d \d\e F, Y') }}
            </h3>

            <div class="overflow-x-auto">
                <div class="flex space-x-4">
                    @forelse ($temasDelDia as $index => $tema)
                        @foreach ($tema->ponentes as $ponente)
                            <div class="flex-none w-full md:w-[calc(100%-2rem)] lg:w-[calc(100%-4rem)] bg-white bg-opacity-10 backdrop-blur-md rounded-lg shadow-lg p-4 transform transition-all duration-300 hover:scale-105"
                                x-data="{ showDetails: false }" x-on:mouseenter="showDetails = true"
                                x-on:mouseleave="showDetails = false">
                                <div class="flex items-center space-x-4">
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
                                    class="mt-4 bg-white bg-opacity-20 p-4 rounded-lg">
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



    <section class="text-gray-600 body-font overflow-hidden">
        <div class="container px-5 py-24 mx-auto">
            <!-- Título de la sección -->
            <div class="flex flex-col text-center w-full mb-20">
                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">Precios del Evento Académico
                </h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base text-gray-500">Selecciona tu tipo de asistente
                    para conocer el precio. ¡Aprovecha nuestras tarifas especiales!</p>
            </div>

            <!-- Sección de tarjetas de precios -->
            <div class="flex flex-wrap -m-4">

                <!-- Tarjeta 1: Estudiante FISME -->
                <div class="p-4 xl:w-1/3 md:w-1/2 w-full">
                    <div
                        class="h-full p-6 rounded-lg border-2 border-indigo-500 bg-blue-100 flex flex-col relative overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center justify-between">
                            <h2 class="text-sm tracking-widest title-font mb-1 font-medium text-indigo-700">Estudiante
                                FISME</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-700" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l6.16-3.422A12.042 12.042 0 0112 21a12.042 12.042 0 01-6.16-10.422L12 14z" />
                            </svg>
                        </div>
                        <h1 class="text-5xl text-indigo-900 pb-4 mb-4 border-b border-gray-300 leading-none">S/50</h1>
                        <p class="flex items-center text-indigo-600 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-700 mr-2"
                                viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm-1 17v-4h2v4h-2zm1-5.93l-1.14-.84.57-1.23H14l.57 1.23-1.14.84z" />
                            </svg>Incluye acceso a todas las conferencias.
                        </p>
                        <button
                            class="flex items-center mt-auto text-white bg-indigo-500 border-0 py-2 px-4 w-full focus:outline-none hover:bg-indigo-600 rounded">Inscribirse
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="p-4 xl:w-1/3 md:w-1/2 w-full">
                    <div
                        class="h-full p-6 rounded-lg border-2 border-indigo-500 bg-blue-100 flex flex-col relative overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center justify-between">
                            <h2 class="text-sm tracking-widest title-font mb-1 font-medium text-indigo-700">Docente
                                FISME</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-700" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l6.16-3.422A12.042 12.042 0 0112 21a12.042 12.042 0 01-6.16-10.422L12 14z" />
                            </svg>
                        </div>
                        <h1 class="text-5xl text-indigo-900 pb-4 mb-4 border-b border-gray-300 leading-none">S/50</h1>
                        <p class="flex items-center text-indigo-600 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-700 mr-2"
                                viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm-1 17v-4h2v4h-2zm1-5.93l-1.14-.84.57-1.23H14l.57 1.23-1.14.84z" />
                            </svg>Incluye acceso a todas las conferencias.
                        </p>
                        <button
                            class="flex items-center mt-auto text-white bg-indigo-500 border-0 py-2 px-4 w-full focus:outline-none hover:bg-indigo-600 rounded">Inscribirse
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="p-4 xl:w-1/3 md:w-1/2 w-full">
                    <div
                        class="h-full p-6 rounded-lg border-2 border-indigo-500 bg-blue-100 flex flex-col relative overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center justify-between">
                            <h2 class="text-sm tracking-widest title-font mb-1 font-medium text-indigo-700">Estudiante
                                FISME</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-700" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l6.16-3.422A12.042 12.042 0 0112 21a12.042 12.042 0 01-6.16-10.422L12 14z" />
                            </svg>
                        </div>
                        <h1 class="text-5xl text-indigo-900 pb-4 mb-4 border-b border-gray-300 leading-none">S/50</h1>
                        <p class="flex items-center text-indigo-600 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-700 mr-2"
                                viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm-1 17v-4h2v4h-2zm1-5.93l-1.14-.84.57-1.23H14l.57 1.23-1.14.84z" />
                            </svg>Incluye acceso a todas las conferencias.
                        </p>
                        <button
                            class="flex items-center mt-auto text-white bg-indigo-500 border-0 py-2 px-4 w-full focus:outline-none hover:bg-indigo-600 rounded">Inscribirse
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="p-4 xl:w-1/3 md:w-1/2 w-full">
                    <div
                        class="h-full p-6 rounded-lg border-2 border-indigo-500 bg-blue-100 flex flex-col relative overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center justify-between">
                            <h2 class="text-sm tracking-widest title-font mb-1 font-medium text-indigo-700">Egresado
                                FISME</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-700" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l6.16-3.422A12.042 12.042 0 0112 21a12.042 12.042 0 01-6.16-10.422L12 14z" />
                            </svg>
                        </div>
                        <h1 class="text-5xl text-indigo-900 pb-4 mb-4 border-b border-gray-300 leading-none">S/50</h1>
                        <p class="flex items-center text-indigo-600 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-700 mr-2"
                                viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm-1 17v-4h2v4h-2zm1-5.93l-1.14-.84.57-1.23H14l.57 1.23-1.14.84z" />
                            </svg>Incluye acceso a todas las conferencias.
                        </p>
                        <button
                            class="flex items-center mt-auto text-white bg-indigo-500 border-0 py-2 px-4 w-full focus:outline-none hover:bg-indigo-600 rounded">Inscribirse
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="p-4 xl:w-1/3 md:w-1/2 w-full">
                    <div
                        class="h-full p-6 rounded-lg border-2 border-indigo-500 bg-blue-100 flex flex-col relative overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center justify-between">
                            <h2 class="text-sm tracking-widest title-font mb-1 font-medium text-indigo-700">Estudiante
                                FISME</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-700" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l6.16-3.422A12.042 12.042 0 0112 21a12.042 12.042 0 01-6.16-10.422L12 14z" />
                            </svg>
                        </div>
                        <h1 class="text-5xl text-indigo-900 pb-4 mb-4 border-b border-gray-300 leading-none">S/50</h1>
                        <p class="flex items-center text-indigo-600 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-700 mr-2"
                                viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm-1 17v-4h2v4h-2zm1-5.93l-1.14-.84.57-1.23H14l.57 1.23-1.14.84z" />
                            </svg>Incluye acceso a todas las conferencias.
                        </p>
                        <button
                            class="flex items-center mt-auto text-white bg-indigo-500 border-0 py-2 px-4 w-full focus:outline-none hover:bg-indigo-600 rounded">Inscribirse
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="p-4 xl:w-1/3 md:w-1/2 w-full">
                    <div
                        class="h-full p-6 rounded-lg border-2 border-indigo-500 bg-blue-100 flex flex-col relative overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-center justify-between">
                            <h2 class="text-sm tracking-widest title-font mb-1 font-medium text-indigo-700">Estudiante
                                FISME</h2>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-700" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l6.16-3.422A12.042 12.042 0 0112 21a12.042 12.042 0 01-6.16-10.422L12 14z" />
                            </svg>
                        </div>
                        <h1 class="text-5xl text-indigo-900 pb-4 mb-4 border-b border-gray-300 leading-none">S/50</h1>
                        <p class="flex items-center text-indigo-600 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-700 mr-2"
                                viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm-1 17v-4h2v4h-2zm1-5.93l-1.14-.84.57-1.23H14l.57 1.23-1.14.84z" />
                            </svg>Incluye acceso a todas las conferencias.
                        </p>
                        <button
                            class="flex items-center mt-auto text-white bg-indigo-500 border-0 py-2 px-4 w-full focus:outline-none hover:bg-indigo-600 rounded">Inscribirse
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>



            </div>
        </div>
    </section>

    <section id="event-location" class="py-16 bg-gray-100 w-full">
        <div class="container mx-auto px-4">
            <!-- Título Principal -->
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-8 transform transition-all duration-500 opacity-0 translate-y-10"
                data-animate>Lugar del Evento</h2>

            <!-- Información del evento -->
            <div class="flex flex-col md:flex-row items-center justify-between space-y-8 md:space-y-0 md:space-x-8">
                <div class="w-full md:w-1/2 space-y-4 transform transition-all duration-500 opacity-0 translate-x-10"
                    data-animate>
                    <h3 class="text-2xl font-semibold" id="venue-name">Auditorio de la Facultad de Ingeniería de
                        Sistemas y Mecánica Eléctrica - UNTRM</h3>
                    <p class="text-gray-600" id="venue-address">Jr. Libertad Número, Bagua, Amazonas, Perú</p>
                    <a href="/contact/"
                        class="inline-block bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-300">Ver
                        en Mapa</a>
                </div>
                <div class="w-full md:w-1/2 transform transition-all duration-500 opacity-0 -translate-x-10"
                    data-animate>
                    <img id="venue-image" src="/images/auditorio-untrm.jpg" alt="Lugar del Evento"
                        class="w-full h-64 object-cover rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                </div>
            </div>

            <!-- Nueva Sección Expansiva - Tarjetas de Lugares Turísticos -->
            <h3 class="text-3xl text-center font-semibold mt-16">Bagua: Ciudad Calidad y Solidaria</h3>
            <div class="flex flex-wrap justify-center gap-6 mt-8">
                <!-- Tarjeta 1 -->
                <div class="bg-white rounded-lg shadow-md w-72 overflow-hidden">
                    <img class="w-full h-40 object-cover" src="/images/turistico1.jpg" alt="Lugar Turístico 1">
                    <div class="p-4">
                        <h4 class="text-xl font-semibold">Catarata de Gocta</h4>
                        <p class="text-gray-600">Una de las cataratas más altas del mundo ubicada cerca de Bagua.
                        </p>
                        <a href="/gocta" class="text-blue-500 hover:underline">Ver más</a>
                    </div>
                </div>

                <!-- Tarjeta 2 -->
                <div class="bg-white rounded-lg shadow-md w-72 overflow-hidden">
                    <img class="w-full h-40 object-cover" src="/images/turistico2.jpg" alt="Lugar Turístico 2">
                    <div class="p-4">
                        <h4 class="text-xl font-semibold">Fortaleza de Kuelap</h4>
                        <p class="text-gray-600">Una increíble fortaleza preincaica ubicada en la región de
                            Amazonas.</p>
                        <a href="/kuelap" class="text-blue-500 hover:underline">Ver más</a>
                    </div>
                </div>

                <!-- Tarjeta 3 -->
                <div class="bg-white rounded-lg shadow-md w-72 overflow-hidden">
                    <img class="w-full h-40 object-cover" src="/images/turistico3.jpg" alt="Lugar Turístico 3">
                    <div class="p-4">
                        <h4 class="text-xl font-semibold">Caverna de Quiocta</h4>
                        <p class="text-gray-600">Un lugar místico lleno de historia y belleza natural cerca de
                            Bagua.</p>
                        <a href="/quiocta" class="text-blue-500 hover:underline">Ver más</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Partners -->
    <!-- Sección de Partners -->
    <section class="bg-gray-100 py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">Nuestros Partners</h2>
            <div class="flex flex-wrap justify-center gap-8">
                <!-- Partner Odoo -->
                <div
                    class="w-40 h-40 bg-white shadow-lg rounded-lg flex items-center justify-center transform hover:scale-105 transition-transform duration-300 ease-in-out">
                    <img src="/images/odoo_logo.png"
                        alt="Odoo" class="w-full h-full object-contain">
                </div>
                <!-- Partner Oracle Academy -->
                <div
                    class="w-40 h-40 bg-white shadow-lg rounded-lg flex items-center justify-center transform hover:scale-105 transition-transform duration-300 ease-in-out">
                    <img src="https://logos-world.net/wp-content/uploads/2020/09/Oracle-Logo.png" alt="Oracle Academy"
                        class="w-full h-full object-contain">
                </div>
                <!-- Partner Fortinet -->
                <div
                    class="w-40 h-40 bg-white shadow-lg rounded-lg flex items-center justify-center transform hover:scale-105 transition-transform duration-300 ease-in-out">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/3/38/Fortinet_logo.svg" alt="Fortinet"
                        class="w-full h-full object-contain">
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Auspiciadores -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">Nuestros Auspiciadores</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center justify-center">
                <!-- Auspiciador 1 -->
                <div
                    class="bg-gray-200 p-6 rounded-lg shadow-lg transform hover:translate-y-2 hover:shadow-2xl transition-all duration-300 ease-in-out flex items-center justify-center">
                    <img src="/images/auspiciador1-logo.png" alt="Auspiciador 1" class="w-full h-24 object-contain">
                </div>
                <!-- Auspiciador 2 -->
                <div
                    class="bg-gray-200 p-6 rounded-lg shadow-lg transform hover:translate-y-2 hover:shadow-2xl transition-all duration-300 ease-in-out flex items-center justify-center">
                    <img src="/images/auspiciador2-logo.png" alt="Auspiciador 2" class="w-full h-24 object-contain">
                </div>
                <!-- Auspiciador 3 -->
                <div
                    class="bg-gray-200 p-6 rounded-lg shadow-lg transform hover:translate-y-2 hover:shadow-2xl transition-all duration-300 ease-in-out flex items-center justify-center">
                    <img src="/images/auspiciador3-logo.png" alt="Auspiciador 3" class="w-full h-24 object-contain">
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
</script>
