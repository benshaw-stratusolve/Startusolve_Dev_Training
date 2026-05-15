<?php

namespace App\Filament\Resources\Speakers\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SpeakerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                SpatieMediaLibraryFileUpload::make('avatar')
                    ->collection('avatars')
                    ->avatar()
                    ->imageEditor()
                    ->columnSpanFull(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                RichEditor::make('bio')
                    ->columnSpanFull(),
                TextInput::make('twitter_handle'),
                CheckboxList::make('qualifications')
                    ->columnSpanFull()
                    ->columns(3)
                    ->options([
                        'business-leader' => 'Business Leader',
                        'charisma' => 'Charismatic Speaker',
                        'first-time' => 'First Time Speaker',
                        'hometown-hero' => 'Hometown Hero',
                        'humanitarian' => 'Works in Humanitarian Field',
                        'laracasts-contributor' => 'Laracasts Contributor',
                        'twitter-influencer' => 'Large Twitter Following',
                        'youtube-influencer' => 'Large YouTube Following',
                        'open-source' => 'Open Source Creator / Maintainer',
                        'unique-perspective' => 'Unique Perspective',
                    ]),
            ]);
    }
}
