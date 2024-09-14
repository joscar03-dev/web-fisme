import Alpine from 'alpinejs';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';



window.Alpine = Alpine;

Alpine.start();

// Inicializa el calendario
document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, timeGridPlugin],
        initialView: 'dayGridMonth',
        // Otras configuraciones de calendario
    });
    calendar.render();
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
