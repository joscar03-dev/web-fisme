<x-filament-panels::page>
    
    <div class="flex flex-col items-center justify-center">
        <h3 class="text-lg font-semibold mb-4">Escanear QR para Registrar Asistencia</h3>

        <div id="reader" style="width: 300px;"></div> {{-- Aquí se mostrará el feed de la cámara --}}

        <form id="attendance-form" method="POST" action="{{ route('filament.asistencias.store') }}">
            @csrf
            <input type="hidden" name="numero_documento" id="numero_documento">
            <button type="submit" class="btn btn-primary mt-4">Registrar Asistencia</button>
        </form>
        <p id="message" class="mt-4 text-green-600"></p>
    </div>
    
    <div id="reader" style="width: 300px;"></div> <!-- Aquí se mostrará el feed de la cámara -->
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const html5QrCode = new Html5Qrcode("reader");
    
            // Iniciamos la cámara y leemos el QR
            function onScanSuccess(decodedText) {
                // Lógica cuando se escanea exitosamente el QR
                console.log(`QR Code detected: ${decodedText}`);
            }
    
            function onScanFailure(error) {
                console.warn(`Error al escanear: ${error}`);
            }
    
            // Iniciar la cámara
            html5QrCode.start(
                { facingMode: "environment" }, // Usa la cámara trasera (si está disponible)
                {
                    fps: 10, // Cuadros por segundo
                    qrbox: { width: 250, height: 250 } // Tamaño del cuadro de escaneo
                },
                onScanSuccess,
                onScanFailure
            ).catch(err => {
                console.error(`Error al iniciar la cámara: ${err}`);
            });
        });
    </script>
</x-filament-panels::page>
