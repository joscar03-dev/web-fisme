<div class="min-h-screen bg-gradient-to-br from-[#001f54] to-[#4b6587] flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl overflow-hidden w-full max-w-md mx-auto">

        <div class="p-8">
            <div class="flex justify-center">
                <!-- Botón para abrir el modal -->
                <button type="button"
                    class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium  border-transparent text-white bg-[#1d4570]  w-30% focus:outline-none hover:bg-[#00dffd] rounded transition-colors duration-300 ease-in-outdisabled:opacity-50 disabled:pointer-events-none"
                    aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-medium-modal"
                    data-hs-overlay="#hs-medium-modal">
                    Cómo realizar el proceso de pago
                </button>
            </div>
            @if ($evento)
                <div class="mb-6 p-4 bg-gray-100 rounded-lg">
                    
                    <h3 class="text-2xl font-semibold text-[#001f54] mb-2">{{ $evento->nombre_evento }}</h3>
                    <h4 class="text-sm font-semibold text-blue-500 mb-2">{{ $tipo_asistente }}</h4>
                    <p class="text-gray-600"><span class="font-medium">Fecha:</span>
                        {{ $evento->fecha_inicio instanceof \DateTime ? $evento->fecha_inicio->format('d/m/Y') : 'Fecha no disponible' }}
                        -
                        {{ $evento->fecha_fin instanceof \DateTime ? $evento->fecha_fin->format('d/m/Y') : 'Fecha no disponible' }}
                    </p>
                    <p class="text-gray-600"><span class="font-medium">Horario:</span>
                        {{ $evento->hora_inicio instanceof \DateTime ? $evento->hora_inicio->format('H:i') : 'Hora no disponible' }}
                        -
                        {{ $evento->hora_salida instanceof \DateTime ? $evento->hora_salida->format('H:i') : 'Hora no disponible' }}
                    </p>
                </div>
            @endif
            <div id="hs-medium-modal"
                class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
                role="dialog" tabindex="-1" aria-labelledby="hs-medium-modal-label">
                <div
                    class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all md:max-w-2xl md:w-full m-3 md:mx-auto">
                    <div
                        class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                        <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                            <h3 id="hs-medium-modal-label" class="font-bold text-gray-800 dark:text-white">
                                Pasos para la Inscripción
                            </h3>
                            <button type="button"
                                class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                                aria-label="Close" data-hs-overlay="#hs-medium-modal">
                                <span class="sr-only">Close</span>
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6 6 18"></path>
                                    <path d="m6 6 12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="p-4 overflow-y-auto max-h-[70vh]">
                            <ol class="relative border-l border-blue-500 space-y-8 ml-3">
                                <li class="mb-10 ml-6">
                                    <span
                                        class="absolute flex items-center justify-center w-8 h-8 bg-blue-500 rounded-full -left-4 ring-4 ring-white">
                                        <span class="text-white text-lg font-bold">1</span>
                                    </span>
                                    <h3 class="mb-2 text-lg font-semibold text-gray-900 text-left">Realizar el depósito
                                    </h3>
                                    <p class="text-base text-gray-700 text-justify">
                                        Deposita el monto de inscripción a las siguientes cuentas de la UNTRM:
                                    </p>
                                    <ul class="mt-2 list-disc list-inside text-base text-gray-700 text-justify">
                                        <li>Banco de la Nación-CTA CTE 00261022419</li>
                                        <li>Banco de la Nación-CCI 01826100026102241984</li>
                                        <li>BANCO DE CRÉDITO -CTA CTE: 290-4216956-0-05</li>
                                        <li>BANCO DE CRÉDITO - CCI : 002 290 00421695600 551</li>
                                    </ul>
                                    {{-- <img src="/placeholder.svg?height=150&width=300" alt="Imagen de depósito bancario"
                                    class="mt-3 rounded-lg shadow-md"> --}}
                                </li>
                                <li class="mb-10 ml-6">
                                    <span
                                        class="absolute flex items-center justify-center w-8 h-8 bg-blue-500 rounded-full -left-4 ring-4 ring-white">
                                        <span class="text-white text-lg font-bold">2</span>
                                    </span>
                                    <h3 class="mb-2 text-lg font-semibold text-gray-900 text-left">Ingresar a la página
                                        del
                                        evento</h3>
                                    <p class="text-base text-gray-700 text-justify">
                                        Visita la página oficial del evento y haz clic en el botón "Inscribirse".
                                    </p>
                                    <img src="/images/inscribirme-evento.png?height=150&width=300"
                                        alt="Imagen de la página del evento" class="mt-3 rounded-lg shadow-md">
                                </li>
                                <li class="mb-10 ml-6">
                                    <span
                                        class="absolute flex items-center justify-center w-8 h-8 bg-blue-500 rounded-full -left-4 ring-4 ring-white">
                                        <span class="text-white text-lg font-bold">3</span>
                                    </span>
                                    <h3 class="mb-2 text-lg font-semibold text-gray-900 text-left">Registrar tus datos
                                    </h3>
                                    <p class="text-base text-gray-700 text-justify">
                                        Completa el formulario de inscripción con tus datos personales y de contacto.
                                    </p>
                                    <img src="/images/formulario.jpeg?height=150&width=300"
                                        alt="Imagen de formulario de registro" class="mt-3 rounded-lg shadow-md">
                                </li>
                                <li class="ml-6">
                                    <span
                                        class="absolute flex items-center justify-center w-8 h-8 bg-blue-500 rounded-full -left-4 ring-4 ring-white">
                                        <span class="text-white text-lg font-bold">4</span>
                                    </span>
                                    <h3 class="mb-2 text-lg font-semibold text-gray-900 text-left">Cargar el comprobante
                                        de
                                        pago</h3>
                                    <p class="text-base text-gray-700 text-justify">
                                        En la sección de carga de imagen, sube una foto clara del comprobante de
                                        depósito.
                                    </p>
                                    <img src="/images/vaucher.png?height=150&width=300"
                                        alt="Imagen de carga de comprobante" class="mt-3 rounded-lg shadow-md">
                                </li>
                            </ol>
                        </div>
                        <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-neutral-700">
                            <button type="button"
                                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                                data-hs-overlay="#hs-medium-modal">
                                Cerrar
                            </button>
                            <button type="button"
                                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                data-hs-overlay="#hs-medium-modal">
                                Entendido
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <form wire:submit.prevent="register"class="space-y-6" method="POST">
                @csrf
                {{-- @if (session()->has('message'))
                    <div class="rounded-md bg-green-50 p-4 mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">
                                    {{ session('message') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif --}}

                {{-- @if (session()->has('error'))
                    <div class="rounded-md bg-red-50 p-4 mb-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-red-800">
                                    {{ session('error') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif --}}

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="tipo_documento" class="block text-sm font-medium text-gray-700">Tipo de
                            Documento</label>
                        <select wire:model="tipo_documento" id="tipo_documento"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-[#001f54] focus:border-[#001f54] sm:text-sm rounded-md">
                            <option value="">Selecciona tipo de documento</option>
                            <option value="DNI">DNI</option>
                            <option value="CE">CE</option>
                            <option value="Pasaporte">Pasaporte</option>
                        </select>
                        @error('tipo_documento')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="numero_documento" class="block text-sm font-medium text-gray-700">Número de
                            Documento</label>
                        <input wire:model="numero_documento" id="numero_documento" type="text"
                            class="mt-1 focus:ring-[#001f54] focus:border-[#001f54] block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            placeholder="Ingrese su número de documento">
                        @error('numero_documento')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="nombres" class="block text-sm font-medium text-gray-700">Nombres</label>
                        <input wire:model="nombres" id="nombres" type="text"
                            class="mt-1 focus:ring-[#001f54] focus:border-[#001f54] block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            placeholder="Ingrese sus nombres">
                        @error('nombres')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="apellidos" class="block text-sm font-medium text-gray-700">Apellidos</label>
                        <input wire:model="apellidos" id="apellidos" type="text"
                            class="mt-1 focus:ring-[#001f54] focus:border-[#001f54] block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            placeholder="Ingrese sus apellidos">
                        @error('apellidos')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="numero_celular" class="block text-sm font-medium text-gray-700">Número de
                            Celular</label>
                        <input wire:model="numero_celular" id="numero_celular" type="tel"
                            class="mt-1 focus:ring-[#001f54] focus:border-[#001f54] block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            placeholder="Ingrese su número de celular">
                        @error('numero_celular')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input wire:model="email" id="email" type="email"
                            class="mt-1 focus:ring-[#001f54] focus:border-[#001f54] block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            placeholder="Ingrese su email">
                        @error('email')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>



                    <div>
                        <label for="institucion_procedencia"
                            class="block text-sm font-medium text-gray-700">Institución
                            de Procedencia</label>
                        <input wire:model="institucion_procedencia" id="institucion_procedencia" type="text"
                            class="mt-1 focus:ring-[#001f54] focus:border-[#001f54] block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                            placeholder="Ingrese su institución">
                        @error('institucion_procedencia')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo de Venta - Preventa
                            hasta 15 de octubre</label>
                        <select wire:model="tipo" id="tipo"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-[#001f54] focus:border-[#001f54] sm:text-sm rounded-md">
                            <option value="">Selecciona tipo de venta</option>
                            <option value="normal">Venta Normal</option>
                            <option value="preventa">Preventa</option>
                        </select>
                        @error('tipo')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <!-- Campo Modalidad -->
                        <label for="modalidad" class="block text-sm font-medium text-gray-700">Modalidad</label>
                        <select wire:model="modalidad" id="modalidad"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-[#001f54] focus:border-[#001f54] sm:text-sm rounded-md">
                            <option value="">Selecciona modalidad</option>
                            <option value="Online">Online</option>
                            <option value="Presencial">Presencial</option>
                        </select>
                        @error('modalidad')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <!-- Campo Entidad Financiera -->
                        <label for="entidad_financiera" class="block text-sm font-medium text-gray-700">Entidad
                            Financiera</label>
                        <input type="text" wire:model="entidad_financiera" id="entidad_financiera"
                            class="mt-1 block w-full pl-3 pr-3 py-2 text-base border-gray-300 focus:outline-none focus:ring-[#001f54] focus:border-[#001f54] sm:text-sm rounded-md"
                            placeholder="Escribe la entidad financiera">
                        @error('entidad_financiera')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>


                    <div>
                        <label for="img_boucher" class="block text-sm font-medium text-gray-700 mb-2">
                            Cargar Boucher
                        </label>
                        <div id="hs-file-upload-with-limited-file-size" x-data="{
                            isUploading: false,
                            progress: 0,
                            filePreview: null,
                            fileName: '',
                            fileSize: '',
                            fileExt: '',
                            errorMessage: ''
                        }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false; progress = 0"
                            x-on:livewire-upload-error="isUploading = false; errorMessage = 'Error al cargar el archivo'"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <div x-show="filePreview" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform scale-90"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-start="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-90"
                                class="p-3 bg-white border border-solid border-gray-300 rounded-xl dark:bg-neutral-800 dark:border-neutral-600">
                                <div class="mb-1 flex justify-between items-center">
                                    <div class="flex items-center gap-x-3">
                                        <span
                                            class="size-10 flex justify-center items-center border border-gray-200 text-gray-500 rounded-lg dark:border-neutral-700 dark:text-neutral-500">
                                            <img x-bind:src="filePreview"
                                                class="rounded-lg w-full h-full object-cover">
                                        </span>
                                        <div>
                                            <p class="text-sm font-medium text-gray-800 dark:text-white">
                                                <span x-text="fileName"
                                                    class="truncate inline-block max-w-[300px] align-bottom"></span>.<span
                                                    x-text="fileExt"></span>
                                            </p>
                                            <p x-show="!errorMessage" x-text="fileSize"
                                                class="text-xs text-gray-500 dark:text-neutral-500"></p>
                                            <p x-show="errorMessage" x-text="errorMessage"
                                                class="text-xs text-red-500"></p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-x-2">
                                        <button type="button"
                                            @click="$wire.set('img_boucher', null); filePreview = null; fileName = ''; fileSize = ''; fileExt = ''; errorMessage = ''"
                                            class="text-gray-500 hover:text-gray-800 focus:outline-none focus:text-gray-800 dark:text-neutral-500 dark:hover:text-neutral-200 dark:focus:text-neutral-200">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M3 6h18"></path>
                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                                <line x1="10" x2="10" y1="11" y2="17">
                                                </line>
                                                <line x1="14" x2="14" y1="11" y2="17">
                                                </line>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div x-show="isUploading" class="flex items-center gap-x-3 whitespace-nowrap">
                                    <div class="flex w-full h-2 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700"
                                        role="progressbar" :aria-valuenow="progress" aria-valuemin="0"
                                        aria-valuemax="100">
                                        <div class="flex flex-col justify-center rounded-full overflow-hidden bg-blue-600 text-xs text-white text-center whitespace-nowrap transition-all duration-500"
                                            :style="'width: ' + progress + '%'"></div>
                                    </div>
                                    <div class="w-10 text-end">
                                        <span x-text="progress" class="text-sm text-gray-800 dark:text-white"></span>%
                                    </div>
                                </div>
                            </div>

                            <div x-show="!filePreview"
                                class="cursor-pointer p-12 flex justify-center bg-white border border-dashed border-gray-300 rounded-xl dark:bg-neutral-800 dark:border-neutral-600">
                                <div class="text-center">
                                    <span
                                        class="inline-flex justify-center items-center size-16 bg-gray-100 text-gray-800 rounded-full dark:bg-neutral-700 dark:text-neutral-200">
                                        <svg class="shrink-0 size-6" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                            <polyline points="17 8 12 3 7 8"></polyline>
                                            <line x1="12" x2="12" y1="3" y2="15">
                                            </line>
                                        </svg>
                                    </span>

                                    <div class="mt-4 flex flex-wrap justify-center text-sm leading-6 text-gray-600">
                                        <span class="pe-1 font-medium text-gray-800 dark:text-neutral-200">
                                            Arrastra tu archivo aquí o
                                        </span>
                                        <label for="img_boucher"
                                            class="bg-white font-semibold text-blue-600 hover:text-blue-700 rounded-lg decoration-2 hover:underline focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-600 focus-within:ring-offset-2 dark:bg-neutral-800 dark:text-blue-500 dark:hover:text-blue-600 cursor-pointer">
                                            busca
                                            <input id="img_boucher" wire:model="img_boucher" type="file"
                                                class="sr-only" accept="image/*"
                                                @change="
                                                       const file = $event.target.files[0];
                                                       if (file) {
                                                           filePreview = URL.createObjectURL(file);
                                                           fileName = file.name.split('.').slice(0, -1).join('.');
                                                           fileExt = file.name.split('.').pop();
                                                           fileSize = (file.size / 1024 < 1024) 
                                                               ? (file.size / 1024).toFixed(2) + ' KB' 
                                                               : (file.size / (1024 * 1024)).toFixed(2) + ' MB';
                                                       }
                                                   ">
                                        </label>
                                    </div>

                                    <p class="mt-1 text-xs text-gray-400 dark:text-neutral-400">
                                        Selecciona un archivo de hasta 2MB.
                                    </p>
                                </div>
                            </div>
                        </div>
                        @error('img_boucher')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[#001f54] hover:bg-[#4b6587] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#001f54] transition duration-300 ease-in-out">
                        Registrarse
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
