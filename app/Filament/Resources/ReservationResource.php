<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages;
use App\Filament\Resources\ReservationResource\RelationManagers;
use App\Models\Reservation;
use App\Models\ShuttleSchedule;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('guest_name')
                ->label('Guest Name')
                ->required(),

            TextInput::make('room_number')
                ->label('Room Number')
                ->required(),

            Select::make('shuttle_schedule_id')
                ->label('Shuttle Time')
                ->options(
                    ShuttleSchedule::all()->groupBy('type')->map(function ($group, $type) {
                        return $group->mapWithKeys(function ($item) {
                            return [$item->id => $item->time];
                        });
                    })->toArray()
                )
                ->searchable()
                ->required()
                ->hint('Grouped by Drop Off / Pick Up'),

            Select::make('hotel')
                ->label('Hotel')
                ->options([
                    'ibis_styles' => 'Ibis Styles',
                    'ibis_budget' => 'Ibis Budget',
                ])
                ->required(),

            TextInput::make('passenger_count')
                ->label('Passenger Count')
                ->numeric()
                ->minValue(1)
                ->required(),

            TextInput::make('phone_number')
                ->label('Phone Number')
                ->tel()
                ->placeholder('+62...')
                ->nullable()->rule('regex:/^(?:\+62|0)[0-9]{9,13}$/'),
                ]);
    }

    public static function table(Table $table): Table
    {
        $isAndroid = str_contains(strtolower(request()->userAgent()), 'android');

        return $table
        ->columns($isAndroid ? self::androidColumns() : self::desktopColumns())
        ->defaultSort('created_at', 'desc')
        ->filters([])
        ->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ])
    ->defaultSort('created_at', 'desc')
    ->filters([])
    ->actions([
        Tables\Actions\ViewAction::make(),
        Tables\Actions\EditAction::make(),
        Tables\Actions\DeleteAction::make(),
    ])
    ->bulkActions([
        Tables\Actions\DeleteBulkAction::make(),
    ]);

    }
    protected static function desktopColumns(): array
{
    return [
        TextColumn::make('booking_code')->searchable(),
        TextColumn::make('guest_name')->label('Guest Name')->searchable(),
        TextColumn::make('room_number')->label('Room No.')->searchable(),
        TextColumn::make('shuttleSchedule.time')->label('Shuttle Time')->sortable(),
        TextColumn::make('shuttleSchedule.type')
            ->label('Shuttle Type')
            ->badge()
            ->color(fn (string $state) => $state === 'pick_up' ? 'success' : 'info'),
        TextColumn::make('hotel')
            ->label('Hotel')
            ->formatStateUsing(fn ($state) => $state === 'ibis_styles' ? 'Ibis Styles' : 'Ibis Budget'),
        TextColumn::make('passenger_count')->label('Passengers')->sortable(),
        TextColumn::make('phone_number')->label('Phone'),
        TextColumn::make('created_at')->label('Booked At')->dateTime('d M Y H:i')->sortable(),
    ];
}

protected static function androidColumns(): array
{
    return [
        TextColumn::make('booking_code')->prefix('ID-')->searchable(),
        TextColumn::make('guest_name')->label('Guest Name')->weight('bold')->searchable(),
        Stack::make([
            TextColumn::make('room_number')->label('Room No.')->searchable(),
            TextColumn::make('shuttleSchedule.time')->label('Shuttle Time')->sortable(),
            TextColumn::make('shuttleSchedule.type')
                ->label('Shuttle Type')
                ->badge()
                ->color(fn (string $state): string => $state === 'pick_up' ? 'success' : 'info'),
        ]),
        Stack::make([
            TextColumn::make('hotel')
                ->label('Hotel')
                ->formatStateUsing(fn ($state): string => $state === 'ibis_styles' ? 'Ibis Styles' : 'Ibis Budget'),
            TextColumn::make('passenger_count')->label('Passengers')->suffix(' orang')->sortable(),
            TextColumn::make('phone_number')->label('Phone'),
        ]),
        TextColumn::make('created_at')->label('Booked At')->dateTime('d M Y H:i')->sortable(),
    ];
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
            'index' => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservation::route('/create'),
            'edit' => Pages\EditReservation::route('/{record}/edit'),
        ];
    }
}
