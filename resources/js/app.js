// const html_loading = document.createElement('<div id="loading-screen"> <div class="inline-block h-12 w-12 animate-[spinner-grow_0.75s_linear_infinite] rounded-full bg-current align-[-0.125em] text-surface opacity-0 motion-reduce:animate-[spinner-grow_1.5s_linear_infinite] dark:text-white" role="status">  <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]" >Loading...</span > </div> </div>');
const loading = document.getElementById('loading-screen');
loading.style.visibility = 'initial';
loading.style.opacity = '1';

import 'preline';


document.addEventListener('livewire:navigated', () => { 
    // 
    window.HSStaticMethods.autoInit();
})
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';

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

