<?php

namespace App\Filament\Widgets;

use App\Models\Reservation;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class ReservationStats extends BaseWidget
{
    protected function getCards(): array
    {
        // Total penumpang hari ini
        $todayCount = Reservation::whereDate('created_at', now())->sum('passenger_count');

        // Jadwal paling populer
        $mostPickedSchedule = Reservation::select('shuttle_schedule_id', DB::raw('COUNT(*) as total'))
            ->groupBy('shuttle_schedule_id')
            ->orderByDesc('total')
            ->with('shuttleSchedule')
            ->first();

        $mostPicked = $mostPickedSchedule && $mostPickedSchedule->shuttleSchedule
            ? ucfirst($mostPickedSchedule->shuttleSchedule->type) . ' ' . $mostPickedSchedule->shuttleSchedule->time
            : 'Belum ada data';

        // Perbandingan penumpang antar hotel
        $ibisStyles = Reservation::where('hotel', 'ibis_styles')->sum('passenger_count');
        $ibisBudget = Reservation::where('hotel', 'ibis_budget')->sum('passenger_count');

        return [
            Stat::make('Penumpang Hari Ini', $todayCount . ' orang'),

            Stat::make('Jadwal Paling Populer', $mostPicked),

            Stat::make('Ibis Styles vs Ibis Budget', "Styles: $ibisStyles | Budget: $ibisBudget"),
        ];
    }
}
