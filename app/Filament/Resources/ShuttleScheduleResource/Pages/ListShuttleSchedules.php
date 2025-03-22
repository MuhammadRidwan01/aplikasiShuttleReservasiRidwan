<?php

namespace App\Filament\Resources\ShuttleScheduleResource\Pages;

use App\Filament\Resources\ShuttleScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShuttleSchedules extends ListRecords
{
    protected static string $resource = ShuttleScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
