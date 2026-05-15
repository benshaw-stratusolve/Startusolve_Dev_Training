<?php

namespace App\Filament\Widgets;

use App\Models\Conference;
use App\Models\Speaker;
use App\Models\Talk;
use App\Models\Venue;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ConferenceStatsWidget extends StatsOverviewWidget
{
    protected function getColumns(): int
    {
        return 2;
    }

    protected function getStats(): array
    {
        $totalConferences = Conference::query()->count('id');
        $upcomingConferences = Conference::query()->where('start_date', '>', now())->count('id');
        $publishedConferences = Conference::query()->where('is_published', true)->count('id');

        $conferencesThisMonth = collect(range(5, 0))
            ->map(fn (int $monthsAgo) => Conference::query()
                ->whereBetween('created_at', [
                    now()->subMonths($monthsAgo)->startOfMonth(),
                    now()->subMonths($monthsAgo)->endOfMonth(),
                ], 'and')
                ->count('id'))
            ->toArray();

        return [
            Stat::make('Total Conferences', (string) $totalConferences)
                ->description($upcomingConferences.' upcoming')
                ->descriptionIcon('heroicon-m-calendar')
                ->chart($conferencesThisMonth)
                ->color('primary'),

            Stat::make('Published', (string) $publishedConferences)
                ->description('Live on the website')
                ->descriptionIcon('heroicon-m-globe-alt')
                ->color($publishedConferences > 0 ? 'success' : 'gray'),

            Stat::make('Speakers', (string) Speaker::query()->count('id'))
                ->description(Speaker::query()->whereHas('conferences', fn ($q) => $q)->count('id').' booked')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),

            Stat::make('Venues', (string) Venue::query()->count('id'))
                ->description(Talk::query()->count('id').' talks submitted')
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color('warning'),
        ];
    }
}
