<?php

use App\Filament\Resources\Attendees\AttendeeResource;
use App\Filament\Resources\Attendees\Widgets\AttendeeChartWidget;
use App\Filament\Resources\Attendees\Widgets\AttendeesStatsWidget;
use App\Models\Attendee;
use App\Models\Conference;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('attendee resource widgets summarize and chart table data', function () {
    $conference = Conference::factory()->create();

    Attendee::factory()
        ->for($conference)
        ->create([
            'name' => 'Kevin Malone',
            'ticket_cost' => 50000,
            'created_at' => now()->subDays(2),
        ]);

    Attendee::factory()
        ->for($conference)
        ->create([
            'name' => 'Pam Beesly',
            'ticket_cost' => 75000,
        ]);

    expect(AttendeeResource::getWidgets())->toBe([
        AttendeesStatsWidget::class,
        AttendeeChartWidget::class,
    ]);

    $statsWidget = app(AttendeesStatsWidget::class);
    $statsWidget->tableSearch = 'Kevin';

    $stats = protectedCall($statsWidget, 'getStats');

    expect($stats[0]->getValue())->toBe('1')
        ->and($stats[1]->getValue())->toBe('$500.00');

    $chartWidget = app(AttendeeChartWidget::class);
    $chartWidget->filter = 'week';

    $data = protectedCall($chartWidget, 'getData');

    expect($data['datasets'][0]['data'])->toContain(1)
        ->and($data['labels'])->toContain(now()->subDays(2)->format('M j'));
});

function protectedCall(object $object, string $method): mixed
{
    return (fn (): mixed => $this->{$method}())->call($object);
}
