<?php

namespace App\Filament\Resources\Conferences\Schemas;

use App\Enums\Region;
use App\Models\Conference;
use Filament\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ConferenceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Conference Details')
                    ->description('The core information about your conference.')
                    ->icon(Heroicon::PencilSquare)
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Conference Name')
                            ->placeholder('e.g. Laracon US 2026')
                            ->required()
                            ->maxLength(60)
                            ->columnSpanFull(),
                        RichEditor::make('description')
                            ->required()
                            ->columnSpanFull(),
                        DateTimePicker::make('start_date')
                            ->required()
                            ->native(false)
                            ->seconds(false),
                        DateTimePicker::make('end_date')
                            ->required()
                            ->native(false)
                            ->seconds(false),
                        Fieldset::make('Status')
                            ->columnSpanFull()
                            ->columns(2)
                            ->schema([
                                Select::make('status')
                                    ->options([
                                        'draft' => 'Draft',
                                        'published' => 'Published',
                                        'cancelled' => 'Cancelled',
                                        'archived' => 'Archived',
                                    ])
                                    ->default('draft')
                                    ->native(false)
                                    ->required(),
                                Toggle::make('is_published')
                                    ->label('Visible on website')
                                    ->default(false),
                            ]),
                    ]),

                Section::make('Location')
                    ->description('Select the region first to filter available venues.')
                    ->icon(Heroicon::MapPin)
                    ->columns(2)
                    ->schema([
                        Select::make('region')
                            ->required()
                            ->live()
                            ->native(false)
                            ->options(Region::class),
                        Select::make('venue_id')
                            ->label('Venue')
                            ->searchable()
                            ->native(false)
                            ->helperText('Filtered by the selected region.')
                            ->relationship('venue', 'name', modifyQueryUsing: function (Builder $query, Get $get) {
                                $region = $get('region');

                                return $region ? $query->where('region', $region) : $query;
                            }),
                    ]),
                Actions::make([
                    Action::make('fillWithFactory')
                        ->label('Fill with Factory Data')
                        ->icon(Heroicon::Star)
                        ->color('gray')
                        ->visible(function (string $operation): bool {
                            if ($operation !== 'create') {
                                return false;
                            }

                            return app()->environment('local');
                        })
                        ->action(function (Component $livewire): void {
                            $data = Conference::factory()->make()->toArray();

                            $livewire->form->fill($data);
                        }),
                ]),
            ]);
    }
}
