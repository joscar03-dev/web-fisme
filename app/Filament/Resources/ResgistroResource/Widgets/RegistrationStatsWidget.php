<?php

namespace App\Filament\Resources\ResgistroResource\Widgets;

use App\Models\Resgistro;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class RegistrationStatsWidget extends ChartWidget
{
    protected static ?string $heading = 'Registros por Fecha';

    protected int $daysToShow = 30;

    protected function getData(): array
    {
        $data = Resgistro::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subDays($this->daysToShow))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = [];
        $verifiedData = [];
        $unverifiedData = [];

        foreach ($data as $item) {
            $labels[] = Carbon::parse($item->date)->format('d/m');
            $verifiedCount = Resgistro::where('created_at', 'LIKE', $item->date . '%')
                ->where('verificado', true)
                ->count();
            $unverifiedCount = $item->count - $verifiedCount;

            $verifiedData[] = $verifiedCount;
            $unverifiedData[] = $unverifiedCount;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Verificados',
                    'data' => $verifiedData,
                    'backgroundColor' => '#10B981', // Color verde
                ],
                [
                    'label' => 'No Verificados',
                    'data' => $unverifiedData,
                    'backgroundColor' => '#EF4444', // Color rojo
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
                        'text' => 'Número de Registros',
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