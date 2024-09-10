<div class="relative bg-gray-900 overflow-hidden">
    <div class="max-w-7xl mx-auto">
        <div x-data="{ currentIndex: 0 }" x-init="setInterval(() => currentIndex = (currentIndex + 1) % {{ count($eventos) }}, 5000)" class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:w-full lg:pb-28 xl:pb-32">
            @foreach($eventos as $index => $evento)
            <div x-show="currentIndex === {{ $index }}"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-x-full"
                 x-transition:enter-end="opacity-100 transform translate-x-0"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 transform translate-x-0"
                 x-transition:leave-end="opacity-0 transform -translate-x-full"
                 class="absolute inset-0">
                <div class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        @if($evento->fecha_inicio)
                            <h2 class="text-base text-orange-600 font-semibold tracking-wide uppercase">{{ $evento->fecha_inicio->format('d M Y') }}</h2>
                        @endif
                        <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">{{ $evento->nombre_evento }}</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-300 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            {{ Str::limit($evento->descripcion, 150) }}
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="{{ route('evento.detalle', $evento->id) }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 md:py-4 md:text-lg md:px-10 transition duration-150 ease-in-out">
                                    Más información
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="{{ route('event.registration', ['eventoId' => $evento->id]) }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-orange-600 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10 transition duration-150 ease-in-out">
                                    Inscríbete ahora
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
        @foreach($eventos as $index => $evento)
        <img x-show="currentIndex === {{ $index }}"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
             src="{{ asset('storage/' . $evento->imagen_banner) }}"
             alt="{{ $evento->nombre_evento }}">
        @endforeach
    </div>
</div>