<?php

namespace App\Filament\Resources\Attendees\Widgets;

use App\Filament\Resources\Attendees\Pages\ListAttendees;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Illuminate\Support\Number;

class AttendeesStatsWidget extends StatsOverviewWidget
{
    use InteractsWithPageTable;

    protected ?string $pollingInterval = '1s';

    protected function getColumns(): int
    {
        return 2;
    }

    protected function getStats(): array
    {
        $query = $this->getPageTableQuery();
        $attendeesCount = (clone $query)->count('attendees.id');
        $revenue = (clone $query)->sum('ticket_cost') / 100;

        $attendeesByDay = collect(range(6, 0))
            ->map(fn (int $daysAgo): int => (clone $query)
                ->whereDate('attendees.created_at', now()->subDays($daysAgo))
                ->count('attendees.id'))
            ->toArray();

        return [
            Stat::make('Attendees', (string) $attendeesCount)
                ->description('Total number of attendees')
                ->descriptionIcon('heroicon-m-user-group')
                ->chart($attendeesByDay)
                ->color('success'),
            Stat::make('Total Revenue', Number::currency($revenue, 'USD'))
                ->description('Paid ticket revenue')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color($revenue > 0 ? 'success' : 'gray'),
        ];
    }

    protected function getTablePage(): string
    {
        return ListAttendees::class;
    }
}
