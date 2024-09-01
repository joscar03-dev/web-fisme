{{-- <nav class="bg-white shadow-md">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-20">
            <a href="#" class="flex-shrink-0">
                <img class="h-12 w-auto" src="{{ asset('images/logo-small.png') }}" alt="UNTRIM Logo">
            </a>
            <div class="hidden md:flex items-center space-x-6">
                <a href="#" class="text-gray-700 text-lg hover:text-gray-900">Home</a>
                <a href="#" class="text-gray-700 text-lg hover:text-gray-900">Eventos</a>
                <a href="#" class="text-gray-700 text-lg hover:text-gray-900">Contactos</a>
                <div>
                    <form action="#" method="GET" class="relative">
                        <input
                            type="search"
                            name="query"
                            placeholder="Buscar..."
                            class="w-48 pl-10 pr-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                        <button type="submit" class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            <!-- Botón desplegable para móviles -->
            <div class="md:hidden">
                <button class="text-gray-700 focus:outline-none" onclick="toggleMenu()">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>
        <!-- Menú desplegable para móviles -->
        <div id="mobileMenu" class="hidden md:hidden">
            <a href="#" class="block text-gray-700 text-lg hover:text-gray-900 py-2">Home</a>
            <a href="#" class="block text-gray-700 text-lg hover:text-gray-900 py-2">Eventos</a>
            <a href="#" class="block text-gray-700 text-lg hover:text-gray-900 py-2">Contactos</a>
        </div>
    </div>
</nav> --}}


<nav class="bg-white shadow-md">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-20">
            <a href="#" class="flex items-center space-x-3">
                <img class="h-16 w-auto" src="{{ asset('images/logo-small.png') }}" alt="UNTRIM Logo">
                
            </a>
            <div class="hidden md:flex items-center space-x-8">
              {{--  <a href="https://www.untrm.edu.pe/portal/es/" class="flex items-center text-gray-700 text-lg hover:text-gray-900">
                    
                    UNIVERSIDAD
                </a>
                <a href="https://www.untrm.edu.pe/portal/es/admision.html" class="flex items-center text-gray-700 text-lg hover:text-gray-900">
                   
                    ADMISION
                </a>
               
                <a href="https://www.untrm.edu.pe/portal/es/noticias.html" class="flex items-center text-gray-700 text-lg hover:text-gray-900">
                    
                    NOTICIAS
                </a>--}}
                <a href="/" wire:navigate class="flex items-center text-gray-700 text-lg hover:text-gray-900">
                   
                    FISME
                </a>
                <a href="/eventos" wire:navigate class="flex items-center text-gray-700 text-lg hover:text-gray-900">
                   
                    EVENTOS
                </a>
                <a href="/contact" wire:navigate class="flex items-center text-gray-700 text-lg hover:text-gray-900">
                  
                   CONTACTANOS
                </a>
            </div>
            <!-- Formulario de búsqueda -->
            <div class="hidden md:flex">
                <form action="#" method="GET" class="relative">
                    <input
                        type="search"
                        name="query"
                        placeholder="Buscar..."
                        class="w-48 pl-10 pr-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                    <button type="submit" class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </form>
            </div>
            <!-- Botón desplegable para móviles -->
            <div class="md:hidden">
                <button class="text-gray-700 focus:outline-none" onclick="toggleMenu()">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>
        <!-- Menú desplegable para móviles -->
        <div id="mobileMenu" class="hidden md:hidden">
            <a href="#" class="block text-gray-700 text-lg hover:text-gray-900 py-2">UNIVERSIDAD</a>
            <a href="#" class="block text-gray-700 text-lg hover:text-gray-900 py-2">ADMISION</a>
            <a href="#" class="block text-gray-700 text-lg hover:text-gray-900 py-2">FACULTADES</a>
            <a href="#" class="block text-gray-700 text-lg hover:text-gray-900 py-2">NOTICIAS</a>
            <a href="#" class="block text-gray-700 text-lg hover:text-gray-900 py-2">CONTENIDO</a>
            <a href="#" class="block text-gray-700 text-lg hover:text-gray-900 py-2">TRÁMITE</a>
        </div>
    </div>
</nav>

<script>
    function toggleMenu() {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('hidden');
    }
</script>
