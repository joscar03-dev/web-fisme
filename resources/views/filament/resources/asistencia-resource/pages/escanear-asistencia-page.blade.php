<x-filament-panels::page>
    @vite('resources/css/app.css')
    <div id="qr-code" class="flex flex-col items-center p-6 bg-white shadow-xl rounded-lg max-w-4xl mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Escáner de Código QR</h1>

        <div class="flex flex-col md:flex-row justify-center items-center gap-8 w-full">
            <!-- Opción para escanear con la cámara -->
            <div id="my-qr-reader" class="w-full md:w-80 h-100 border border-gray-300 rounded-lg shadow-lg"></div>

            <!-- Opción para subir una imagen -->
            <div class="flex flex-col items-center w-full md:w-auto">
                <input type="file" accept="image/*" id="qr-image-input" class="mb-4 p-2 border rounded-md w-full md:w-auto"/>
                <button id="upload-btn" class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-6 rounded-md transition-all shadow-lg">
                    Escanear Imagen
                </button>
            </div>
        </div>

        <!-- Área para mostrar el resultado del escaneo -->
        <div id="result" class="mt-8 text-center w-full">
            <h2 class="text-lg font-semibold text-gray-700">Resultado del escaneo:</h2>
            <p id="qr-result-text" class="mt-4 text-gray-600">Esperando el escaneo...</p>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        function domReady(fn) {
            if (document.readyState === "complete" || document.readyState === "interactive") {
                setTimeout(fn, 1);
            } else {
                document.addEventListener("DOMContentLoaded", fn);
            }
        }

        domReady(function () {
            var lastResult, cantresultado = 0;
            const qrResultText = document.getElementById("qr-result-text");

            function onScanSuccess(decodedText, decodedResult) {
                if (decodedText !== lastResult) {
                    ++cantresultado;
                    lastResult = decodedText;
                    // Mostrar el resultado del QR en la página
                    qrResultText.textContent = `Has escaneado ${cantresultado} veces: ${decodedText}`;
                }
            }

            // Inicializar el escáner con la cámara
            const html5QrCode = new Html5Qrcode("my-qr-reader");
            html5QrCode.start(
                { facingMode: "environment" }, // Usa la cámara trasera
                {
                    fps: 10,    // Frecuencia de escaneo en cuadros por segundo
                    qrbox: 250  // Tamaño del cuadro para escanear el QR
                },
                onScanSuccess
            ).catch(err => {
                console.error(`Error al iniciar la cámara: ${err}`);
            });

            // Escaneo a partir de una imagen subida
            const qrImageInput = document.getElementById('qr-image-input');
            const uploadBtn = document.getElementById('upload-btn');

            uploadBtn.addEventListener('click', function () {
                const file = qrImageInput.files[0];
                if (!file) {
                    alert("Por favor selecciona una imagen.");
                    return;
                }

                Html5QrcodeScanner.scanFile(file, true)
                    .then(decodedText => {
                        // Mostrar el resultado del QR escaneado desde la imagen
                        qrResultText.textContent = `Resultado del escaneo de imagen: ${decodedText}`;
                    })
                    .catch(err => {
                        console.error(`Error al escanear la imagen: ${err}`);
                        qrResultText.textContent = `Error al escanear la imagen.`;
                    });
            });
        });
    </script>
</x-filament-panels::page>
