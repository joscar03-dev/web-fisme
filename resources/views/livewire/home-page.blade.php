<div class="">

    <!-- SVG Background -->
    <div class="relative overflow-hidden mb-12 sm:mb-16 lg:mb-20"> <!-- Ajustar el margin-bottom -->


        <!-- SVG Background -->
        <div class="absolute inset-0 pointer-events-none z-0">

            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000" fill="none">
                <g transform="translate(600, 400) rotate(45)">
                    <path d="M0 0 L100 0 L100 100 L0 100 Z" fill="rgba(0, 31, 84, 0.05)" />
                    <path d="M0 0 L50 -50 L150 -50 L100 0 Z" fill="rgba(0, 31, 84, 0.1)" />
                    <path d="M100 0 L150 -50 L150 50 L100 100 Z" fill="rgba(0, 31, 84, 0.15)" />
                </g>
                <!-- Neural Network -->
                <g transform="translate(100, 100) scale(0.8)">
                    <circle cx="100" cy="100" r="20" fill="rgba(0, 31, 84, 0.1)" />
                    <circle cx="300" cy="150" r="20" fill="rgba(0, 31, 84, 0.1)" />
                    <circle cx="500" cy="100" r="20" fill="rgba(0, 31, 84, 0.1)" />
                    <circle cx="200" cy="300" r="20" fill="rgba(0, 31, 84, 0.1)" />
                    <circle cx="400" cy="350" r="20" fill="rgba(0, 31, 84, 0.1)" />
                    <line x1="100" y1="100" x2="300" y2="150" stroke="rgba(0, 31, 84, 0.1)"
                        stroke-width="2" />
                    <line x1="300" y1="150" x2="500" y2="100" stroke="rgba(0, 31, 84, 0.1)"
                        stroke-width="2" />
                    <line x1="100" y1="100" x2="200" y2="300" stroke="rgba(0, 31, 84, 0.1)"
                        stroke-width="2" />
                    <line x1="300" y1="150" x2="200" y2="300" stroke="rgba(0, 31, 84, 0.1)"
                        stroke-width="2" />
                    <line x1="300" y1="150" x2="400" y2="350" stroke="rgba(0, 31, 84, 0.1)"
                        stroke-width="2" />
                    <line x1="500" y1="100" x2="400" y2="350" stroke="rgba(0, 31, 84, 0.1)"
                        stroke-width="2" />
                </g>
                <!-- 3D Cube -->

                <!-- Binary Code -->
                <text x="100" y="500" fill="rgba(0, 31, 84, 0.1)" font-family="monospace" font-size="20">
                    01001000 01100101 01101100 01101100 01101111
                </text>
                <!-- Circuit Board Lines -->
                <path d="M0 800 Q200 750 400 800 T800 750" stroke="rgba(0, 31, 84, 0.1)" stroke-width="2"
                    fill="none" />
                <path d="M100 850 Q300 900 500 850 T900 900" stroke="rgba(0, 31, 84, 0.1)" stroke-width="2"
                    fill="none" />
            </svg>

        </div>


        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <div class="max-w-7xl mx-auto">
                <!-- Componente de Carrusel con Interacción y Transiciones -->
                <div x-data="{ currentIndex: 0 }" x-init="setInterval(() => currentIndex = (currentIndex + 1) % {{ $eventos->count() ?: 0 }}, 8000)"
                    class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:pb-28 xl:pb-32 min-h-[60vh] lg:min-h-screen flex items-center">

                    <!-- Eventos -->
                    @forelse ($eventos as $index => $evento)
                        <div x-show="currentIndex === {{ $index }}"
                            x-transition:enter="transition ease-out duration-700"
                            x-transition:enter-start="opacity-0 transform translate-x-full"
                            x-transition:enter-end="opacity-100 transform translate-x-0"
                            x-transition:leave="transition ease-in duration-500"
                            x-transition:leave-start="opacity-100 transform translate-x-0"
                            x-transition:leave-end="opacity-0 transform -translate-x-full"
                            class="absolute inset-0 flex flex-col lg:flex-row items-center space-y-6 lg:space-y-0 lg:space-x-10">

                            <!-- Texto a la izquierda -->
                            <div class="w-full lg:w-1/2 flex items-center justify-center px-4">
                                <div
                                    class="text-center lg:text-left backdrop-filter backdrop-blur-md bg-white/30 rounded-lg p-6">
                                    @if ($evento['fecha_inicio'])
                                        <h2 class="text-base text-gray-800 font-semibold tracking-wide uppercase">
                                            {{ $evento['fecha_inicio'] }}
                                        </h2>
                                    @endif
                                    <h1
                                        class="text-2xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-[#001f54e6]">
                                        <span class="block">{{ $evento['nombre_evento'] }}</span>
                                    </h1>
                                    <p class="mt-3 text-sm sm:text-lg md:text-xl text-gray-600">
                                        {{ Str::limit($evento['descripcion_breve'], 150) }}
                                    </p>
                                    <div class="mt-5">
                                        <a wire:key="{{ $evento->slug }}"
                                            href="{{ route('evento.detalle', $evento->slug) }}"
                                            class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm md:text-base font-medium rounded-md text-white bg-[#001f54e6] hover:bg-blue-500 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                                            Inscríbete ahora
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Imagen a la derecha -->
                            <div class="w-full lg:w-1/2 flex items-center justify-center px-4 overflow-y-auto">
                                <img src="{{ asset('storage/' . $evento['imagen_catalogo']) }}" alt="Imagen del evento"
                                    class="w-full lg:w-3/4 h-auto object-contain shadow-2xl rounded-lg mb-4" />
                            </div>
                        </div>
                    @empty
                        <div class="absolute inset-0 flex items-center justify-center">
                            <p class="text-2xl text-gray-600">No hay eventos disponibles en este momento.</p>
                        </div>
                    @endforelse

                    <!-- Botones de control -->
                    <button
                        @click="currentIndex = (currentIndex - 1 + {{ $eventos->count() }}) % {{ $eventos->count() }}"
                        class="absolute left-2 lg:left-0 z-3 p-2 text-white bg-[#001f54e6] hover:bg-blue-500 rounded-full">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            class="w-5 h-5">
                            <path d="M15 18L9 12L15 6" />
                        </svg>
                    </button>

                    <button @click="currentIndex = (currentIndex + 1) % {{ $eventos->count() }}"
                        class="absolute right-2 lg:right-0 z-3 p-2 text-white bg-[#001f54e6] hover:bg-blue-500 rounded-full">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            class="w-5 h-5">
                            <path d="M9 18L15 12L9 6" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

    </div>

    <!-- Countdown Timer Section -->

    <div
        class="flex items-center justify-center w-full gap-1.5 count-down-main px-3 py-6 bg-[#133E6B] flex-wrap lg:flex-nowrap">
        <div class="timer">
            <div
                class="rounded-xl border border-white py-1.5 min-w-[60px] sm:min-w-[80px] lg:min-w-[100px] flex items-center justify-center flex-col gap-0 aspect-square px-1.5">
                <h3
                    class="countdown-element days font-manrope font-semibold text-5xl sm:text-6xl lg:text-8xl text-white text-center">
                    00</h3>
                <p
                    class="text-xs sm:text-sm lg:text-base font-inter capitalize font-normal text-white text-center w-full">
                    Days</p>
            </div>
        </div>
        <h3 class="font-manrope font-semibold text-2xl sm:text-3xl lg:text-4xl text-white">:</h3>
        <div class="timer">
            <div
                class="rounded-xl border border-white py-1.5 min-w-[60px] sm:min-w-[80px] lg:min-w-[100px] flex items-center justify-center flex-col gap-0 aspect-square px-1.5">
                <h3
                    class="countdown-element hours font-manrope font-semibold text-5xl sm:text-6xl lg:text-8xl text-white text-center">
                    00</h3>
                <p
                    class="text-xs sm:text-sm lg:text-base font-inter capitalize font-normal text-white text-center w-full">
                    Hours</p>
            </div>
        </div>
        <h3 class="font-manrope font-semibold text-2xl sm:text-3xl lg:text-4xl text-white">:</h3>
        <div class="timer">
            <div
                class="rounded-xl border border-white py-1.5 min-w-[60px] sm:min-w-[80px] lg:min-w-[100px] flex items-center justify-center flex-col gap-0 aspect-square px-1.5">
                <h3
                    class="countdown-element minutes font-manrope font-semibold text-5xl sm:text-6xl lg:text-8xl text-white text-center">
                    00</h3>
                <p
                    class="text-xs sm:text-sm lg:text-base font-inter capitalize font-normal text-white text-center w-full">
                    Minutes</p>
            </div>
        </div>
        <h3 class="font-manrope font-semibold text-2xl sm:text-3xl lg:text-4xl text-white">:</h3>
        <div class="timer">
            <div
                class="rounded-xl border border-white py-1.5 min-w-[60px] sm:min-w-[80px] lg:min-w-[100px] flex items-center justify-center flex-col gap-0 aspect-square px-1.5">
                <h3
                    class="countdown-element seconds font-manrope font-semibold text-5xl sm:text-6xl lg:text-8xl text-white text-center">
                    00</h3>
                <p
                    class="text-xs sm:text-sm lg:text-base font-inter capitalize font-normal text-white text-center w-full">
                    Seconds</p>
            </div>
        </div>
    </div>

    <!-- Countdown Timer Section -->


    <section class="text-gray-600 body-font bg-gradient-to-r from-gray-100 to-indigo-50">
        @foreach ($eventos as $evento)
            <div class="container mx-auto py-16 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col lg:flex-row items-center">
                    <!-- Imagen del evento (lado izquierdo en pantallas grandes) -->
                    <div class="w-full lg:w-1/2 mb-10 lg:mb-0 lg:pr-10">
                        <div class="relative overflow-hidden rounded-lg shadow-xl">
                            <img src="{{ url('storage', $evento->imagen_catalogo) }}" alt="Imagen del evento"
                                class="w-full h-auto object-cover transform hover:scale-105 transition-transform duration-500 ease-in-out">
                            <div
                                class="absolute inset-0 bg-black opacity-0 hover:opacity-25 transition-opacity duration-300">
                            </div>
                        </div>
                    </div>

                    <!-- Detalles del evento -->
                    <div class="w-full lg:w-1/2 lg:pl-10">
                        <h1 class="text-4xl font-extrabold mb-6 text-gray-900 leading-tight">
                            {{ $evento->nombre_evento }}</h1>
                        <p class="text-xl mb-6 text-gray-600 leading-relaxed">{{ $evento->descripcion_breve }}</p>

                        <!-- Organizadores -->
                        <div class="mb-6">
                            <h2 class="text-2xl font-semibold text-gray-700 mb-3">Organizadores:</h2>
                            <ul class="space-y-2">
                                @foreach ($evento->organizadores as $organizador)
                                    <li class="flex items-center text-gray-600">
                                        <svg class="w-5 h-5 mr-2 text-[#00dffd]" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $organizador->nombre }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Fechas -->
                        <div class="mb-8">
                            <h2 class="text-2xl font-semibold text-gray-700 mb-3">Fechas:</h2>
                            <p class="flex items-center text-lg text-gray-600">
                                <svg class="w-6 h-6 mr-2 text-[#00dffd]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d/m/Y') }} -
                                {{ \Carbon\Carbon::parse($evento->fecha_fin)->format('d/m/Y') }}
                            </p>
                        </div>

                        <!-- Botón de inscripción -->
                        <a href="#"
                            class="inline-block bg-[#1d4570] text-white text-lg font-semibold py-3 px-8 rounded-full hover:bg-[#00dffd] transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-[#00dffd] focus:ring-opacity-50">
                            Inscríbete ahora
                        </a>
                    </div>
                </div>

                <!-- Ponentes y temas -->
                {{-- <section class="mt-20">
                    <div class="container px-5 py-24 mx-auto">
                        <div class="text-center mb-20">
                            <h2 class="text-xs text-[#00dffd] tracking-widest font-medium title-font mb-1">EXPLORA
                                NUESTROS</h2>
                            <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900 mb-4">Temas del Evento
                            </h1>
                            <p class="text-base leading-relaxed xl:w-2/4 lg:w-3/4 mx-auto text-gray-500">
                                Descubre los fascinantes temas que abordaremos en nuestro evento. Desde tecnologías
                                emergentes hasta tendencias innovadoras,
                                nuestros expertos te guiarán a través de los avances más recientes en el mundo de la
                                tecnología.
                            </p>
                            <div class="flex mt-6 justify-center">
                                <div class="w-16 h-1 rounded-full bg-[#00dffd] inline-flex"></div>
                            </div>
                        </div>

                        <div class="flex flex-wrap justify-center -m-4">
                            @foreach ($evento->temas as $tema)
                                <div class="p-4 md:w-1/2 lg:w-1/3">
                                    <div
                                        class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                                        <img class="lg:h-48 md:h-36 w-full object-cover object-center"
                                            src="{{ url('storage', $tema->imagen) }}"
                                            alt="{{ $tema->nombre_tema }}">
                                        <div class="p-6">
                                            <h2
                                                class="tracking-widest text-xs title-font font-medium text-[#00dffd] mb-1">
                                                {{ $tema->subtitulo_tema }}</h2>
                                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">
                                                {{ $tema->nombre_tema }}</h1>
                                            <p class="leading-relaxed mb-3 line-clamp-3">{{ $tema->descripcion_tema }}
                                            </p>
                                            <div class="flex items-center flex-wrap">
                                                <span class="text-[#1d4570] inline-flex items-center md:mb-2 lg:mb-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-4 h-4 mr-1">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    {{ \Carbon\Carbon::parse($tema->hora_inicio)->format('H:i') }} -
                                                    {{ \Carbon\Carbon::parse($tema->hora_fin)->format('H:i') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Ponentes -->
                        <div class="mt-20">
                            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Nuestros Ponentes</h2>
                            <div class="flex flex-wrap justify-center -mx-4">
                                @foreach ($evento->temas as $tema)
                                    @foreach ($tema->ponentes as $ponente)
                                        <div class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 px-4 mb-8">
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
                                                    <h4 class="text-xl font-semibold text-gray-800 mb-2">
                                                        {{ $ponente->nombre }} {{ $ponente->apellidos }}</h4>
                                                    <p class="text-sm font-medium text-[#00dffd] mb-2">
                                                        {{ $ponente->institucion }}</p>
                                                    <p class="text-gray-600 text-sm leading-relaxed line-clamp-3 mb-4">
                                                        {{ $ponente->biografia_breve }}</p>
                                                    <button
                                                        class="text-[#1d4570] hover:text-[#00dffd] text-sm font-medium focus:outline-none focus:underline transition duration-300"
                                                        onclick="toggleBio(this, '{{ $ponente->id }}')">
                                                        Leer más
                                                    </button>
                                                    <p id="bio-{{ $ponente->id }}"
                                                        class="hidden text-gray-600 text-sm leading-relaxed mt-2">
                                                        {{ $ponente->biografia_completa }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section> --}}
            </div>
        @endforeach
    </section>





    <!-- Historia Section -->

    <!-- Contact -->
    {{-- <div class="bg-gradient-to-r from-[#001f54] to-[#4b6587]">
        <div class="max-w-5xl px-4 xl:px-0 py-10 lg:py-20 mx-auto">
            <!-- Title -->
            <div class="max-w-3xl mb-10 lg:mb-14">
                <h2 class="text-white font-semibold text-2xl md:text-4xl md:leading-tight">Contáctanos</h2>
                <p class="mt-1 text-gray-300">Cualquiera que sea tu objetivo - te ayudaremos a alcanzarlo.</p>
            </div>
            <!-- End Title -->

            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 lg:gap-x-16">
                <div class="md:order-2 border-b border-gray-700 pb-10 mb-10 md:border-b-0 md:pb-0 md:mb-0">
                    <form>
                        <div class="space-y-4">
                            <!-- Input -->
                            <div class="relative">
                                <input type="text" id="hs-tac-input-name"
                                    class="peer p-4 block w-full bg-gray-800 border-transparent rounded-lg text-sm text-white placeholder:text-transparent focus:outline-none focus:ring-2 focus:ring-[#00dffd] focus:border-transparent disabled:opacity-50 disabled:pointer-events-none
                focus:pt-6
                focus:pb-2
                [&:not(:placeholder-shown)]:pt-6
                [&:not(:placeholder-shown)]:pb-2
                autofill:pt-6
                autofill:pb-2"
                                    placeholder="Nombre">
                                <label for="hs-tac-input-name"
                                    class="absolute top-0 start-0 p-4 h-full text-gray-400 text-sm truncate pointer-events-none transition ease-in-out duration-300 border border-transparent peer-disabled:opacity-50 peer-disabled:pointer-events-none
                  peer-focus:text-xs
                  peer-focus:-translate-y-1.5
                  peer-focus:text-[#00dffd]
                  peer-[:not(:placeholder-shown)]:text-xs
                  peer-[:not(:placeholder-shown)]:-translate-y-1.5
                  peer-[:not(:placeholder-shown)]:text-[#00dffd]">Nombre</label>
                            </div>
                            <!-- End Input -->

                            <!-- Input -->
                            <div class="relative">
                                <input type="email" id="hs-tac-input-email"
                                    class="peer p-4 block w-full bg-gray-800 border-transparent rounded-lg text-sm text-white placeholder:text-transparent focus:outline-none focus:ring-2 focus:ring-[#00dffd] focus:border-transparent disabled:opacity-50 disabled:pointer-events-none
                focus:pt-6
                focus:pb-2
                [&:not(:placeholder-shown)]:pt-6
                [&:not(:placeholder-shown)]:pb-2
                autofill:pt-6
                autofill:pb-2"
                                    placeholder="Email">
                                <label for="hs-tac-input-email"
                                    class="absolute top-0 start-0 p-4 h-full text-gray-400 text-sm truncate pointer-events-none transition ease-in-out duration-300 border border-transparent peer-disabled:opacity-50 peer-disabled:pointer-events-none
                  peer-focus:text-xs
                  peer-focus:-translate-y-1.5
                  peer-focus:text-[#00dffd]
                  peer-[:not(:placeholder-shown)]:text-xs
                  peer-[:not(:placeholder-shown)]:-translate-y-1.5
                  peer-[:not(:placeholder-shown)]:text-[#00dffd]">Email</label>
                            </div>
                            <!-- End Input -->

                            <!-- Input -->
                            <div class="relative">
                                <input type="text" id="hs-tac-input-company"
                                    class="peer p-4 block w-full bg-gray-800 border-transparent rounded-lg text-sm text-white placeholder:text-transparent focus:outline-none focus:ring-2 focus:ring-[#00dffd] focus:border-transparent disabled:opacity-50 disabled:pointer-events-none
                focus:pt-6
                focus:pb-2
                [&:not(:placeholder-shown)]:pt-6
                [&:not(:placeholder-shown)]:pb-2
                autofill:pt-6
                autofill:pb-2"
                                    placeholder="Empresa">
                                <label for="hs-tac-input-company"
                                    class="absolute top-0 start-0 p-4 h-full text-gray-400 text-sm truncate pointer-events-none transition ease-in-out duration-300 border border-transparent peer-disabled:opacity-50 peer-disabled:pointer-events-none
                  peer-focus:text-xs
                  peer-focus:-translate-y-1.5
                  peer-focus:text-[#00dffd]
                  peer-[:not(:placeholder-shown)]:text-xs
                  peer-[:not(:placeholder-shown)]:-translate-y-1.5
                  peer-[:not(:placeholder-shown)]:text-[#00dffd]">Empresa</label>
                            </div>
                            <!-- End Input -->

                            <!-- Input -->
                            <div class="relative">
                                <input type="text" id="hs-tac-input-phone"
                                    class="peer p-4 block w-full bg-gray-800 border-transparent rounded-lg text-sm text-white placeholder:text-transparent focus:outline-none focus:ring-2 focus:ring-[#00dffd] focus:border-transparent disabled:opacity-50 disabled:pointer-events-none
                focus:pt-6
                focus:pb-2
                [&:not(:placeholder-shown)]:pt-6
                [&:not(:placeholder-shown)]:pb-2
                autofill:pt-6
                autofill:pb-2"
                                    placeholder="Teléfono">
                                <label for="hs-tac-input-phone"
                                    class="absolute top-0 start-0 p-4 h-full text-gray-400 text-sm truncate pointer-events-none transition ease-in-out duration-300 border border-transparent peer-disabled:opacity-50 peer-disabled:pointer-events-none
                  peer-focus:text-xs
                  peer-focus:-translate-y-1.5
                  peer-focus:text-[#00dffd]
                  peer-[:not(:placeholder-shown)]:text-xs
                  peer-[:not(:placeholder-shown)]:-translate-y-1.5
                  peer-[:not(:placeholder-shown)]:text-[#00dffd]">Teléfono</label>
                            </div>
                            <!-- End Input -->

                            <!-- Textarea -->
                            <div class="relative">
                                <textarea id="hs-tac-message"
                                    class="peer p-4 block w-full bg-gray-800 border-transparent rounded-lg text-sm text-white placeholder:text-transparent focus:outline-none focus:ring-2 focus:ring-[#00dffd] focus:border-transparent disabled:opacity-50 disabled:pointer-events-none
                focus:pt-6
                focus:pb-2
                [&:not(:placeholder-shown)]:pt-6
                [&:not(:placeholder-shown)]:pb-2
                autofill:pt-6
                autofill:pb-2"
                                    placeholder="Cuéntanos sobre tu proyecto"></textarea>
                                <label for="hs-tac-message"
                                    class="absolute top-0 start-0 p-4 h-full text-gray-400 text-sm truncate pointer-events-none transition ease-in-out duration-300 border border-transparent peer-disabled:opacity-50 peer-disabled:pointer-events-none
                  peer-focus:text-xs
                  peer-focus:-translate-y-1.5
                  peer-focus:text-[#00dffd]
                  peer-[:not(:placeholder-shown)]:text-xs
                  peer-[:not(:placeholder-shown)]:-translate-y-1.5
                  peer-[:not(:placeholder-shown)]:text-[#00dffd]">Cuéntanos
                                    sobre tu proyecto</label>
                            </div>
                            <!-- End Textarea -->
                        </div>

                        <div class="mt-2">
                            <p class="text-xs text-gray-400">
                                Todos los campos son obligatorios
                            </p>

                            <p class="mt-5">
                                <a class="group inline-flex items-center gap-x-2 py-2 px-3 bg-[#00dffd] font-medium text-sm text-[#1d4570] rounded-full transition duration-300 ease-in-out hover:bg-[#1d4570] hover:text-[#00dffd] focus:outline-none focus:ring-2 focus:ring-[#00dffd] focus:ring-offset-2 focus:ring-offset-gray-900"
                                    href="#">
                                    Enviar
                                    <svg class="shrink-0 size-4 transition duration-300 ease-in-out group-hover:translate-x-1"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14" />
                                        <path d="m12 5 7 7-7 7" />
                                    </svg>
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
                <!-- End Col -->

                <div class="space-y-14">
                    <!-- Item -->
                    <div class="flex gap-x-5">
                        <svg class="shrink-0 size-6 text-[#00dffd]" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        <div class="grow">
                            <h4 class="text-white font-semibold">Nuestra dirección:</h4>

                            <address class="mt-1 text-gray-300 text-sm not-italic">
                                300 Bath Street, Tay House<br>
                                Glasgow G2 4JR, United Kingdom
                            </address>
                        </div>
                    </div>
                    <!-- End Item -->

                    <!-- Item -->
                    <div class="flex gap-x-5">
                        <svg class="shrink-0 size-6 text-[#00dffd]" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M21.2 8.4c.5.38.8.97.8 1.6v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V10a2 2 0 0 1 .8-1.6l8-6a2 2 0 0 1 2.4 0l8 6Z" />
                            <path d="m22 10-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 10" />
                        </svg>
                        <div class="grow">
                            <h4 class="text-white font-semibold">Envíanos un email:</h4>

                            <a class="mt-1 text-gray-300 text-sm hover:text-[#00dffd] transition duration-300 ease-in-out focus:outline-none focus:text-[#00dffd]"
                                href="mailto:hello@example.so" target="_blank">
                                hello@example.so
                            </a>
                        </div>
                    </div>
                    <!-- End Item -->

                    <!-- Item -->
                    <div class="flex gap-x-5">
                        <svg class="shrink-0 size-6 text-[#00dffd]" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m3 11 18-5v12L3 14v-3z" />
                            <path d="M11.6 16.8a3 3 0 1 1-5.8-1.6" />
                        </svg>
                        <div class="grow">
                            <h4 class="text-white font-semibold">Estamos contratando</h4>
                            <p class="mt-1 text-gray-300">Nos complace anunciar que estamos expandiendo nuestro equipo
                                y buscamos personas talentosas como tú para unirse a nosotros.</p>
                            <p class="mt-2">
                                <a class="group inline-flex items-center gap-x-2 font-medium text-sm text-[#00dffd] decoration-2 hover:underline focus:outline-none focus:underline transition duration-300 ease-in-out"
                                    href="#">
                                    Ofertas de trabajo
                                    <svg class="shrink-0 size-4 transition duration-300 ease-in-out group-hover:translate-x-1"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14" />
                                        <path d="m12 5 7 7-7 7" />
                                    </svg>
                                </a>
                            </p>
                        </div>
                    </div>
                    <!-- End Item -->
                </div>
                <!-- End Col -->
            </div>
            <!-- End Grid -->
        </div>
    </div> --}}
    <!-- End Contact -->
</div>
<script src="https://cdn.jsdelivr.net"></script>

<script>
    // Obtenemos la fecha del evento pasado desde Laravel (formato ISO 8601)
    let eventDate = new Date("{{ $fechaInicioEvento }}").getTime();

    // Creamos el temporizador
    let countdownInterval = setInterval(function() {
        let now = new Date().getTime();
        let timeRemaining = eventDate - now;

        if (timeRemaining <= 0) {
            clearInterval(countdownInterval);
            document.querySelector('.days').textContent = "00";
            document.querySelector('.hours').textContent = "00";
            document.querySelector('.minutes').textContent = "00";
            document.querySelector('.seconds').textContent = "00";
            return;
        }

        // Calcular días, horas, minutos y segundos restantes
        let days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
        let hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

        // Formatear con ceros a la izquierda
        days = ("0" + days).slice(-2);
        hours = ("0" + hours).slice(-2);
        minutes = ("0" + minutes).slice(-2);
        seconds = ("0" + seconds).slice(-2);

        // Actualizar el DOM con los valores calculados
        document.querySelector('.days').textContent = days;
        document.querySelector('.hours').textContent = hours;
        document.querySelector('.minutes').textContent = minutes;
        document.querySelector('.seconds').textContent = seconds;
    }, 1000);
    const swiper = new Swiper('.swiper', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,
        autoplay: {
            delay: 5000,
        },
        pagination: {
            el: '.swiper-pagination',
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        draggable: true,
    });

    function toggleBio(button, ponenteId) {
        const bioElement = document.getElementById(`bio-${ponenteId}`);
        if (bioElement.classList.contains('hidden')) {
            bioElement.classList.remove('hidden');
            button.textContent = 'Leer menos';
        } else {
            bioElement.classList.add('hidden');
            button.textContent = 'Leer más';
        }
    }
    (function() {
        function textareaAutoHeight(el, offsetTop = 0) {
            el.style.height = 'auto';
            el.style.height = `${el.scrollHeight + offsetTop}px`;
        }

        (function() {
            const textareas = [
                '#hs-tac-message'
            ];

            textareas.forEach((el) => {
                const textarea = document.querySelector(el);
                const overlay = textarea.closest('.hs-overlay');

                if (overlay) {
                    const {
                        element
                    } = HSOverlay.getInstance(overlay, true);

                    element.on('open', () => textareaAutoHeight(textarea, 3));
                } else textareaAutoHeight(textarea, 3);

                textarea.addEventListener('input', () => {
                    textareaAutoHeight(textarea, 3);
                });
            });
        })();
    })()
</script>
