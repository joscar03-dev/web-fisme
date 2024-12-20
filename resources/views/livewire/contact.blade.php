<section class="text-gray-600 body-font relative">
    <div class="container px-5 py-24 mx-auto flex sm:flex-nowrap flex-wrap">
        <div class="lg:w-2/3 md:w-1/2 bg-gray-200 rounded-lg overflow-hidden sm:mr-10 p-10 flex items-end justify-start relative">
            <iframe width="100%" height="100%" class="absolute inset-0" frameborder="0" title="map" marginheight="0"
                marginwidth="0" scrolling="no"
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3702.8128267027223!2d-78.52438899977633!3d-5.642416642217363!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91b453ff027ba485%3A0xa3fddb478e84b70!2sFacultad%20de%20Ingenier%C3%ADa%20de%20Sistemas%20y%20Mec%C3%A1nica%20El%C3%A9ctrica%20-%20UNTRM!5e0!3m2!1ses!2spe!4v1725121583276!5m2!1ses!2spe"></iframe>
            <div class="bg-white relative flex flex-wrap py-6 rounded shadow-md">
                <div class="lg:w-1/2 px-6">
                    <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs">DIRECCIÓN</h2>
                    <p class="mt-1 text-gray-600">Jr. Libertad 1300, Bagua 01721</p>
                </div>
                <div class="lg:w-1/2 px-6 mt-4 lg:mt-0">
                    <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs">EMAIL</h2>
                    <a class="text-blue-500 leading-relaxed">informes@untrm.edu.pe</a>
                    <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs mt-4">TELÉFONO</h2>
                    <p class="leading-relaxed text-gray-600">+51 41 478000</p>
                </div>
            </div>
        </div>
        <div class="lg:w-1/3 md:w-1/2 bg-white flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0">
            <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">Contáctanos</h2>
            <p class="leading-relaxed mb-5 text-gray-600">Estamos aquí para responder a tus preguntas y escuchar tus sugerencias.</p>
            
            @if($notificationStatus)
                <div class="bg-blue-100 border border-blue-200 text-gray-800 rounded-lg p-4 dark:bg-blue-800/10 dark:border-blue-900 dark:text-white mb-4" role="alert" tabindex="-1" aria-labelledby="notification-label">
                    <div class="flex">
                        <div class="shrink-0">
                            <svg class="shrink-0 size-4 mt-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M12 16v-4"></path>
                                <path d="M12 8h.01"></path>
                            </svg>
                        </div>
                        <div class="ms-3">
                            <h3 id="notification-label" class="font-semibold">
                                Estado del envío
                            </h3>
                            <div class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                                {{ $notificationMessage }}
                            </div>
                            <div class="mt-4">
                                <div class="flex gap-x-3">
                                    <button type="button" wire:click="resetNotification" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400">
                                        Cerrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <form wire:submit.prevent="sendMessage">
                <div class="relative mb-4">
                    <label for="name" class="leading-7 text-sm text-gray-600">Nombre</label>
                    <input type="text" id="name" wire:model.lazy="name"
                        class="w-full bg-white rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out @error('name')  @enderror">
                    @error('name')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="relative mb-4">
                    <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
                    <input type="email" id="email" wire:model.lazy="email"
                        class="w-full bg-white rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out @error('email')  @enderror">
                    @error('email')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="relative mb-4">
                    <label for="message" class="leading-7 text-sm text-gray-600">Mensaje</label>
                    <textarea id="message" wire:model.lazy="message"
                        class="w-full bg-white rounded border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out @error('message')  @enderror"></textarea>
                    @error('message')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="text-white bg-blue-500 border-0 py-2 px-6 focus:outline-none hover:bg-blue-600 rounded text-lg">Enviar</button>
            </form>
            <p class="text-xs text-gray-500 mt-3">Tu mensaje es importante para nosotros. Nos pondremos en contacto contigo lo antes posible.</p>
        </div>
    </div>
</section>