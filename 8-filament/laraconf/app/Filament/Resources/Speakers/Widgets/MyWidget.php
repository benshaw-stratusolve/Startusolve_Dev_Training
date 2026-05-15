<?php

namespace App\Filament\Resources\Speakers\Widgets;

use App\Models\Speaker;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Override;

class MyWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $speakersByMonth = collect(range(5, 0))
            ->map(fn (int $monthsAgo) => Speaker::query()
                ->whereBetween('created_at', [
                    now()->subMonths($monthsAgo)->startOfMonth(),
                    now()->subMonths($monthsAgo)->endOfMonth(),
                ], 'and')
                ->count('id'))
            ->toArray();

        $totalSpeakers = Speaker::query()->count('id');
        $bookedSpeakers = Speaker::query()->whereHas('conferences', fn ($q) => $q)->count('id');
        $qualifiedSpeakers = Speaker::query()
            ->whereNotNull('qualifications', 'and')
            ->where('qualifications', '!=', '[]')
            ->count('id');

        $pct = fn (int $value): string => $totalSpeakers > 0
            ? intval($value / $totalSpeakers * 100).'% of all speakers'
            : 'No speakers yet';

        return [
            Stat::make('Total Speakers', (string) $totalSpeakers)
                ->description('Registered in the system')
                ->descriptionIcon('heroicon-m-user-group')
                ->chart($speakersByMonth)
                ->color('primary'),

            Stat::make('Booked for Conferences', (string) $bookedSpeakers)
                ->description($pct($bookedSpeakers))
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color($bookedSpeakers > 0 ? 'success' : 'gray'),

            Stat::make('With Qualifications', (string) $qualifiedSpeakers)
                ->description($pct($qualifiedSpeakers))
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color($qualifiedSpeakers > 0 ? 'info' : 'gray'),
        ];
    }

    #[Override]
    public function getColumns(): int|array
    {
        return 3;
    }
}
