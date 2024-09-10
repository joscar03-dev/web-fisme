<nav x-data="{ open: false, eventosOpen: false }" class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex-shrink-0">
                    <img class="h-12 w-auto" src="{{ asset('images/logo-small.png') }}" alt="UNTRM Logo">
                </a>
            </div>
            <div class="hidden sm:ml-6 sm:flex sm:space-x-8 items-center">
                <a href="{{ route('home') }}" class="text-gray-900 inline-flex items-center px-1 pt-1 text-sm font-medium">
                    Inicio
                </a>
                <div class="relative" x-on:click.away="eventosOpen = false">
                    <button
                        x-on:click="eventosOpen = !eventosOpen"
                        class="text-gray-900 inline-flex items-center px-1 pt-1 text-sm font-medium"
                    >
                        Eventos
                        <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="eventosOpen" class="absolute z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                            <a href="{{ route('eventos') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                Lista de Eventos
                            </a>
                            <a href="{{ route('eventos') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                Próximos Eventos
                            </a>
                        </div>
                    </div>
                </div>
                <a href="agenda" class="text-gray-900 inline-flex items-center px-1 pt-1 text-sm font-medium">
                    Agenda
                </a>
                <a href="#" class="text-gray-900 inline-flex items-center px-1 pt-1 text-sm font-medium">
                    Organizadores
                </a>
                <a href="{{ route('contacto') }}" class="text-gray-900 inline-flex items-center px-1 pt-1 text-sm font-medium">
                    Contacto
                </a>
            </div>
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                <a href="{{ route('inscripcion') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Inscríbete
                </a>
            </div>
            <div class="-mr-2 flex items-center sm:hidden">
                <button x-on:click="open = !open" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" x-bind:class="{ 'hidden': open, 'block': !open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6" x-bind:class="{ 'block': open, 'hidden': !open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" class="sm:hidden" id="mobile-menu">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="bg-indigo-50 border-indigo-500 text-indigo-700 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                Inicio
            </a>
            <a href="{{ route('eventos') }}" class="border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                Eventos
            </a>
            <a href="#" class="border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                Agenda
            </a>
            <a href="#" class="border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                Organizadores
            </a>
            <a href="{{ route('contacto') }}" class="border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800 block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                Contacto
            </a>
        </div>
        <div class="pt-4 pb-3 border-t border-gray-200">
            <div class="mt-3 space-y-1">
                <a href="{{ route('inscripcion') }}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                    Inscríbete
                </a>
            </div>
        </div>
    </div>
</nav>