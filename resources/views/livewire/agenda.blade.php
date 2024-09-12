<div class="relative bg-white">
    <div class="bg-blue-500 w-full sm:w-40 h-40 rounded-full absolute top-1 opacity-20 max-sm:right-0 sm:left-56 z-0"></div>
    <div class="bg-blue-500 w-full sm:w-40 h-24 absolute top-0 -left-0 opacity-20 z-0"></div>
    <div class="bg-blue-500 w-full sm:w-40 h-24 absolute top-40 -left-0 opacity-20 z-0"></div>
    
    <div class="w-full py-24 relative z-10 backdrop-blur-3xl">
        <div class="w-full max-w-7xl mx-auto px-2 lg:px-8">
            <div class="grid grid-cols-12 gap-8 max-w-4xl mx-auto xl:max-w-full">
                <div class="col-span-12 xl:col-span-5">
                   
                    <div class="flex gap-5 flex-col">
                        @foreach ($upcomingEvents as $event)
                            <div class="p-6 rounded-xl bg-white shadow-md hover:shadow-lg transition-shadow duration-300">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-2.5">
                                        <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                                        <p class="text-base font-medium text-gray-900">
                                            {{ Carbon\Carbon::parse($event->fecha_inicio)->format('M d, Y') }} -
                                            {{ Carbon\Carbon::parse($event->fecha_fin)->format('M d, Y') }}
                                        </p>
                                    </div>
                                </div>
                                <h6 class="text-xl leading-8 font-semibold text-black mb-1">{{ $event->nombre_evento }}</h6>
                                <p class="text-base font-normal text-gray-600">
                                    {{ Str::limit($event->descripcion_breve, 100) }}
                                </p>
                            </div>
                        @endforeach
                        @if (count($upcomingEvents) == 0)
                            <p class="text-gray-600">No upcoming events.</p>
                        @endif
                    </div>
                </div>

                <!-- Calendario -->
                <div class="col-span-12 xl:col-span-7 px-2.5 py-5 sm:p-8 bg-gradient-to-b from-white/25 to-white xl:bg-white rounded-2xl shadow-lg max-xl:row-start-1">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
   
@endpush

@push('scripts')
    
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: @json($events), // Aquí se pasan los eventos al calendario

            // Otros ajustes de FullCalendar
            eventClick: function(info) {
                // Aquí puedes manejar el clic en el evento
                alert('Event: ' + info.event.title);
            }
        });

        calendar.render();
        
        Livewire.on('refreshCalendar', () => {
            calendar.refetchEvents(); // Refrescar eventos cuando se emita el evento
        });
    });
</script>
@endpush
