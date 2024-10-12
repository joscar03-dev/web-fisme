<div class="">
    <!-- SVG Background -->
    <div class="relative overflow-hidden mb-2 sm:mb-2 lg:mb-22">
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
            <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Componente de Carrusel con Interacción y Transiciones -->
                <div x-data="{ currentIndex: 0, isMobile: window.innerWidth < 768 }" x-init="setInterval(() => currentIndex = (currentIndex + 1) % {{ $eventos->count() ?: 0 }}, 8000);
                window.addEventListener('resize', () => isMobile = window.innerWidth < 768);"
                    class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:pb-28 xl:pb-32 min-h-[80vh] lg:min-h-screen flex items-center">

                    @forelse ($eventos as $index => $evento)
                        <div x-show="currentIndex === {{ $index }}"
                            x-transition:enter="transition ease-out duration-700"
                            x-transition:enter-start="opacity-0 transform translate-x-full"
                            x-transition:enter-end="opacity-100 transform translate-x-0"
                            x-transition:leave="transition ease-in duration-500"
                            x-transition:leave-start="opacity-100 transform translate-x-0"
                            x-transition:leave-end="opacity-0 transform -translate-x-full"
                            class="absolute inset-0 w-full h-full">

                            <div class="flex flex-col lg:flex-row items-stretch h-full">
                                <!-- Imagen (ahora arriba en móviles, a la derecha en desktop) -->
                                <div class="w-full lg:w-1/2 flex items-center justify-center order-1 lg:order-2 h-full">
                                    <div class="relative w-full h-full overflow-hidden rounded-lg shadow-2xl">
                                        <img src="{{ asset('storage/' . $evento['imagen_catalogo']) }}"
                                            alt="Imagen del evento"
                                            class="absolute inset-0 w-full h-full object-cover" />
                                    </div>
                                </div>

                                <!-- Texto (ahora abajo en móviles, a la izquierda en desktop) -->
                                <div class="w-full lg:w-3/5 flex items-center justify-center px-4 order-2 lg:order-1">
                                    <div
                                        class="text-center lg:text-left backdrop-filter backdrop-blur-md bg-white/30 rounded-lg p-4 sm:p-6 w-full">
                                        @if ($evento['fecha_inicio'])
                                            <h2
                                                class="text-xs sm:text-sm text-gray-800 font-semibold tracking-wide uppercase">
                                                {{ $evento['fecha_inicio'] }}
                                            </h2>
                                        @endif
                                        <h1
                                            class="text-lg sm:text-xl md:text-2xl lg:text-3xl xl:text-4xl font-extrabold text-[#001f54e6] mt-2">
                                            <span class="block">{{ $evento['nombre_evento'] }}</span>
                                        </h1>
                                        <p class="mt-2 sm:mt-3 text-xs sm:text-sm md:text-base text-gray-600">
                                            {{ Str::limit($evento['descripcion_breve'], 100) }}
                                        </p>
                                        <div class="mt-4 sm:mt-5">
                                            <a wire:key="{{ $evento->slug }}"
                                                href="{{ route('evento.detalle', $evento->slug) }}"
                                                class="inline-flex items-center justify-center px-4 sm:px-6 py-2 sm:py-3 border border-transparent text-sm md:text-base font-medium rounded-md text-white bg-[#001f54e6] hover:bg-blue-500 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                                                Inscríbete ahora
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="absolute inset-0 flex items-center justify-center">
                            <p class="text-lg sm:text-xl text-gray-600">No hay eventos disponibles en este momento.</p>
                        </div>
                    @endforelse

                    <!-- Botones de control -->
                    <button
                        @click="currentIndex = (currentIndex - 1 + {{ $eventos->count() }}) % {{ $eventos->count() }}"
                        class="absolute left-2 top-1/2 transform -translate-y-1/2 z-10 p-2 text-white bg-[#001f54e6] hover:bg-blue-500 rounded-full">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            class="w-4 h-4 sm:w-5 sm:h-5">
                            <path d="M15 18L9 12L15 6" />
                        </svg>
                    </button>

                    <button @click="currentIndex = (currentIndex + 1) % {{ $eventos->count() }}"
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 z-10 p-2 text-white bg-[#001f54e6] hover:bg-blue-500 rounded-full">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            class="w-4 h-4 sm:w-5 sm:h-5">
                            <path d="M9 18L15 12L9 6" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Countdown Timer Section -->

    </div>
    <div
        class="flex items-center justify-center w-full gap-1 sm:gap-1.5 count-down-main px-2 sm:px-3 py- sm:py-6 bg-[#133E6B] flex-wrap lg:flex-nowrap">
        <div class="timer">
            <div
                class="rounded-xl border border-white py-1 sm:py-1.5 min-w-[50px] sm:min-w-[60px] md:min-w-[80px] lg:min-w-[100px] flex items-center justify-center flex-col gap-0 aspect-square px-1 sm:px-1.5">
                <h3
                    class="countdown-element days font-manrope font-semibold text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-8xl text-white text-center">
                    00
                </h3>
                <p
                    class="text-xs sm:text-sm lg:text-base font-inter capitalize font-normal text-white text-center w-full">
                    Days
                </p>
            </div>
        </div>
        <h3 class="font-manrope font-semibold text-xl sm:text-2xl md:text-3xl lg:text-4xl text-white">:</h3>
        <div class="timer">
            <div
                class="rounded-xl border border-white py-1 sm:py-1.5 min-w-[50px] sm:min-w-[60px] md:min-w-[80px] lg:min-w-[100px] flex items-center justify-center flex-col gap-0 aspect-square px-1 sm:px-1.5">
                <h3
                    class="countdown-element hours font-manrope font-semibold text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-8xl text-white text-center">
                    00
                </h3>
                <p
                    class="text-xs sm:text-sm lg:text-base font-inter capitalize font-normal text-white text-center w-full">
                    Hours
                </p>
            </div>
        </div>
        <h3 class="font-manrope font-semibold text-xl sm:text-2xl md:text-3xl lg:text-4xl text-white">:</h3>
        <div class="timer">
            <div
                class="rounded-xl border border-white py-1 sm:py-1.5 min-w-[50px] sm:min-w-[60px] md:min-w-[80px] lg:min-w-[100px] flex items-center justify-center flex-col gap-0 aspect-square px-1 sm:px-1.5">
                <h3
                    class="countdown-element minutes font-manrope font-semibold text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-8xl text-white text-center">
                    00
                </h3>
                <p
                    class="text-xs sm:text-sm lg:text-base font-inter capitalize font-normal text-white text-center w-full">
                    Minutes
                </p>
            </div>
        </div>
        <h3 class="font-manrope font-semibold text-xl sm:text-2xl md:text-3xl lg:text-4xl text-white">:</h3>
        <div class="timer">
            <div
                class="rounded-xl border border-white py-1 sm:py-1.5 min-w-[50px] sm:min-w-[60px] md:min-w-[80px] lg:min-w-[100px] flex items-center justify-center flex-col gap-0 aspect-square px-1 sm:px-1.5">
                <h3
                    class="countdown-element seconds font-manrope font-semibold text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-8xl text-white text-center">
                    00
                </h3>
                <p
                    class="text-xs sm:text-sm lg:text-base font-inter capitalize font-normal text-white text-center w-full">
                    Seconds
                </p>
            </div>
        </div>
    </div>
    <!-- Countdown Timer Section -->
    <!-- Seccion Concurso -->

    <div class="text-gray-600">
        <div class="relative overflow-hidden">
            <!-- Video de fondo -->
            <div class="absolute inset-0 w-full h-full">
                <video id="background-video" autoplay loop muted playsinline class="w-full h-full object-cover">
                    <source src="{{ asset('videos/video_1080.mp4') }}">
                    Tu navegador no soporta el tag de video.
                </video>
                <!-- Capa de superposición para oscurecer ligeramente el video -->
                <div class="absolute inset-0 bg-black opacity-30"></div>
            </div>

            <!-- Contenido del concurso -->
            @foreach ($concursos as $concurso)
                <div class="relative z-10 max-w-4xl mx-auto px-4 py-16 sm:px-6 lg:px-8">
                    <div class="bg-white bg-opacity-60 backdrop-filter backdrop-blur-md rounded-lg shadow-xl p-8">
                        <h2 class="text-4xl font-extrabold text-center mb-8 text-[#001f54e6]">{{ $concurso->nombre }}
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div class="flex items-center">
                                <x-heroicon-o-calendar class="h-6 w-6 text-[#001f54e6] mr-2" />
                                <span class="text-[#001f54e6] font-semibold">
                                    Inicio:
                                    {{ \Carbon\Carbon::parse($concurso->fecha_inicio)->translatedFormat('j \d\e F, Y') }}
                                </span>
                            </div>
                            <div class="flex items-center">
                                <x-heroicon-o-calendar class="h-6 w-6 text-[#001f54e6] mr-2" />
                                <span class="text-[#001f54e6] font-semibold">Fin:
                                    {{ \Carbon\Carbon::parse($concurso->fecha_fin)->translatedFormat('j \d\e F, Y') }}</span>
                            </div>
                        </div>
                        @foreach ($concurso->precios as $precio)
                            <div
                                class="flex items-center justify-center bg-[#001f54e6] text-white rounded-full py-3 px-6 font-bold text-xl mb-8 transform hover:scale-105 transition-transform duration-300">

                                <span>Inscripción: S/. {{ $precio->precio }}</span>
                            </div>
                        @endforeach



                        <h3 class="text-lg font-semibold mb-4 text-[#001f54e6]">Documentos del concurso:</h3>

                        <ul class="space-y-3 mb-8">
                            <!-- Enlace para Bases del concurso -->
                            @foreach ($concurso->documentosConcursos as $documento)
                                <li>
                                    <a href="{{ asset('documents/EP2-JOSUE DAVID CAYOTOPA TAMAY.pdf') }}" download
                                        class="flex items-center text-[#001f54e6] hover:text-gray-800 transition-colors duration-200">
                                        <x-heroicon-o-document-arrow-down class="h-5 w-5 mr-2" />
                                        <span class="font-medium">{{ $documento->tipoDocumento->nombre }}</span>
                                    </a>
                                </li>
                            @endforeach


                            <!-- Enlace para Formato de presentación -->

                        </ul>

                        <div class="text-center">
                            <a wire:click="inscribirse" href="{{ route('inscripcion-concursos', $concurso->slug) }}"
                                class="bg-[#001f54e6] text-white font-bold py-3 px-8 rounded-full text-xl transition-all duration-300 hover:bg-[#001f54] hover:shadow-lg transform hover:scale-105">
                                ¡Inscríbete Ahora!
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <!-- Historia Section -->

    <!-- Contact -->
    {{-- <div class="bg-gradient-to-r from-[#001f54] to-[#4b6587]">
        <div class="max-w-5xl px-4 xl:px-0 py-10 lg:py-20 mx-auto">
            <!-- Title -->
            <div class="max-w-3xl mb-10 lg:mb-14">
                <h2 class="text-white font-semibold text-2xl md:text-4xl md:leading-tight">Contáctanos</h2>
                <p class="mt-1 text-gray-300">Facultad de Ingeniería de Sistemas y Mecánica Eléctrica - UNTRM</p>
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
                                    sobre ti</label>
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
                                Jr. Libertad 1300<br>
                                , Bagua 01721
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
                                href="mailto:centpro.fisme@untrm.edu.pe" target="_blank">
                                centpro.fisme@untrm.edu.pe
                            </a>
                        </div>
                    </div>
                    <!-- End Item -->
                </div>
                <!-- End Col -->
            </div>
            <!-- End Grid -->
        </div>
    </div> --}}

    @livewire('contact-form')
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
    document.addEventListener('DOMContentLoaded', (event) => {
        const video = document.getElementById('background-video');
        if (video) {
            video.play().catch(error => {
                console.error("Error al intentar reproducir el video:", error);
            });
        }
    });
</script>
