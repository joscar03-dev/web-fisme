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

    public function mount()
    {
        $this->currentMonth = Carbon::now()->month;
        $this->currentYear = Carbon::now()->year;

        // Definimos fechas iniciales para el rango
        $this->startDate = Carbon::now()->startOfMonth();
        $this->endDate = Carbon::now()->endOfMonth();

        $this->loadEvents();
    }

    public function loadEvents()
    {
        $this->events = Evento::whereBetween('fecha_inicio', [$this->startDate, $this->endDate])
            ->get()
            ->groupBy(function($event) {
                return Carbon::parse($event->fecha_inicio)->format('Y-m-d');
            });
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

        // Add empty cells for days before the first of the month
        for ($i = 1; $i < $firstDayOfWeek; $i++) {
            $week[] = null;
        }

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $currentDate = $date->copy()->setDay($day);
            $dateKey = $currentDate->format('Y-m-d');
            $week[] = [
                'day' => $day,
                'date' => $currentDate,
                'events' => $this->events->get($dateKey, new Collection()),
            ];

            if (count($week) == 7) {
                $calendar[] = $week;
                $week = [];
            }
        }

        // Add empty cells for days after the last day of the month
        while (count($week) < 7 && !empty($week)) {
            $week[] = null;
        }

        if (!empty($week)) {
            $calendar[] = $week;
        }

        return $calendar;
    }
}
