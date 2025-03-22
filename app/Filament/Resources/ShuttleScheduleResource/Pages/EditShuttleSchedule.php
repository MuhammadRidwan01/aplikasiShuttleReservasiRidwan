<?php

namespace App\Filament\Resources\ShuttleScheduleResource\Pages;

use App\Filament\Resources\ShuttleScheduleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShuttleSchedule extends EditRecord
{
    protected static string $resource = ShuttleScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
