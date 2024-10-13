<div>
    <div class="bg-gradient-to-r from-[#001f54] to-[#4b6587]">
        <div class="max-w-5xl px-4 xl:px-0 py-10 lg:py-20 mx-auto">
            <!-- Title -->
            <div class="max-w-3xl mb-10 lg:mb-14">
                <h2 class="text-white font-semibold text-2xl md:text-4xl md:leading-tight">Contáctanos</h2>
                <p class="mt-1 text-gray-300">Facultad de Ingeniería de Sistemas y Mecánica Eléctrica - UNTRM</p>
            </div>
    
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
    
            <!-- Formulario -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 lg:gap-x-16">
                <div class="md:order-2 border-b border-gray-700 pb-10 mb-10 md:border-b-0 md:pb-0 md:mb-0">
                    <form wire:submit.prevent="sendMessage">
                        <div class="space-y-4">
                            <!-- Input Nombre -->
                            <div class="relative">
                                <input type="text" wire:model="name"
                                    class="peer p-4 block w-full bg-gray-800 border-transparent rounded-lg text-sm text-white placeholder:text-transparent focus:outline-none focus:ring-2 focus:ring-[#00dffd] focus:border-transparent"
                                    placeholder="Nombre" required>
                                <label for="name"
                                    class="absolute top-0 start-0 p-4 h-full text-gray-400 text-sm truncate pointer-events-none transition ease-in-out duration-300 peer-focus:text-xs peer-focus:-translate-y-1.5 peer-focus:text-[#00dffd]">Nombre</label>
                            </div>
    
                            <!-- Input Email -->
                            <div class="relative">
                                <input type="email" wire:model="email"
                                    class="peer p-4 block w-full bg-gray-800 border-transparent rounded-lg text-sm text-white placeholder:text-transparent focus:outline-none focus:ring-2 focus:ring-[#00dffd] focus:border-transparent"
                                    placeholder="Email" required>
                                <label for="email"
                                    class="absolute top-0 start-0 p-4 h-full text-gray-400 text-sm truncate pointer-events-none transition ease-in-out duration-300 peer-focus:text-xs peer-focus:-translate-y-1.5 peer-focus:text-[#00dffd]">Email</label>
                            </div>
    
                            <!-- Input Empresa -->
                            <div class="relative">
                                <input type="text" wire:model="company"
                                    class="peer p-4 block w-full bg-gray-800 border-transparent rounded-lg text-sm text-white placeholder:text-transparent focus:outline-none focus:ring-2 focus:ring-[#00dffd] focus:border-transparent"
                                    placeholder="Empresa">
                                <label for="company"
                                    class="absolute top-0 start-0 p-4 h-full text-gray-400 text-sm truncate pointer-events-none transition ease-in-out duration-300 peer-focus:text-xs peer-focus:-translate-y-1.5 peer-focus:text-[#00dffd]">Empresa</label>
                            </div>
    
                            <!-- Input Teléfono -->
                            <div class="relative">
                                <input type="text" wire:model="phone"
                                    class="peer p-4 block w-full bg-gray-800 border-transparent rounded-lg text-sm text-white placeholder:text-transparent focus:outline-none focus:ring-2 focus:ring-[#00dffd] focus:border-transparent"
                                    placeholder="Teléfono">
                                <label for="phone"
                                    class="absolute top-0 start-0 p-4 h-full text-gray-400 text-sm truncate pointer-events-none transition ease-in-out duration-300 peer-focus:text-xs peer-focus:-translate-y-1.5 peer-focus:text-[#00dffd]">Teléfono</label>
                            </div>
    
                            <!-- Textarea Mensaje -->
                            <div class="relative">
                                <textarea wire:model="message"
                                    class="peer p-4 block w-full bg-gray-800 border-transparent rounded-lg text-sm text-white placeholder:text-transparent focus:outline-none focus:ring-2 focus:ring-[#00dffd] focus:border-transparent"
                                    placeholder="Cuéntanos sobre tu proyecto"></textarea>
                                <label for="message"
                                    class="absolute top-0 start-0 p-4 h-full text-gray-400 text-sm truncate pointer-events-none transition ease-in-out duration-300 peer-focus:text-xs peer-focus:-translate-y-1.5 peer-focus:text-[#00dffd]">Tu mensaje es importante para nosotros. Nos pondremos en contacto contigo lo antes posible.</label>
                            </div>
                        </div>
    
                        <div class="mt-2">
                            <p class="text-xs text-gray-400">Todos los campos son obligatorios</p>
                            <p class="mt-5">
                                <button type="submit"
                                    class="group inline-flex items-center gap-x-2 py-2 px-3 bg-[#00dffd] font-medium text-sm text-[#1d4570] rounded-full transition duration-300 ease-in-out hover:bg-[#1d4570] hover:text-[#00dffd] focus:outline-none focus:ring-2 focus:ring-[#00dffd] focus:ring-offset-2 focus:ring-offset-gray-900">
                                    Enviar
                                    <svg class="shrink-0 size-4 transition duration-300 ease-in-out group-hover:translate-x-1"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                        <path d="m12 5 7 7-7 7"></path>
                                    </svg>
                                </button>
                            </p>
                        </div>
                    </form>
                </div>
    
                <!-- Dirección -->
                <div class="space-y-14">
                    <div class="flex gap-x-5">
                        <svg class="shrink-0 size-6 text-[#00dffd]" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <div class="grow">
                            <h4 class="text-white font-semibold">Nuestra dirección:</h4>
                            <address class="mt-1 text-gray-300 text-sm not-italic">Jr. Libertad 1300<br>, Bagua 01721</address>
                        </div>
                    </div>
    
                    <div class="flex gap-x-5">
                        <svg class="shrink-0 size-6 text-[#00dffd]" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21.2 8.4c.5.38.8.97.8 1.6v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V10a2 2 0 0 1 .8-1.6l8-6a2 2 0 0 1 2.4 0l8 6Z"></path>
                            <path d="m22 10-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 10"></path>
                        </svg>
                        <div class="grow">
                            <h4 class="text-white font-semibold">Envíanos un email:</h4>
                            <a class="mt-1 text-gray-300 text-sm hover:text-[#00dffd]" href="mailto:centpro.fisme@untrm.edu.pe" target="_blank">centpro.fisme@untrm.edu.pe</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
