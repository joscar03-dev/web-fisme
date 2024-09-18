<nav x-data="{ open: false, activeLink: '{{ request()->path() }}' }" x-init="$watch('activeLink', value => $wire.call('setActiveLink', value))" class="bg-white shadow-sm">
    <div id="loading-bar" class="h-1 bg-[#00dffd] fixed top-0 left-0 z-50" style="width: 0%;"></div>



    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex-shrink-0">
                    <img class="h-12 w-auto" src="{{ asset('images/logo-small.png') }}" alt="UNTRM Logo">
                </a>
            </div>
            <div class="hidden sm:ml-6 sm:flex sm:space-x-8 items-center">
                @foreach (['home' => 'Inicio', 'agenda' => 'Agenda', 'inscripcion' => 'Inscribirte', 'contacto' => 'Contacto'] as $route => $label)
                    <a href="{{ $route === 'home' ? route('home') : ($route === 'contacto' ? route('contacto') : $route) }}"
                        class="relative text-[#1e2c4f] inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors duration-200 ease-in-out"
                        x-on:click.prevent="activeLink = '{{ $route }}'; $wire.call('navigateTo', '{{ $route }}')"
                        :class="{ 'text-[#1d4570] font-semibold': activeLink === '{{ $route }}' }">
                        {{ $label }}
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-[#00dffd] transform scale-x-0 transition-transform duration-200 ease-in-out"
                            :class="{ 'scale-x-100': activeLink === '{{ $route }}' }"></span>
                    </a>
                @endforeach
            </div>

            <!-- Botón de menú para móviles -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button x-on:click="open = !open" type="button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-[#1e2c4f] hover:text-[#1d4570] hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-[#00dffd]"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Abrir menú principal</span>
                    <svg class="h-6 w-6" x-bind:class="{ 'hidden': open, 'block': !open }"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6" x-bind:class="{ 'block': open, 'hidden': !open }"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menú para dispositivos móviles -->
    <div x-show="open" class="sm:hidden" id="mobile-menu">
        <div class="pt-2 pb-3 space-y-1">
            @foreach (['home' => 'Inicio', 'agenda' => 'Agenda', 'inscribirte' => 'Inscribirte', 'contacto' => 'Contacto'] as $route => $label)
                <a href="{{ $route === 'home' ? route('home') : ($route === 'contacto' ? route('contacto') : $route) }}"
                    class="block pl-3 pr-4 py-2 text-base font-medium transition-colors duration-200 ease-in-out"
                    x-on:click.prevent="activeLink = '{{ $route }}'; open = false; $wire.call('navigateTo', '{{ $route }}')"
                    :class="{ 'bg-[#00dffd] text-[#1d4570]': activeLink === '{{ $route }}', 'text-[#1e2c4f] hover:bg-gray-100 hover:text-[#1d4570]': activeLink !== '{{ $route }}' }">
                    {{ $label }}
                </a>
            @endforeach
        </div>
    </div>
</nav>
