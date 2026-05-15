<?php

use App\Filament\Resources\Attendees\AttendeeResource;
use App\Filament\Widgets\DashboardNotificationWidget;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('dashboard notification action sends a notification with an attendees link', function () {
    Livewire::test(DashboardNotificationWidget::class)
        ->assertActionExists('callNotification')
        ->callAction('callNotification')
        ->assertNotified('Attendee review needed');

    $action = app(DashboardNotificationWidget::class)->callNotificationAction();
    $notification = value($action->getActionFunction());

    expect($notification->getActions()[0]->getUrl())->toBe(AttendeeResource::getUrl('index'));
});
