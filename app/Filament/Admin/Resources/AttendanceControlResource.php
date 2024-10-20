<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AttendanceControlResource\Pages;
use App\Models\AttendanceControl;
use App\Models\Recruits;
use App\Models\Trainings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AttendanceControlResource extends Resource
{
    protected static ?string $model = AttendanceControl::class;

    protected static ?string $navigationIcon = 'phosphor-calendar-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('training_id')
                    ->label('Training')
                    ->options(Trainings::all()->pluck('training_id', 'training_id'))
                    ->required(),

                Forms\Components\Select::make('recruit_id')
                    ->label('Recruit')
                    ->options(Recruits::all()->pluck('full_name', 'recruit_id'))
                    ->required(),

                Forms\Components\DatePicker::make('date')
                    ->label('Date')
                    ->required(),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'Present' => 'Present',
                        'Absent' => 'Absent',
                        'Late' => 'Late',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('attendance_id')->label('Attendance ID')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('training_id')->label('Training ID')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('recruit_id')->label('Recruit ID')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('date')->label('Date')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('status')->label('Status')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttendanceControl::route('/'),
            'create' => Pages\CreateAttendanceControl::route('/create'),
            'edit' => Pages\EditAttendanceControl::route('/{record}/edit'),
            'view' => Pages\ViewAttendanceControl::route('/{record}'),
        ];
    }
}
