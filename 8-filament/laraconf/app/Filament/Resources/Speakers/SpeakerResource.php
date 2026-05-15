<?php

namespace App\Filament\Resources\Speakers;

use App\Enums\TalkStatus;
use App\Filament\Resources\Speakers\Pages\CreateSpeaker;
use App\Filament\Resources\Speakers\Pages\ListSpeakers;
use App\Filament\Resources\Speakers\Pages\ViewSpeaker;
use App\Filament\Resources\Speakers\RelationManagers\TalksRelationManager;
use App\Filament\Resources\Speakers\Schemas\SpeakerForm;
use App\Filament\Resources\Speakers\Tables\SpeakersTable;
use App\Models\Speaker;
use BackedEnum;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class SpeakerResource extends Resource
{
    protected static ?string $model = Speaker::class;

    protected static string|BackedEnum|null $navigationIcon = null;

    protected static string|UnitEnum|null $navigationGroup = 'Program';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return SpeakerForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Personal Information')
                    ->columnSpanFull()
                    ->columns(3)
                    ->schema([
                        SpatieMediaLibraryImageEntry::make('avatar')
                            ->collection('avatars')
                            ->circular(),
                        Group::make([
                            TextEntry::make('name'),
                            TextEntry::make('email')
                                ->label('Email address'),
                            TextEntry::make('twitter_handle')
                                ->label('Twitter')
                                ->url(fn (Speaker $record): ?string => $record->twitter_handle
                                    ? 'https://twitter.com/'.$record->twitter_handle
                                    : null
                                )
                                ->getStateUsing(fn (Speaker $record): string => $record->twitter_handle
                                    ? '@'.$record->twitter_handle
                                    : 'N/A'
                                ),
                            TextEntry::make('hasSpoken')
                                ->label('Previous Speaker?')
                                ->getStateUsing(fn (Speaker $record): string => $record->talks()
                                    ->where('status', TalkStatus::APPROVED)
                                    ->count() > 0
                                    ? 'Previous Speaker'
                                    : 'Has Not Spoken'
                                )
                                ->badge()
                                ->color(fn (string $state): string => $state === 'Previous Speaker'
                                    ? 'success'
                                    : 'primary'
                                ),
                        ])
                            ->columns(2)
                            ->columnSpan(2),
                    ]),
                Section::make('Other Information')
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('bio')
                            ->html()
                            ->extraAttributes(['class' => 'prose dark:prose-invert max-w-none']),
                        TextEntry::make('qualifications'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return SpeakersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            TalksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSpeakers::route('/'),
            'create' => CreateSpeaker::route('/create'),
            'view' => ViewSpeaker::route('/{record}'),
        ];
    }
}
