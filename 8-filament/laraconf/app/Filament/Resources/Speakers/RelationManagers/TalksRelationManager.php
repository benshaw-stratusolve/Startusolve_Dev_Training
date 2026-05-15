<?php

namespace App\Filament\Resources\Speakers\RelationManagers;

use App\Filament\Resources\Talks\Schemas\TalkForm;
use App\Filament\Resources\Talks\TalkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Override;

class TalksRelationManager extends RelationManager
{
    protected static string $relationship = 'talks';

    protected static ?string $relatedResource = TalkResource::class;

    #[Override]
    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Schema $schema): Schema
    {
        return TalkForm::configure($schema, hideSpeaker: true);
    }

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
