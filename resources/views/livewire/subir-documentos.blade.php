<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg">
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <h2 class="text-2xl font-bold mb-6 text-center text-[#133E6B]">Subir Documentos</h2>

        <form wire:submit.prevent="submit" enctype="multipart/form-data" class="space-y-4">
            @foreach($tipos_documentos as $index => $tipo_documento)
                <div>
                    <label for="documento_{{ $index }}" class="block font-medium text-[#133E6B]">{{ $tipo_documento->nombre }}</label>
                    <input type="file" id="documento_{{ $index }}" accept=".jpeg,.png,.jpg,.gif,.svg,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" wire:model="documentos.{{ $index }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#133E6B] focus:ring focus:ring-[#133E6B] focus:ring-opacity-50">
                    @error('documentos.' . $index) 
                        <span class="text-red-500 text-sm">{{ $message }}</span> 
                    @enderror
                </div>
            @endforeach

            <button type="submit" class="w-full mt-6 px-4 py-2 bg-[#133E6B] text-white rounded-md hover:bg-[#0F2D4A] transition duration-300 ease-in-out">
                Subir Documentos
            </button>
        </form>
    </div>
</div>