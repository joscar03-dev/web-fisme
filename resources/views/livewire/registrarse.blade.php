<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-[#133E6B] shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
        <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
            <div class="max-w-md mx-auto">
                <div>
                    <h1 class="text-2xl font-semibold text-[#133E6B]">Registro para {{ $evento->nombre_evento }}</h1>
                </div>
                <div class="divide-y divide-gray-200">
                    <form wire:submit.prevent="register" class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                        @if (session()->has('message'))
                            <div class="rounded-md bg-green-50 p-4 mb-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-green-800">
                                            {{ session('message') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="relative">
                            <select wire:model="tipo_documento" id="tipo_documento" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-[#133E6B]">
                                <option value="">Selecciona tipo de documento</option>
                                <option value="DNI">DNI</option>
                                <option value="CE">CE</option>
                                <option value="Pasaporte">Pasaporte</option>
                            </select>
                            <label for="tipo_documento" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-[#133E6B] peer-focus:text-sm">Tipo de Documento</label>
                            @error('tipo_documento') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="relative">
                            <input wire:model="numero_documento" id="numero_documento" type="text" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-[#133E6B]" placeholder="Número de Documento" />
                            <label for="numero_documento" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-[#133E6B] peer-focus:text-sm">Número de Documento</label>
                            @error('numero_documento') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="relative">
                            <input wire:model="nombres" id="nombres" type="text" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-[#133E6B]" placeholder="Nombres" />
                            <label for="nombres" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-[#133E6B] peer-focus:text-sm">Nombres</label>
                            @error('nombres') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="relative">
                            <input wire:model="apellidos" id="apellidos" type="text" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-[#133E6B]" placeholder="Apellidos" />
                            <label for="apellidos" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-[#133E6B] peer-focus:text-sm">Apellidos</label>
                            @error('apellidos') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="relative">
                            <input wire:model="numero_celular" id="numero_celular" type="tel" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-[#133E6B]" placeholder="Número de Celular" />
                            <label for="numero_celular" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-[#133E6B] peer-focus:text-sm">Número de Celular</label>
                            @error('numero_celular') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="relative">
                            <input wire:model="email" id="email" type="email" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-[#133E6B]" placeholder="Email" />
                            <label for="email" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-[#133E6B] peer-focus:text-sm">Email</label>
                            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="relative">
                            <select wire:model="tipo_asistente" id="tipo_asistente" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-[#133E6B]">
                                <option value="">Selecciona tipo de Asistente</option>
                                <option value="Estudiante">Estudiante</option>
                                <option value="Profesional">Profesional</option>
                                <option value="Publico General">Público General</option>
                            </select>
                            <label for="tipo_asistente" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-[#133E6B] peer-focus:text-sm">Tipo de Asistente</label>
                            @error('tipo_asistente') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="relative">
                            <input wire:model="institucion_procedencia" id="institucion_procedencia" type="text" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:border-[#133E6B]" placeholder="Universidad, Instituto, etc" />
                            <label for="institucion_procedencia" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-[#133E6B] peer-focus:text-sm">Nombre Institucion</label>
                            @error('institucion_procedencia') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="relative">
                            <div x-data="{ isUploading: false, progress: 0 }" 
                                 x-on:livewire-upload-start="isUploading = true"
                                 x-on:livewire-upload-finish="isUploading = false"
                                 x-on:livewire-upload-error="isUploading = false"
                                 x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <label for="img_boucher" class="flex flex-col items-center px-4 py-6 bg-white text-[#133E6B] rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-[#133E6B] hover:text-white">
                                    <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                    </svg>
                                    <span class="mt-2 text-base leading-normal">Selecciona una imagen</span>
                                    <input wire:model="img_boucher" id="img_boucher" type="file" class="hidden" accept="image/*" />
                                </label>
                                <!-- Progress Bar -->
                                <div x-show="isUploading" class="mt-3">
                                    <progress max="100" x-bind:value="progress" class="w-full"></progress>
                                </div>
                                @if ($img_boucher)
                                    <div class="mt-3">
                                        <img src="{{ $img_boucher->temporaryUrl() }}" class="mt-2 rounded-lg shadow-xl" style="max-width: 200px;">
                                    </div>
                                @endif
                            </div>
                            @error('img_boucher') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="relative">
                            <button type="submit" class="bg-[#133E6B] text-white rounded-md px-4 py-2 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50 w-full">Registrarse</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>