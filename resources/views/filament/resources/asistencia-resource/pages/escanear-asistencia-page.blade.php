<x-filament-panels::page>
    <div class="flex flex-col items-center justify-center">
        <h3 class="text-lg font-semibold mb-4">Escanear QR para Registrar Asistencia</h3>

        <div id="reader" class="w-64 h-64 border-2 border-gray-300 rounded-lg overflow-hidden"></div>

        <form id="attendance-form" method="POST" action="{{ route('filament.asistencias.store') }}"
            class="w-full max-w-sm space-y-4 mt-4">
            @csrf
            <input type="hidden" name="numero_documento" id="numero_documento">
            <x-filament::button type="button" id="start-scan" class="w-full">
                Iniciar Escaneo
            </x-filament::button>
            <x-filament::button type="submit" class="w-full">
                Registrar Asistencia
            </x-filament::button>
        </form>
        <p id="message" class="mt-4 text-sm font-medium text-green-600"></p>
    </div>

    @push('scripts')
        <script src="{{ mix('js/app.js') }}"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const html5QrCode = new Html5Qrcode("reader");
                const startScanButton = document.getElementById("start-scan");
                const messageElement = document.getElementById("message");
                let isScanning = false;

                // Función para solicitar permiso de la cámara
                async function requestCameraPermission() {
                    try {
                        const stream = await navigator.mediaDevices.getUserMedia({
                            video: {
                                facingMode: "environment"
                            }
                        });
                        stream.getTracks().forEach(track => track.stop()); // Detenemos el stream inmediatamente
                        return true;
                    } catch (error) {
                        console.error("Error al acceder a la cámara: ", error);
                        // Manejo detallado de errores
                        if (error.name === 'NotAllowedError') {
                            messageElement.textContent = "Debes permitir el acceso a la cámara para escanear el código QR.";
                        } else if (error.name === 'NotFoundError') {
                            messageElement.textContent = "No se encontró una cámara disponible.";
                        } else if (error.name === 'OverconstrainedError') {
                            messageElement.textContent = "No se puede acceder a la cámara con las restricciones solicitadas.";
                        } else if (error.name === 'NotReadableError') {
                            messageElement.textContent = "La cámara está en uso por otra aplicación.";
                        } else if (error.name === 'SecurityError') {
                            messageElement.textContent = "El acceso a la cámara ha sido restringido por razones de seguridad.";
                        } else {
                            messageElement.textContent = "Error al acceder a la cámara.";
                        }
                        return false;
                    }
                }

                // Evento click para iniciar el escaneo del QR
                startScanButton.addEventListener("click", async function() {
                    if (!isScanning) {
                        const hasPermission = await requestCameraPermission(); // Verificar permiso de cámara
                        if (!hasPermission) return; // Salir si no se concede el permiso

                        isScanning = true;
                        html5QrCode.start({
                                facingMode: "environment" // Cámara trasera
                            }, {
                                fps: 10,
                                qrbox: {
                                    width: 250,
                                    height: 250
                                }
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

                // Función para gestionar el éxito del escaneo
                function onScanSuccess(decodedText) {
                    console.log(`QR Code detected: ${decodedText}`);
                    document.getElementById("numero_documento").value = decodedText;
                    messageElement.textContent = "QR Code detectado. Haz clic en 'Registrar Asistencia' para enviar.";
                    html5QrCode.stop(); // Detener la cámara después de escanear con éxito
                    isScanning = false;
                }

                // Función para gestionar fallos del escaneo
                function onScanFailure(error) {
                    console.warn(`Error al escanear: ${error}`);
                    messageElement.textContent = "No se pudo escanear el QR. Intenta nuevamente.";
                }

                // Enviar formulario
                document.getElementById("attendance-form").addEventListener("submit", async function(event) {
                    event.preventDefault();
                    const form = event.target;
                    const formData = new FormData(form);

                    try {
                        const response = await fetch(form.action, {
                            method: "POST",
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        });

                        if (response.ok) {
                            const result = await response.json();
                            messageElement.textContent = result.message;
                        } else {
                            const error = await response.json();
                            messageElement.textContent = error.message || "Ocurrió un error al registrar la asistencia.";
                        }
                    } catch (error) {
                        messageElement.textContent = "Error al enviar el formulario. Inténtalo de nuevo.";
                    }
                });
            });
        </script>
    @endpush
</x-filament-panels::page>
