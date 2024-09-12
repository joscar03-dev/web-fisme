<?php

namespace App\Livewire;

use App\Models\Evento;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class Agenda extends Component
{
    public $events;
    public array $sendToView = [];
    public $startDate;
    public $endDate;
    public $currentMonth;
    public $currentYear;
    public $upcomingEvents;
    public $eventsByDate;

    public function mount()
    {
        $this->currentMonth = Carbon::now()->month;
        $this->currentYear = Carbon::now()->year;
        $this->setMonthBoundaries();
        $this->loadEvents();
        $this->loadUpcomingEvents();
    }

    private function setMonthBoundaries()
    {
        $this->startDate = Carbon::create($this->currentYear, $this->currentMonth, 1)->startOfMonth();
        $this->endDate = Carbon::create($this->currentYear, $this->currentMonth, 1)->endOfMonth();
    }

    public function loadUpcomingEvents()
    {
        $this->upcomingEvents = Evento::where('fecha_inicio', '>=', now())->get();
    }

    public function loadEvents()
    {
        // Cargar eventos del mes actual
        $this->events = Evento::whereBetween('fecha_inicio', [$this->startDate, $this->endDate])
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->titulo,
                    'start' => $event->fecha_inicio->toDateTimeString(),
                    'end' => $event->fecha_fin ? $event->fecha_fin->toDateTimeString() : null,
                    'description' => $event->descripcion,
                ];
            });

        $this->eventsByDate = $this->events->groupBy(function ($event) {
            return Carbon::parse($event['start'])->format('Y-m-d');
        }) ?? collect(); // Asegúrate de que no sea null
    }

    public function nextMonth()
    {
        $this->currentMonth++;
        if ($this->currentMonth > 12) {
            $this->currentMonth = 1;
            $this->currentYear++;
        }
        $this->setMonthBoundaries();
        $this->loadEvents();
        $this->emit('monthChanged');
    }

    public function previousMonth()
    {
        $this->currentMonth--;
        if ($this->currentMonth < 1) {
            $this->currentMonth = 12;
            $this->currentYear--;
        }
        $this->setMonthBoundaries();
        $this->loadEvents();
        $this->emit('monthChanged');
    }

    public function registerForEvent($eventId)
    {
        $event = Evento::find($eventId);
        if ($event) {
            // Verifica si el usuario ya está registrado
            if (!$event->attendees()->where('user_id', auth()->user()->id)->exists()) {
                $event->attendees()->attach(auth()->user()->id);
                session()->flash('message', 'Te has registrado exitosamente en el evento.');
            } else {
                session()->flash('warning', 'Ya estás registrado en este evento.');
            }
        } else {
            session()->flash('error', 'Evento no encontrado.');
        }
    }

    public function updatedCurrentMonth()
    {
        $this->loadEvents();
        $this->emit('refreshCalendar');
    }
    
    public function updatedCurrentYear()
    {
        $this->loadEvents();
        $this->emit('refreshCalendar');
    }

    public function updatedStartDate()
    {
        $this->loadEvents();
    }

    public function updatedEndDate()
    {
        $this->loadEvents();
    }

    public function render()
    {
        $calendar = $this->generateCalendar();
        return view('livewire.agenda', [
            'events' => $this->events,
            'upcomingEvents' => $this->upcomingEvents,
            'calendar' => $calendar,
        ]);
    }

    private function generateCalendar()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1);
        $daysInMonth = $date->daysInMonth;
        $firstDayOfWeek = $date->copy()->firstOfMonth()->dayOfWeek;

        $calendar = [];
        $week = [];

        for ($i = 0; $i < $firstDayOfWeek; $i++) {
            $week[] = null;
        }

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $currentDate = $date->copy()->setDay($day);
            $dateKey = $currentDate->format('Y-m-d');
            $eventsOnThisDay = $this->eventsByDate->get($dateKey, collect());

            $week[] = [
                'day' => $day,
                'date' => $currentDate,
                'events' => $eventsOnThisDay,
                'has_events' => $eventsOnThisDay->isNotEmpty(),
            ];

            if (count($week) == 7) {
                $calendar[] = $week;
                $week = [];
            }
        }

        while (count($week) < 7 && !empty($week)) {
            $week[] = null;
        }

        if (!empty($week)) {
            $calendar[] = $week;
        }

        return $calendar;
    }
    
}
