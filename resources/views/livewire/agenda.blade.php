<div>
    <div class="container mx-auto p-4">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Encabezado del Calendario -->
            <div class="flex items-center justify-between p-4 bg-gray-50 border-b">
                <div class="flex items-center space-x-2">
                    <button wire:click="mesAnterior" class="p-2 rounded-full hover:bg-gray-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <button wire:click="mesSiguiente" class="p-2 rounded-full hover:bg-gray-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <button wire:click="irAHoy" class="px-3 py-1 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        Hoy
                    </button>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">
                    {{ Carbon\Carbon::create($currentYear, $currentMonth, 1)->locale('es')->isoFormat('MMMM YYYY') }}
                </h2>
                <div class="flex space-x-2">
                    <button wire:click="cambiarVista('mes')" class="px-3 py-1 text-sm font-medium {{ $vista === 'mes' ? 'bg-blue-500 text-white' : 'text-gray-700 bg-white border border-gray-300' }} rounded-md hover:bg-blue-600 hover:text-white">
                        Mes
                    </button>
                    <button wire:click="cambiarVista('semana')" class="px-3 py-1 text-sm font-medium {{ $vista === 'semana' ? 'bg-blue-500 text-white' : 'text-gray-700 bg-white border border-gray-300' }} rounded-md hover:bg-blue-600 hover:text-white">
                        Semana
                    </button>
                    <button wire:click="cambiarVista('dia')" class="px-3 py-1 text-sm font-medium {{ $vista === 'dia' ? 'bg-blue-500 text-white' : 'text-gray-700 bg-white border border-gray-300' }} rounded-md hover:bg-blue-600 hover:text-white">
                        Día
                    </button>
                    <button wire:click="cambiarVista('lista')" class="px-3 py-1 text-sm font-medium {{ $vista === 'lista' ? 'bg-blue-500 text-white' : 'text-gray-700 bg-white border border-gray-300' }} rounded-md hover:bg-blue-600 hover:text-white">
                        Lista
                    </button>
                </div>
            </div>

            <!-- Cuadrícula del Calendario -->
            <div class="grid grid-cols-7 gap-px bg-gray-200">
                @foreach (['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'] as $diaSemana)
                    <div class="text-center font-semibold text-gray-700 bg-gray-100 py-2">
                        {{ $diaSemana }}
                    </div>
                @endforeach

                @foreach ($calendar as $week)
                    @foreach ($week as $day)
                        <div class="min-h-[100px] bg-white p-1 relative">
                            @if ($day['date'])
                                <span class="absolute top-1 left-1 text-sm {{ $day['date']->isToday() ? 'font-bold text-blue-600' : 'text-gray-700' }}">
                                    {{ $day['date']->day }}
                                </span>
                                @if ($day['has_events'])
                                    <div class="mt-6 space-y-1">
                                        @foreach ($day['events'] as $event)
                                            <div class="text-xs p-1 rounded truncate {{ $event['color'] }} text-white" title="{{ $event['title'] }}">
                                                {{ $event['title'] }}
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @endif
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>

        <!-- Próximos Eventos -->
        <div class="mt-8 bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="bg-gray-50 px-4 py-3 border-b">
                <h3 class="text-lg font-semibold text-gray-800">Próximos Eventos</h3>
            </div>
            <div class="p-4">
                @if (count($upcomingEvents) > 0)
                    <ul class="space-y-4">
                        @foreach ($upcomingEvents as $event)
                            <li class="flex items-center space-x-4">
                                <div class="w-2 h-2 rounded-full {{ $event->color }}"></div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">{{ $event->nombre_evento }}</h4>
                                    <p class="text-sm text-gray-600">
                                        {{ $event->fecha_inicio->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY, HH:mm') }}
                                    </p>
                                </div>
                                <a wire:key="{{ $event->slug }}"
                                    href="{{ route('evento.detalle', $event->slug) }}"
                                    class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm md:text-base font-medium rounded-md text-white bg-[#001f54e6] hover:bg-blue-500 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                                    Inscríbete ahora
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-600">No hay eventos próximos.</p>
                @endif
            </div>
        </div>

        <!-- Mensajes Flash -->
        @if (session()->has('message'))
            <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('warning'))
            <div class="mt-4 p-4 bg-yellow-100 text-yellow-700 rounded-lg">
                {{ session('warning') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mt-4 p-4 bg-red-100 text-red-700 rounded-lg">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <!-- Contenedor de FullCalendar -->
    <div wire:ignore>
        <div id="calendar" class="mt-8"></div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
            initialView: 'dayGridMonth',
            events: @json($events),
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week: 'Semana',
                day: 'Día',
                list: 'Lista'
            },
            locale: 'es',
            editable: true,
            eventLimit: true,
            dayMaxEvents: true
        });
        calendar.render();

        Livewire.on('refreshCalendar', () => {
            calendar.refetchEvents();
        });

        @this.on('eventsLoaded', (events) => {
            calendar.removeAllEvents();
            calendar.addEventSource(events);
        });
    });
</script>
@endpush