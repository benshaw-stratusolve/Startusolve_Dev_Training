<?php

namespace App\Filament\Resources\Attendees\Widgets;

use App\Filament\Resources\Attendees\Pages\ListAttendees;
use Carbon\CarbonImmutable;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Illuminate\Support\Collection;

class AttendeeChartWidget extends ChartWidget
{
    use InteractsWithPageTable;

    public ?string $filter = 'threeMonths';

    protected int | string | array $columnSpan = 'full';

    protected ?string $heading = 'Attendee Signups';

    protected ?string $maxHeight = '200px';

    protected ?string $pollingInterval = '1s';

    protected function getData(): array
    {
        [$startDate, $interval] = match ($this->filter) {
            'week' => [now()->subWeek()->startOfDay(), 'day'],
            'month' => [now()->subMonth()->startOfDay(), 'day'],
            default => [now()->subMonths(3)->startOfMonth(), 'month'],
        };

        $labels = $this->labels($startDate->toImmutable(), $interval);
        $counts = $this->signupCounts($startDate->toImmutable(), $interval);

        return [
            'datasets' => [
                [
                    'label' => 'Signups',
                    'data' => $labels
                        ->keys()
                        ->map(fn (string $key): int => $counts->get($key, 0))
                        ->values()
                        ->toArray(),
                    'borderColor' => '#4f46e5',
                    'backgroundColor' => '#4f46e5',
                ],
            ],
            'labels' => $labels->values()->toArray(),
        ];
    }

    protected function getFilters(): ?array
    {
        return [
            'week' => 'Last week',
            'month' => 'Last month',
            'threeMonths' => 'Last three months',
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getTablePage(): string
    {
        return ListAttendees::class;
    }

    protected function labels(CarbonImmutable $startDate, string $interval): Collection
    {
        $labels = collect();
        $date = $startDate;
        $endDate = now()->toImmutable();

        while ($date <= $endDate) {
            $labels->put(
                $this->dateKey($date, $interval),
                $interval === 'month' ? $date->format('M Y') : $date->format('M j'),
            );

            $date = $interval === 'month' ? $date->addMonth() : $date->addDay();
        }

        return $labels;
    }

    protected function signupCounts(CarbonImmutable $startDate, string $interval): Collection
    {
        return (clone $this->getPageTableQuery())
            ->reorder()
            ->where('attendees.created_at', '>=', $startDate)
            ->get(['attendees.created_at'])
            ->countBy(fn ($attendee): string => $this->dateKey(
                $attendee->created_at->toImmutable(),
                $interval,
            ));
    }

    protected function dateKey(CarbonImmutable $date, string $interval): string
    {
        return $interval === 'month' ? $date->format('Y-m') : $date->format('Y-m-d');
    }
}
