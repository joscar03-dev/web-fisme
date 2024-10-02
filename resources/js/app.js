import 'preline/preline';
import { HSStaticMethods } from 'preline/preline';
const loading = document.getElementById('loading-screen');
loading.style.visibility = 'initial';
loading.style.opacity = '1';

// Inicializa el calendario
document.addEventListener('DOMContentLoaded', function () {
    // console.log('end Loading');
    loading.style.visibility = 'hidden';
    loading.style.opacity = '0';
    // const calendarEl = document.getElementById('calendar');
    // const calendar = new Calendar(calendarEl, {
    //     plugins: [dayGridPlugin, timeGridPlugin],
    //     initialView: 'dayGridMonth',
    //     // Otras configuraciones de calendario
    // });
    // calendar.render();
});
document.addEventListener('livewire:load', function () {
    Livewire.on('show-loading-screen', function () {
        document.getElementById('loading-screen').classList.remove('hidden');
        animateLoadingBar();
    });
});

function animateLoadingBar() {
    const loadingBar = document.getElementById('loading-bar');
    let width = 0;
    const interval = setInterval(function() {
        if (width >= 100) {
            clearInterval(interval);
            document.getElementById('loading-screen').classList.add('hidden');
            loadingBar.style.width = '0%';
        } else {
            width++;
            loadingBar.style.width = width + '%';
        }
    }, 10);
}

