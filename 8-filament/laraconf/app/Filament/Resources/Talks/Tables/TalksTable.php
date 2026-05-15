<?php

namespace App\Filament\Resources\Talks\Tables;

use App\Enums\TalkStatus;
use App\Models\Talk;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class TalksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->persistFiltersInSession()
            ->columns([
                TextColumn::make('title')
                    ->sortable()
                    ->searchable()
                    ->description(fn (Talk $record): string => Str::limit($record->abstract, 40)),
                ImageColumn::make('speaker.avatar')
                    ->label('Speaker Avatar')
                    ->circular()
                    ->alignCenter()
                    ->defaultImageUrl(fn (Talk $record): string => 'https://ui-avatars.com/api/?background=0D8ABC&color=fff&name='.urlencode($record->speaker->name)),
                TextColumn::make('speaker.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->sortable(),
                IconColumn::make('new_talk')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('new_talk'),
                SelectFilter::make('speaker')
                    ->relationship('speaker', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->headerActions([
                Action::make('export')
                    ->action(function ($livewire): void {
                        $livewire->getFilteredTableQuery();
                    })
                    ->tooltip('Exports all records matching the current filters'),
            ])
            ->recordActions([
                EditAction::make()
                    ->slideOver(),
                ActionGroup::make([
                    Action::make('approve')
                        ->icon(Heroicon::CheckCircle)
                        ->color('success')
                        ->action(function (Talk $record): void {
                            $record->approve();

                            Notification::make()
                                ->success()
                                ->title('Talk approved')
                                ->body('The speaker has been notified.')
                                ->duration(2000)
                                ->send();
                        })
                        ->hidden(fn (Talk $record): bool => $record->status === TalkStatus::APPROVED),
                    Action::make('reject')
                        ->icon(Heroicon::NoSymbol)
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(function (Talk $record): void {
                            $record->reject();

                            Notification::make()
                                ->danger()
                                ->title('Talk rejected')
                                ->body('The speaker has been notified.')
                                ->duration(2000)
                                ->send();
                        })
                        ->hidden(fn (Talk $record): bool => $record->status === TalkStatus::REJECTED),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('approve')
                        ->icon(Heroicon::CheckCircle)
                        ->color('success')
                        ->action(function (Collection $records): void {
                            $records->each->approve();

                            Notification::make()
                                ->success()
                                ->title('Talks approved')
                                ->body('The speakers have been notified.')
                                ->send();
                        }),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
