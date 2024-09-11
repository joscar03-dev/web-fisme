<div id="qr-code">
    <h1>Scanner de QR</h1>
    <div style="display: flex; justify-content: center; gap: 20px;">
        <!-- Opción para escanear con la cámara -->
        <div id="my-qr-reader" style="width: 500px; border: 1px solid #000;"></div>

        <!-- Opción para subir una imagen -->
        <div style="display: flex; flex-direction: column; align-items: center;">
            <input type="file" accept="image/*" id="qr-image-input" />
            <button id="upload-btn">Escanear Imagen</button>
        </div>
    </div>
    <!-- Área para mostrar el resultado del escaneo -->
    <div id="result" style="margin-top: 20px; text-align: center;">
        <h2>Resultado del escaneo:</h2>
        <p id="qr-result-text">Esperando el escaneo...</p>
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
