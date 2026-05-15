<?php

namespace App\Filament\Resources\Attendees;

use App\Filament\Resources\Attendees\Pages\CreateAttendee;
use App\Filament\Resources\Attendees\Pages\EditAttendee;
use App\Filament\Resources\Attendees\Pages\ListAttendees;
use App\Filament\Resources\Attendees\Schemas\AttendeeForm;
use App\Filament\Resources\Attendees\Tables\AttendeesTable;
use App\Filament\Resources\Attendees\Widgets\AttendeeChartWidget;
use App\Filament\Resources\Attendees\Widgets\AttendeesStatsWidget;
use App\Models\Attendee;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use UnitEnum;

class AttendeeResource extends Resource
{
    protected static ?string $model = Attendee::class;

    protected static string|BackedEnum|null $navigationIcon = null;

    protected static string|UnitEnum|null $navigationGroup = 'Conference Operations';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return AttendeeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AttendeesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getWidgets(): array
    {
        return [
            AttendeesStatsWidget::class,
            AttendeeChartWidget::class,
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) Attendee::query()->count('id');
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return Attendee::query()->exists() ? 'success' : 'gray';
    }

    /**
     * @return array<string, string>
     */
    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Conference' => $record->conference?->name ?? 'None',
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()
            ->with('conference');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAttendees::route('/'),
            'create' => CreateAttendee::route('/create'),
            'edit' => EditAttendee::route('/{record}/edit'),
        ];
    }
}
