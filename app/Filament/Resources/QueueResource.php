<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QueueResource\Pages;
use App\Models\Queue;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class QueueResource extends Resource
{
    protected static ?string $model = Queue::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('counter_id')
                    ->relationship('counter', 'name')
                    ->required(),

                Forms\Components\Select::make('service_id')
                    ->relationship('service', 'name')
                    ->required(),

                Forms\Components\Select::make('patient_id')
                    ->relationship('patient', 'name')
                    ->required(),

                Forms\Components\TextInput::make('number')
                    ->required()
                    ->numeric(),

                Forms\Components\Select::make('status')
                    ->options([
                        'waiting' => 'Waiting',
                        'called' => 'Called',
                        'served' => 'Served',
                        'canceled' => 'Canceled',
                        'finished' => 'Finished',
                    ])
                    ->required(),

                Forms\Components\DateTimePicker::make('called_at'),
                Forms\Components\DateTimePicker::make('served_at'),
                Forms\Components\DateTimePicker::make('canceled_at'),
                Forms\Components\DateTimePicker::make('finished_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),

                Tables\Columns\TextColumn::make('number')->sortable(),

                Tables\Columns\TextColumn::make('patient.name')
                    ->label('Patient')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('service.name')
                    ->label('Service')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('counter.name')
                    ->label('Counter')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')->sortable(),

                Tables\Columns\TextColumn::make('called_at')->dateTime('d/m/Y H:i'),
                Tables\Columns\TextColumn::make('served_at')->dateTime('d/m/Y H:i'),
                Tables\Columns\TextColumn::make('canceled_at')->dateTime('d/m/Y H:i'),
                Tables\Columns\TextColumn::make('finished_at')->dateTime('d/m/Y H:i'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Bisa tambah RelationManagers misal medicalRecord kalau perlu
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQueues::route('/'),
            'create' => Pages\CreateQueue::route('/create'),
            'edit' => Pages\EditQueue::route('/{record}/edit'),
        ];
    }
}
