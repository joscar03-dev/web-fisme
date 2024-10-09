<x-filament-panels::page>
    <link rel="stylesheet" href="{{ asset('css/scanner.css') }}">

    <div class="qr-page">
        <div class="qr-container">
            <h1>Escáner de Código QR</h1>
            <div class="qr-options">
                <!-- Opción para escanear con la cámara -->
                <div id="my-qr-reader"></div>
            </div>
    
            <!-- Área para mostrar el resultado del escaneo -->
            <div id="result">
                <h2>Resultado del escaneo:</h2>
                <p id="qr-result-text">Esperando el escaneo...</p>
            </div>
    
            <!-- Botón para detener/iniciar la detección -->
            <button id="toggle-scan">Detener detección</button>
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

        domReady(function() {
            let html5QrCode;
            let isScanning = false;
            const qrResultText = document.getElementById("qr-result-text");
            const toggleScanButton = document.getElementById("toggle-scan");

            function onScanSuccess(decodedText, decodedResult) {
                // Detenemos el escáner temporalmente
                stopScanner();

                setTimeout(() => {
                    // Realizamos la petición al servidor después de 1 segundo
                    fetch('{{ route('filament.admin.resources.asistencias.escanear.register') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ numero_documento: decodedText })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`Error: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Response data:', data);
                        qrResultText.textContent = data.message;

                        // Después de 1 segundo, volver a mostrar "Esperando el escaneo..."
                        setTimeout(() => {
                            qrResultText.textContent = "Esperando el escaneo...";
                        }, 1000);
                    })
                    .catch(error => {
                        console.error('Error detallado:', error);
                        qrResultText.textContent = 'Error al procesar la solicitud: ' + error.message;

                        setTimeout(() => {
                            qrResultText.textContent = "Esperando el escaneo...";
                        }, 1000);
                    });

                    // Reiniciar el escaneo después de 1.5 segundos en total
                    setTimeout(() => {
                        startScanner();
                    }, 1500);
                }, 1000); // Espera de 1 segundo antes de enviar la petición
            }

            function startScanner() {
                const qrReaderElement = document.getElementById("my-qr-reader");

                if (!qrReaderElement) {
                    console.error("Elemento 'my-qr-reader' no encontrado");
                    return;
                }

                html5QrCode = new Html5Qrcode(qrReaderElement.id);

                html5QrCode.start({
                        facingMode: "environment" // Cámara trasera
                    }, {
                        fps: 10,
                        qrbox: 250
                    },
                    onScanSuccess
                ).then(() => {
                    isScanning = true;
                    toggleScanButton.textContent = "Detener detección";
                    console.log("Escáner iniciado correctamente");
                }).catch(err => {
                    console.error(`Error al iniciar la cámara: ${err}`);
                    alert("No se pudo acceder a la cámara. Verifica los permisos.");
                });
            }

            function stopScanner() {
                if (html5QrCode && isScanning) {
                    html5QrCode.stop().then(() => {
                        console.log('Escáner detenido');
                        isScanning = false;
                        toggleScanButton.textContent = "Iniciar detección";
                    }).catch(err => {
                        console.error('Error al detener el escáner:', err);
                    });
                }
            }

            toggleScanButton.addEventListener('click', function() {
                if (isScanning) {
                    stopScanner();
                } else {
                    startScanner();
                }
            });

            // Iniciar el escáner automáticamente
            startScanner();

            // Escaneo a partir de una imagen subida
            const qrImageInput = document.getElementById('qr-image-input');
            const uploadBtn = document.getElementById('upload-btn');

            uploadBtn.addEventListener('click', function() {
                const file = qrImageInput.files[0];
                if (!file) {
                    console.error("No se ha seleccionado ningún archivo para escanear.");
                    qrResultText.textContent = "Por favor selecciona un archivo de imagen.";
                    return;
                }

                Html5Qrcode.scanFile(file, true)
                    .then(decodedText => {
                        onScanSuccess(decodedText, null);
                    })
                    .catch(err => {
                        console.error(`Error al escanear la imagen: ${err}`);
                        qrResultText.textContent = "Error al escanear la imagen.";
                    });
            });

            document.getElementById('qr-image-input').addEventListener('change', function() {
                const fileName = this.files.length ? this.files[0].name : 'Sin archivos seleccionados';
                document.getElementById('file-name').textContent = fileName;
            });
        });
    </script>
</x-filament-panels::page>
