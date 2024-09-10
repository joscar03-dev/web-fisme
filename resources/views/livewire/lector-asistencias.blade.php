<div class="flex flex-col items-center justify-center">
    <h3 class="text-lg font-semibold mb-4">Escanear QR para Registrar Asistencia</h3>

    <!-- Contenedor para el lector de QR -->
    <div id="reader" class="w-64 h-64 border-2 border-gray-300 rounded-lg overflow-hidden"></div>

    <form wire:submit.prevent="registrarAsistencia" class="w-full max-w-sm space-y-4 mt-4">
        @csrf
        <input type="hidden" wire:model="numero_documento" id="numero_documento">

        @error('numero_documento')
            <span class="text-red-500">{{ $message }}</span>
        @enderror

        <button type="button" id="start-scan" class="w-full bg-blue-500 text-white py-2 rounded-lg">
            Iniciar Escaneo
        </button>

        <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-lg">
            Registrar Asistencia
        </button>
    </form>

    <div id="message" class="text-sm text-red-500 mt-2"></div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const html5QrCode = new Html5Qrcode("reader");
        const startScanButton = document.getElementById("start-scan");
        const messageElement = document.getElementById("message");
        let isScanning = false;

        // Función para verificar permisos de la cámara
        async function requestCameraPermission() {
            try {
                // Solicitar acceso a la cámara
                const stream = await navigator.mediaDevices.getUserMedia({ video: true });
                // Detener el flujo después de obtener el permiso
                stream.getTracks().forEach(track => track.stop());
                console.log("Permiso concedido para acceder a la cámara");
            } catch (err) {
                console.error("Permiso denegado o error en el acceso a la cámara: ", err);
                messageElement.textContent = `Error: ${err.message}`;
            }
        }

        // Escaneo exitoso
        function onScanSuccess(decodedText) {
            console.log(`Código QR detectado: ${decodedText}`);
            document.getElementById("numero_documento").value = decodedText;
            messageElement.textContent = "Código QR detectado. Haz clic en 'Registrar Asistencia' para enviar.";
            html5QrCode.stop(); // Detener el escaneo después de un éxito
            isScanning = false;
        }

        // Fallo de escaneo
        function onScanFailure(error) {
            console.warn(`Error al escanear: ${error}`);
        }

        // Iniciar el escaneo al hacer clic en el botón
        startScanButton.addEventListener("click", async function() {
            await requestCameraPermission(); // Pedir permiso antes de iniciar el escaneo

            if (!isScanning) {
                isScanning = true;
                html5QrCode.start({
                        facingMode: "user" // Cambia a "user" si quieres usar la cámara frontal
                    }, {
                        fps: 10,
                        qrbox: { width: 250, height: 250 }
                    },
                    onScanSuccess,
                    onScanFailure
                ).catch(err => {
                    console.error(`Error al iniciar la cámara: ${err}`);
                    messageElement.textContent = `Error al acceder a la cámara: ${err.message}`;
                    isScanning = false;
                });
            }
        });
    });
</script>
