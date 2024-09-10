<div class="relative bg-stone-50">
    <div class="bg-sky-400 w-full sm:w-40 h-40 rounded-full absolute top-1 opacity-20 max-sm:right-0 sm:left-56 z-0"></div>
    <div class="bg-emerald-500 w-full sm:w-40 h-24 absolute top-0 -left-0 opacity-20 z-0"></div>
    <div class="bg-purple-600 w-full sm:w-40 h-24 absolute top-40 -left-0 opacity-20 z-0"></div>
    <div class="w-full py-24 relative z-10 backdrop-blur-3xl">
        <div class="w-full max-w-7xl mx-auto px-2 lg:px-8">
            <div class="grid grid-cols-12 gap-8 max-w-4xl mx-auto xl:max-w-full">
                <div class="col-span-12 xl:col-span-5">
                    <h2 class="font-manrope text-3xl leading-tight text-gray-900 mb-1.5">Upcoming Events</h2>
                    <p class="text-lg font-normal text-gray-600 mb-8">Don't miss schedule</p>
                    <div class="flex gap-5 flex-col">
                        @php
                            $upcomingEvents = $events->flatten()->sortBy('fecha_inicio')->take(3);
                        @endphp
                        @forelse($upcomingEvents as $event)
                            <div class="p-6 rounded-xl bg-white">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-2.5">
                                        <span class="w-2.5 h-2.5 rounded-full bg-purple-600"></span>
                                        <p class="text-base font-medium text-gray-900">{{ Carbon\Carbon::parse($event->fecha_inicio)->format('M d, Y - H:i') }} - {{ Carbon\Carbon::parse($event->fecha_fin)->format('H:i') }}</p>
                                    </div>
                                </div>
                                <h6 class="text-xl leading-8 font-semibold text-black mb-1">{{ $event->nombre_evento }}</h6>
                                <p class="text-base font-normal text-gray-600">{{ Str::limit($event->descripcion_breve, 100) }}</p>
                            </div>
                        @empty
                            <p class="text-gray-600">No upcoming events.</p>
                        @endforelse
                    </div>
                </div>
                <div class="col-span-12 xl:col-span-7 px-2.5 py-5 sm:p-8 bg-gradient-to-b from-white/25 to-white xl:bg-white rounded-2xl max-xl:row-start-1">
                    <div class="flex flex-col md:flex-row gap-4 items-center justify-between mb-5">
                        <div class="flex items-center gap-4">
                            <h5 class="text-xl leading-8 font-semibold text-gray-900">{{ Carbon\Carbon::create($currentYear, $currentMonth, 1)->format('F Y') }}</h5>
                            <div class="flex items-center">
                                <button wire:click="previousMonth" class="text-indigo-600 p-1 rounded transition-all duration-300 hover:text-white hover:bg-indigo-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M10.0002 11.9999L6 7.99971L10.0025 3.99719" stroke="currentcolor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                                <button wire:click="nextMonth" class="text-indigo-600 p-1 rounded transition-all duration-300 hover:text-white hover:bg-indigo-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M6.00236 3.99707L10.0025 7.99723L6 11.9998" stroke="currentcolor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Formulario de selección de fechas -->
                    <div class="mb-5">
                        <div class="flex items-center gap-4 mb-2">
                            <label for="start-date" class="text-gray-600">Start Date:</label>
                            <input type="date" wire:model="startDate" id="start-date" class="border border-gray-300 p-2 rounded" />
                        </div>
                        <div class="flex items-center gap-4">
                            <label for="end-date" class="text-gray-600">End Date:</label>
                            <input type="date" wire:model="endDate" id="end-date" class="border border-gray-300 p-2 rounded" />
                        </div>
                    </div>

                    <div class="border border-indigo-200 rounded-xl">
                        <div class="grid grid-cols-7 rounded-t-3xl border-b border-indigo-200">
                            @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                                <div class="py-3.5 border-r last:border-r-0 border-indigo-200 bg-indigo-50 flex items-center justify-center text-sm font-medium text-indigo-600">
                                    {{ $day }}
                                </div>
                            @endforeach
                        </div>
                        <div class="grid grid-cols-7 rounded-b-xl">
                            @foreach($calendar as $week)
                                @foreach($week as $day)
                                    @if($day)
                                        <div class="flex xl:aspect-square max-xl:min-h-[60px] p-3.5 relative bg-white border-r last:border-r-0 border-b border-indigo-200">
                                            <div class="text-lg text-gray-800">{{ $day['day'] }}</div>
                                            <div class="absolute right-2 top-2">
                                                @foreach($day['events'] as $event)
                                                    <span class="block text-xs text-indigo-500">{{ $event->nombre_evento }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex xl:aspect-square max-xl:min-h-[60px] p-3.5 bg-gray-100 border-r last:border-r-0 border-b border-indigo-200"></div>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
