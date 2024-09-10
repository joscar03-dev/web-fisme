<div class="">

    <!-- SVG Background -->
    <div class="relative overflow-hidden">

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
                <div x-data="{ currentIndex: 0 }" x-init="setInterval(() => currentIndex = (currentIndex + 1) % {{ $eventos->count() ?: 0 }}, 5000)"
                    class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:pb-28 xl:pb-32 min-h-screen flex items-center">

                    @forelse ($eventos as $index => $evento)
                        <div x-show="currentIndex === {{ $index }}"
                            x-transition:enter="transition ease-out duration-700"
                            x-transition:enter-start="opacity-0 transform translate-x-full"
                            x-transition:enter-end="opacity-100 transform translate-x-0"
                            x-transition:leave="transition ease-in duration-500"
                            x-transition:leave-start="opacity-100 transform translate-x-0"
                            x-transition:leave-end="opacity-0 transform -translate-x-full"
                            class="absolute inset-0 flex items-center">

                            <div
                                class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                                <div
                                    class="sm:text-center lg:text-left backdrop-filter backdrop-blur-md bg-white/30 rounded-lg p-6">
                                    @if ($evento['fecha_inicio'])
                                        <h2 class="text-base text-gray-800 font-semibold tracking-wide uppercase">
                                            {{ $evento['fecha_inicio'] }}
                                        </h2>
                                    @endif
                                    <h1
                                        class="text-4xl tracking-tight font-extrabold text-[#001f54e6] sm:text-5xl md:text-6xl">
                                        <span class="block xl:inline">{{ $evento['nombre_evento'] }}</span>
                                    </h1>
                                    <p
                                        class="mt-3 text-base text-gray-600 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                                        {{ Str::limit($evento['descripcion_breve'], 150) }}
                                    </p>
                                    <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">

                                        <div class="mt-3 sm:mt-0 sm:ml-3">
                                            <a href="{{ route('lector.asistencias') }}"
                                                class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-[#001f54e6] hover:bg-blue-500 md:py-4 md:text-lg md:px-10 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                                                Inscríbete ahora
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Foreground Image (Tori) -->
                            <div class="absolute top-0 right-0 z-20 transition-opacity duration-700 ease-in-out"
                                x-show="currentIndex === {{ $index }}"
                                x-transition:enter="opacity-0 transform scale-90"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-90">
                                <img src="{{ asset('images/tori.svg') }}" alt="Tori" class="w-1/2 h-auto"
                                    style="max-width: 400px;" />
                            </div>

                        </div>
                    @empty
                        <div class="absolute inset-0 flex items-center justify-center">
                            <p class="text-2xl text-gray-600">No hay eventos disponibles en este momento.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <!-- Countdown Timer Section -->

    <div class="flex items-center justify-center w-full gap-1.5 count-down-main px-3 py-6 bg-[#133E6B]">
        <div class="timer">
            <div
                class="rounded-xl border border-white py-1.5 min-w-[80px] flex items-center justify-center flex-col gap-0 aspect-square px-1.5">
                <h3 class="countdown-element days font-manrope font-semibold text-8xl text-white text-center">00
                </h3>
                <p class="text-sm font-inter capitalize font-normal text-white text-center w-full">Days</p>
            </div>
        </div>
        <h3 class="font-manrope font-semibold text-4xl text-white">:</h3>
        <div class="timer">
            <div
                class="rounded-xl border border-white py-1.5 min-w-[80px] flex items-center justify-center flex-col gap-0 aspect-square px-1.5">
                <h3 class="countdown-element hours font-manrope font-semibold text-8xl text-white text-center">00
                </h3>
                <p class="text-sm font-inter capitalize font-normal text-white text-center w-full">Hour</p>
            </div>
        </div>
        <h3 class="font-manrope font-semibold text-4xl text-white">:</h3>
        <div class="timer">
            <div
                class="rounded-xl border border-white py-1.5 min-w-[80px] flex items-center justify-center flex-col gap-0 aspect-square px-1.5">
                <h3 class="countdown-element minutes font-manrope font-semibold text-8xl text-white text-center">00
                </h3>
                <p class="text-sm font-inter capitalize font-normal text-white text-center w-full">Minutes</p>
            </div>
        </div>
        <h3 class="font-manrope font-semibold text-4xl text-white">:</h3>
        <div class="timer">
            <div
                class="rounded-xl border border-white py-1.5 min-w-[80px] flex items-center justify-center flex-col gap-0 aspect-square px-1.5">
                <h3 class="countdown-element seconds font-manrope font-semibold text-8xl text-white text-center">00
                </h3>
                <p class="text-sm font-inter capitalize font-normal text-white text-center w-full">Seconds</p>
            </div>
        </div>
    </div>
    <!-- Countdown Timer Section -->



    <!-- Historia Section -->

    @livewire('partials.historia')
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            @foreach ($eventos as $evento)
                <div class="mb-16">
                    <div class="text-center mb-4">
                        <h1 class="text-5xl font-bold title-font text-gray-900 mb-2">{{ $evento['nombre_evento'] }}
                        </h1>
                        <div class="border-b-2 border-gray-300 w-1/4 mx-auto mb-4"></div>
                        <!-- Línea debajo del título -->
                        <p class="leading-relaxed text-lg text-gray-600">{{ $evento['descripcion_breve'] }}</p>
                    </div>

                    <!-- Imagen del evento con desenfoque -->
                    <div class="relative mx-auto max-w-4xl">
                        <img src="{{ url('storage', $evento['imagen_catalogo']) }}" alt="Imagen del evento"
                            class="w-full h-96 md:h-80 lg:h-96 max-h-[400px] object-cover mb-6 rounded-lg shadow-md blur-sm">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <img src="{{ url('storage', $evento['imagen_catalogo']) }}" alt="Imagen del evento"
                                class="w-1/2 h-auto object-cover rounded-lg shadow-md">
                        </div>
                    </div>

                    <div class="flex flex-wrap -m-4">
                        @foreach ($evento['temas'] as $tema)
                            <div class="p-4 md:w-1/2 w-full">
                                <div class="h-full bg-gray-100 p-8 rounded-lg shadow">
                                    <h2 class="text-2xl font-bold mb-2 text-gray-800">{{ $tema['nombre_tema'] }}</h2>
                                    <p class="leading-relaxed mb-6 text-gray-600">{{ $tema['descripcion_tema'] }}</p>
                                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Ponentes:</h3>
                                    <div class="flex flex-wrap -m-2">
                                        @foreach ($tema['ponentes'] as $ponente)
                                            <div class="p-2 w-1/2">
                                                <div class="flex items-center bg-white p-4 rounded-lg shadow">
                                                    <img alt="ponente"
                                                        src="{{ url('storage', $ponente['logo_pais']) }}"
                                                        class="w-12 h-12 rounded-full flex-shrink-0 object-cover object-center">
                                                    <div class="flex-grow flex flex-col pl-4">
                                                        <span
                                                            class="title-font font-medium text-gray-900">{{ $ponente['nombre'] }}
                                                            {{ $ponente['apellidos'] }}</span>
                                                        <span
                                                            class="text-gray-500 text-sm">{{ $ponente['especialidad'] }}</span>
                                                        <p class="text-gray-500 text-xs">
                                                            {{ $ponente['biografia_breve'] }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    @livewire('partials.testimonios')


</div>
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
</script>
