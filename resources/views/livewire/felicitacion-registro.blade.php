<div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-[#001f54] to-[#4b6587]">
    <div id="confetti-container" class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none"></div>
    <div class="text-center p-8 bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-lg shadow-xl max-w-lg">
        <h1 class="text-4xl font-bold mb-4 text-yellow-300">¡Felicitaciones!</h1>
        <p class="text-xl mb-6 text-white">
            {{ $nombreCompleto }}, se ha concluido tu registro al evento: {{ $nombreEvento }}.
        </p>
        <a href="{{ route('home') }}" class="inline-block bg-yellow-300 text-[#001f54] font-bold py-2 px-4 rounded hover:bg-yellow-200 transition duration-300">
            Ir a la página del evento
        </a>
    </div>

    <script>
        function createConfetti() {
            const confetti = document.createElement('div');
            confetti.style.position = 'absolute';
            confetti.style.width = '10px';
            confetti.style.height = '10px';
            confetti.style.backgroundColor = `hsl(${Math.random() * 360}, 100%, 50%)`;
            confetti.style.left = Math.random() * 100 + 'vw';
            confetti.style.animationDuration = Math.random() * 3 + 2 + 's';
            confetti.style.animation = 'fall 5s linear infinite';
            document.getElementById('confetti-container').appendChild(confetti);

            setTimeout(() => {
                confetti.remove();
            }, 5000);
        }

        setInterval(createConfetti, 100);

        document.head.insertAdjacentHTML('beforeend', `
            <style>
                @keyframes fall {
                    0% { transform: translateY(-100%) rotate(0deg); }
                    100% { transform: translateY(100vh) rotate(360deg); }
                }
            </style>
        `);
    </script>
</div>