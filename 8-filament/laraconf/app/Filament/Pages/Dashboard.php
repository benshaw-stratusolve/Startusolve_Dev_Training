<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ConferenceStatsWidget;
use App\Filament\Widgets\DashboardNotificationWidget;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\AccountWidget;

class Dashboard extends BaseDashboard
{
    protected static ?string $title = 'Dashboard';

    public function getWidgets(): array
    {
        return [
            AccountWidget::class,
            ConferenceStatsWidget::class,
            DashboardNotificationWidget::class,
        ];
    }

    public function getColumns(): int|array
    {
        return 2;
    }
}
