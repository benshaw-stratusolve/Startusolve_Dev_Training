<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Attendees\AttendeeResource;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Notifications\Notification;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Widgets\Widget;

class DashboardNotificationWidget extends Widget implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    protected int|string|array $columnSpan = 'full';

    protected string $view = 'filament.widgets.dashboard-notification-widget';

    public function callNotificationAction(): Action
    {
        return Action::make('callNotification')
            ->button()
            ->color('warning')
            ->label('Send a notification')
            ->action(fn () => Notification::make()
                ->warning()
                ->title('Attendee review needed')
                ->body('Check attendee signups and revenue before publishing the next update.')
                ->persistent()
                ->actions([
                    Action::make('viewAttendees')
                        ->label('View attendees')
                        ->button()
                        ->color('primary')
                        ->url(AttendeeResource::getUrl('index')),
                    Action::make('undo')
                        ->label('Undo')
                        ->color('gray')
                        ->dispatch('dashboardNotificationUndo')
                        ->close(),
                ])
                ->send());
    }
}
