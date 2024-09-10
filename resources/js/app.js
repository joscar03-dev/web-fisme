import { Html5Qrcode } from "html5-qrcode";
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

function toggleMenu() {
    const menu = document.getElementById('mobileMenu');
    menu.classList.toggle('hidden');
}

document.addEventListener("DOMContentLoaded", function() {
    const html5QrCode = new Html5Qrcode("reader");
    const startScanButton = document.getElementById("start-scan");
    const messageElement = document.getElementById("message");
    let isScanning = false;

    async function requestCameraPermission() {
        try {
            // Solicitar permiso para acceder a la cámara
            const stream = await navigator.mediaDevices.getUserMedia({ video: true });
            // Detener el flujo después de obtener el permiso
            stream.getTracks().forEach(track => track.stop());
            console.log("Permiso concedido para acceder a la cámara");
        } catch (err) {
            console.error("Permiso denegado o error en el acceso a la cámara: ", err);
            messageElement.textContent = `Error: ${err.message}`;
        }
    }

    function onScanSuccess(decodedText) {
        console.log(`QR Code detected: ${decodedText}`);
        document.getElementById("numero_documento").value = decodedText;
        messageElement.textContent = "QR Code detected. Click 'Registrar Asistencia' to submit.";
        html5QrCode.stop(); // Detener la cámara después de escanear con éxito
        isScanning = false;
    }

    function onScanFailure(error) {
        console.warn(`Error al escanear: ${error}`);
    }

    startScanButton.addEventListener("click", async function() {
        await requestCameraPermission(); // Pedir permiso antes de iniciar el escaneo

        if (!isScanning) {
            isScanning = true;
            const config = {
                facingMode: "environment", // Modo de cámara trasera
                fps: 10, // Tasa de fotogramas por segundo
                qrbox: { width: 250, height: 250 }, // Tamaño del cuadro de escaneo
                aspectRatio: 1.0 // Relación de aspecto 1:1
            };
            
            html5QrCode.start(config, onScanSuccess, onScanFailure).catch(err => {
                console.error(`Error al iniciar la cámara: ${err}`);
                messageElement.textContent = `Error al acceder a la cámara: ${err.message}`;
                isScanning = false;
            });
        }
    });

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
                messageElement.textContent = error.message || "An error occurred";
            }
        } catch (error) {
            messageElement.textContent = "An error occurred while submitting the form";
        }
    });
});
