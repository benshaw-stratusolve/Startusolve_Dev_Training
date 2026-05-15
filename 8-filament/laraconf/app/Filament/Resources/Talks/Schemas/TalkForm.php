<?php

namespace App\Filament\Resources\Talks\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TalkForm
{
    public static function configure(Schema $schema, bool $hideSpeaker = false): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Textarea::make('abstract')
                    ->required()
                    ->columnSpanFull(),
                Select::make('speaker_id')
                    ->label('Speaker')
                    ->relationship('speaker', 'name')
                    ->searchable()
                    ->required()
                    ->hidden($hideSpeaker),
            ]);
    }
}
