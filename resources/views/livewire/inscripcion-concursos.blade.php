

<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6"
                role="alert">
                {{ session('message') }}
            </div>
        @endif

        <h2 class="text-2xl font-bold mb-6 text-center text-[#133E6B]">Formulario de Inscripción</h2>

        <form wire:submit.prevent="submit" class="space-y-4">
            <!-- Tipo de Documento -->
            <div>
                <label for="tipo_documento" class="block font-medium text-[#133E6B]">Tipo de Documento:</label>
                <select wire:model="tipo_documento" id="tipo_documento"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-[#001f54] focus:border-[#001f54] sm:text-sm rounded-md">
                            <option value="">Selecciona tipo de documento</option>
                            <option value="DNI">DNI</option>
                            <option value="CE">CE</option>
                            <option value="Pasaporte">Pasaporte</option>
                        </select>
            </div>

            <!-- Número de Documento -->
            <div>
                <label for="numero_documento" class="block font-medium text-[#133E6B]">Número de Documento:</label>
                <input type="text" id="numero_documento" wire:model="numero_documento"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#133E6B] focus:ring focus:ring-[#133E6B] focus:ring-opacity-50">
                @error('numero_documento')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Nombres -->
            <div>
                <label for="nombres" class="block font-medium text-[#133E6B]">Nombres:</label>
                <input type="text" id="nombres" wire:model="nombres"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#133E6B] focus:ring focus:ring-[#133E6B] focus:ring-opacity-50">
                @error('nombres')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Apellidos -->
            <div>
                <label for="apellidos" class="block font-medium text-[#133E6B]">Apellidos:</label>
                <input type="text" id="apellidos" wire:model="apellidos"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#133E6B] focus:ring focus:ring-[#133E6B] focus:ring-opacity-50">
                @error('apellidos')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Número de Celular -->
            <div>
                <label for="numero_celular" class="block font-medium text-[#133E6B]">Número de Celular:</label>
                <input type="text" id="numero_celular" wire:model="numero_celular"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#133E6B] focus:ring focus:ring-[#133E6B] focus:ring-opacity-50">
                @error('numero_celular')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tipo de Participante -->
            <div>
                <label for="tipo_participante" class="block font-medium text-[#133E6B]">Tipo de Participante:</label>
                <select id="tipo_participante" wire:model="tipo_participante"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#133E6B] focus:ring focus:ring-[#133E6B] focus:ring-opacity-50">
                    <option value="">Seleccionar</option>
                    <option value="ESTUDIANTE">Estudiante</option>
                    <option value="PROFESIONAL">Profesional</option>
                </select>
                @error('tipo_participante')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Institución de Procedencia -->
            <div>
                <label for="institucion_procedencia" class="block font-medium text-[#133E6B]">Institución de
                    Procedencia:</label>
                <input type="text" id="institucion_procedencia" wire:model="institucion_procedencia"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#133E6B] focus:ring focus:ring-[#133E6B] focus:ring-opacity-50">
                @error('institucion_procedencia')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block font-medium text-[#133E6B]">Correo Electrónico:</label>
                <input type="email" id="email" wire:model="email"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#133E6B] focus:ring focus:ring-[#133E6B] focus:ring-opacity-50">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="img_boucher" class="block text-sm font-medium text-gray-700 mb-2">
                    Cargar Boucher
                </label>
                <div x-data="{
                    isUploading: false,
                    progress: 0,
                    filePreview: null,
                    fileName: '',
                    fileSize: '',
                    fileExt: '',
                    errorMessage: ''
                }" x-on:livewire-upload-start="isUploading = true"
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
                                    <img x-bind:src="filePreview" class="rounded-lg w-full h-full object-cover">
                                </span>
                                <div>
                                    <p class="text-sm font-medium text-gray-800 dark:text-white">
                                        <span x-text="fileName"
                                            class="truncate inline-block max-w-[300px] align-bottom"></span>.<span
                                            x-text="fileExt"></span>
                                    </p>
                                    <p x-show="!errorMessage" x-text="fileSize"
                                        class="text-xs text-gray-500 dark:text-neutral-500"></p>
                                    <p x-show="errorMessage" x-text="errorMessage" class="text-xs text-red-500">
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-x-2">
                                <button type="button"
                                    @click="$wire.set('img_boucher', null); filePreview = null; fileName = ''; fileSize = ''; fileExt = ''; errorMessage = ''"
                                    class="text-gray-500 hover:text-gray-800 focus:outline-none focus:text-gray-800 dark:text-neutral-500 dark:hover:text-neutral-200 dark:focus:text-neutral-200">
                                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                role="progressbar" :aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">
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
                                <svg class="shrink-0 size-6" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                    <input id="img_boucher" wire:model="img_boucher" type="file" class="sr-only"
                                        accept="image/*"
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

            @foreach ($tipos_documentos as $index => $tipo_documento)
                <div class="mt-4">
                    <label for="documento_{{ $index }}" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $tipo_documento->nombre }}
                    </label>
                    <div x-data="{
                        isUploading: false,
                        progress: 0,
                        filePreview: null,
                        fileName: '',
                        fileSize: '',
                        fileExt: '',
                        errorMessage: ''
                    }" x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false; progress = 0"
                        x-on:livewire-upload-error="isUploading = false; errorMessage = 'Error al cargar el archivo'"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">

                        <!-- Previsualización del archivo cargado -->
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
                                        <p x-show="errorMessage" x-text="errorMessage" class="text-xs text-red-500">
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-x-2">
                                    <button type="button"
                                        @click="$wire.set('documentos.{{ $index }}', null); filePreview = null; fileName = ''; fileSize = ''; fileExt = ''; errorMessage = ''"
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

                        <!-- Botón de carga y previsualización -->
                        <div x-show="!filePreview"
                            class="cursor-pointer p-12 flex justify-center bg-white border border-dashed border-gray-300 rounded-xl dark:bg-neutral-800 dark:border-neutral-600">
                            <div class="text-center">
                                <span
                                    class="inline-flex justify-center items-center size-16 bg-gray-100 text-gray-800 rounded-full dark:bg-neutral-700 dark:text-neutral-200">
                                    <svg class="shrink-0 size-6" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                    <label for="documento_{{ $index }}"
                                        class="bg-white font-semibold text-blue-600 hover:text-blue-700 rounded-lg decoration-2 hover:underline focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-600 focus-within:ring-offset-2 dark:bg-neutral-800 dark:text-blue-500 dark:hover:text-blue-600 cursor-pointer">
                                        busca
                                        <input id="documento_{{ $index }}"
                                            wire:model="documentos.{{ $index }}" type="file"
                                            class="sr-only" accept="/*"
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

                    @error('documentos.' . $index)
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
            @endforeach


            <button type="submit"
                class="w-full mt-6 px-4 py-2 bg-[#133E6B] text-white rounded-md hover:bg-[#0F2D4A] transition duration-300 ease-in-out">
                Inscribirse
            </button>
        </form>
    </div>
</div>
