<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShuttleScheduleResource\Pages;
use App\Filament\Resources\ShuttleScheduleResource\RelationManagers;
use App\Models\ShuttleSchedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShuttleScheduleResource extends Resource
{
    protected static ?string $model = ShuttleSchedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('type')
                ->label('Jenis Shuttle')
                ->options([
                    'drop_off' => 'Drop Off',
                    'pick_up' => 'Pick Up',
                ])
                ->searchable()
                ->required()
                ->helperText('Pilih jenis shuttle penumpang')
                ->placeholder('Pilih Jenis Shuttle'),

            Forms\Components\TimePicker::make('time')
                ->label('Waktu')
                ->required()
                ->displayFormat('H:i')
                ->helperText('Masukkan waktu keberangkatan/penjemputan'),
        ]);

    }

    public static function table(Table $table): Table
    {
        return $table
    ->columns([
        Tables\Columns\BadgeColumn::make('type')
            ->label('Jenis Shuttle')
            ->colors([
                'success' => fn ($state) => $state === 'drop_off',
                'info' => fn ($state) => $state === 'pick_up',
            ])
            ->formatStateUsing(fn ($state) => ucfirst(str_replace('_', ' ', $state)))
            ->sortable()
            ->searchable(),

        Tables\Columns\TextColumn::make('time')
            ->label('Waktu')
            ->sortable()
            ->searchable()
            ->dateTime('H:i'),
    ])
    ->filters([
        Tables\Filters\SelectFilter::make('type')
            ->label('Filter Shuttle')
            ->options([
                'drop_off' => 'Drop Off',
                'pick_up' => 'Pick Up',
            ]),
    ])
    ->actions([
        Tables\Actions\EditAction::make(),
        Tables\Actions\DeleteAction::make(),
    ])
    ->striped()
    ->paginated()
    ->defaultSort('time', 'asc')
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShuttleSchedules::route('/'),
            'create' => Pages\CreateShuttleSchedule::route('/create'),
            'edit' => Pages\EditShuttleSchedule::route('/{record}/edit'),
        ];
    }
}
