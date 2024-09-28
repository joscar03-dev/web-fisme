<div class="min-h-screen bg-gradient-to-br from-[#001f54] to-[#4b6587] flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl overflow-hidden w-full max-w-4xl">
        <div class="p-8">
            <h2 class="text-3xl font-bold text-[#001f54] mb-6 text-center">Registrarse a un evento</h2>
            <form wire:submit.prevent="register" class="space-y-6">
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

                <div class="grid grid-cols-1 gap-6">
                    <!-- Existing form fields -->
                    <!-- ... -->

                    <div class="col-span-2">
                        <label for="img_boucher" class="block text-sm font-medium text-gray-700 mb-2">
                            Cargar Boucher
                        </label>
                        <div x-data="{ files: null }" class="relative">
                            <div class="cursor-pointer p-6 flex justify-center bg-white border border-dashed border-gray-300 rounded-xl dark:bg-neutral-800 dark:border-neutral-600" 
                                 x-on:dragover.prevent="$el.classList.add('border-blue-500')"
                                 x-on:dragleave.prevent="$el.classList.remove('border-blue-500')"
                                 x-on:drop.prevent="handleDrop($event)">
                                <div class="text-center">
                                    <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <p class="mt-1 text-sm text-gray-600">
                                        <span class="font-medium text-blue-600 hover:underline focus:outline-none focus:underline transition duration-150 ease-in-out">Haz clic para subir</span> o arrastra y suelta
                                    </p>
                                    <p class="mt-1 text-xs text-gray-500">PNG, JPG, GIF hasta 2MB</p>
                                </div>
                                <input wire:model="img_boucher" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*" x-on:change="files = Object.values($event.target.files)">
                            </div>
                            <div x-show="files && files.length > 0" class="mt-4">
                                <template x-for="file in files" :key="file.name">
                                    <div class="flex items-center justify-between p-2 bg-gray-100 rounded-lg">
                                        <div class="flex items-center">
                                            <svg class="w-8 h-8 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <span x-text="file.name" class="text-sm font-medium text-gray-700"></span>
                                        </div>
                                        <button type="button" x-on:click="files = files.filter(f => f !== file)" class="text-red-500 hover:text-red-700">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </template>
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

<script>
    function handleDrop(event) {
        event.preventDefault();
        const files = event.dataTransfer.files;
        if (files.length > 0) {
            this.files = Object.values(files);
            const fileInput = this.$el.querySelector('input[type="file"]');
            fileInput.files = files;
            fileInput.dispatchEvent(new Event('change', { bubbles: true }));
        }
        this.$el.classList.remove('border-blue-500');
    }
</script>