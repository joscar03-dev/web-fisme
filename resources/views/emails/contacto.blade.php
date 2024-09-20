<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>{{ $title ?? 'Eventos Fisme' }}</title>
    @livewireStyles
    @vite('resources/css/app.css')
</head>

<body>


    <main>
 <!-- Contact -->
 <div class="bg-gradient-to-r from-[#001f54] to-[#4b6587]">
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
</div>
    </main>
    @livewireScripts

    @vite('resources/js/app.js')





</body>

</html>
