{{-- <div>
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-4">
        <!-- Tipo de Documento -->
        <div>
            <label for="tipo_documento" class="block font-medium text-gray-700">Tipo de Documento:</label>
            <input type="text" id="tipo_documento" wire:model="tipo_documento" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('tipo_documento') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Número de Documento -->
        <div>
            <label for="numero_documento" class="block font-medium text-gray-700">Número de Documento:</label>
            <input type="text" id="numero_documento" wire:model="numero_documento" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('numero_documento') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Nombres -->
        <div>
            <label for="nombres" class="block font-medium text-gray-700">Nombres:</label>
            <input type="text" id="nombres" wire:model="nombres" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('nombres') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Apellidos -->
        <div>
            <label for="apellidos" class="block font-medium text-gray-700">Apellidos:</label>
            <input type="text" id="apellidos" wire:model="apellidos" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('apellidos') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Número de Celular -->
        <div>
            <label for="numero_celular" class="block font-medium text-gray-700">Número de Celular:</label>
            <input type="text" id="numero_celular" wire:model="numero_celular" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('numero_celular') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Tipo de Participante -->
        <div>
            <label for="tipo_participante" class="block font-medium text-gray-700">Tipo de Participante:</label>
            <select id="tipo_participante" wire:model="tipo_participante" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <option value="">Seleccionar</option>
                <option value="estudiante">Estudiante</option>
                <option value="profesional">Profesional</option>
            </select>
            @error('tipo_participante') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Institución de Procedencia -->
        <div>
            <label for="institucion_procedencia" class="block font-medium text-gray-700">Institución de Procedencia:</label>
            <input type="text" id="institucion_procedencia" wire:model="institucion_procedencia" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('institucion_procedencia') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block font-medium text-gray-700">Correo Electrónico:</label>
            <input type="email" id="email" wire:model="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('email') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Subir Boucher -->
        <div>
            <label for="img_boucher" class="block font-medium text-gray-700">Subir Boucher:</label>
            <input type="file" id="img_boucher" wire:model="img_boucher" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('img_boucher') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>

        <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            Inscribirse
        </button>
    </form>
</div>
 --}}

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
                <input type="text" id="tipo_documento" wire:model="tipo_documento"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#133E6B] focus:ring focus:ring-[#133E6B] focus:ring-opacity-50">
                @error('tipo_documento')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
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
                    <option value="estudiante">Estudiante</option>
                    <option value="profesional">Profesional</option>
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

            <!-- Subir Boucher -->
            <div>
                <label for="img_boucher" class="block font-medium text-[#133E6B]">Subir Boucher:</label>
                <input type="file" id="img_boucher" wire:model="img_boucher"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#133E6B] focus:ring focus:ring-[#133E6B] focus:ring-opacity-50">
                @error('img_boucher')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                class="w-full mt-6 px-4 py-2 bg-[#133E6B] text-white rounded-md hover:bg-[#0F2D4A] transition duration-300 ease-in-out">
                Inscribirse
            </button>
        </form>
    </div>
</div>
