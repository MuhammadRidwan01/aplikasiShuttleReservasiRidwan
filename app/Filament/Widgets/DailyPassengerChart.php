<?php

namespace App\Filament\Widgets;

use App\Models\Reservation;
use Filament\Widgets\ChartWidget;

class DailyPassengerChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Penumpang per Hari';

    protected function getData(): array
    {
        $data = Reservation::selectRaw('DATE(created_at) as date, SUM(passenger_count) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Penumpang',
                    'data' => $data->pluck('total'),
                    'backgroundColor' => '#3b82f6',
                ],
            ],
            'labels' => $data->pluck('date')->map(fn($d) => date('d M', strtotime($d))),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

}
