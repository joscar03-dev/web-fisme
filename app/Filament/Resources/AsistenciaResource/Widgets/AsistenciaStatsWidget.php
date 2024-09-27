<?php

namespace App\Filament\Resources\AsistenciaResource\Widgets;

use App\Models\Asistencia;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class AsistenciaStatsWidget extends ChartWidget
{
    protected static ?string $heading = 'Asistencias por Fecha';

    protected int $daysToShow = 30;

    protected function getData(): array
    {
        $data = Asistencia::select(DB::raw('DATE(fecha) as date'), DB::raw('COUNT(*) as count'))
            ->where('fecha', '>=', Carbon::now()->subDays($this->daysToShow))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = [];
        $asistenciasData = [];

        foreach ($data as $item) {
            $labels[] = Carbon::parse($item->date)->format('d/m');
            $asistenciasData[] = $item->count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Asistencias',
                    'data' => $asistenciasData,
                    'backgroundColor' => '#3B82F6', // Color azul
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Número de Asistencias',
                    ],
                ],
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Fecha',
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
                'tooltip' => [
                    'mode' => 'index',
                    'intersect' => false,
                ],
            ],
            'responsive' => true,
            'maintainAspectRatio' => false,
        ];
    }
}

