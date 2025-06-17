<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityResource\Pages;
use App\Filament\Resources\ActivityResource\RelationManagers;
use Spatie\Activitylog\Models\Activity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $label = 'Activity Logs';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationBadgeTooltip = 'Total Activity';
    
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->since()
                    ->label('Time'),
                Tables\Columns\TextColumn::make('log_name')
                    ->label('Type Log (Action)')
                    ->getStateUsing(fn ($record) => $record->log_name . ' (' . $record->description . ')'),
                Tables\Columns\TextColumn::make('causer.name')->label('Created by')
                    ->default('-'),
                Tables\Columns\TextColumn::make('properties')->label('Messege'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivities::route('/'),
        ];
    }
}
