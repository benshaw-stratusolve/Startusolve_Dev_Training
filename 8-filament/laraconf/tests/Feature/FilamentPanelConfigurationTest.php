<?php

use App\Filament\Resources\Attendees\AttendeeResource;
use App\Filament\Resources\Conferences\ConferenceResource;
use App\Filament\Resources\Speakers\SpeakerResource;
use App\Filament\Resources\Talks\TalkResource;
use App\Filament\Resources\Venues\VenueResource;
use App\Models\Attendee;
use App\Models\Conference;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;

uses(RefreshDatabase::class);

test('filament panels and resource navigation are configured', function () {
    expect(Route::has('filament.app.auth.register'))->toBeTrue()
        ->and(Route::has('filament.app.auth.password-reset.request'))->toBeTrue()
        ->and(Route::has('filament.app.auth.email-verification.prompt'))->toBeTrue()
        ->and(Route::has('filament.speakers.auth.login'))->toBeTrue()
        ->and(route('filament.speakers.pages.dashboard', absolute: false))->toBe('/speaker');

    $panel = filament()->getPanel('app');
    $navigationGroups = collect($panel->getNavigationGroups());

    expect($panel->getBrandName())->toBe('Laraconf')
        ->and($panel->isSidebarCollapsibleOnDesktop())->toBeTrue()
        ->and($navigationGroups->map->getLabel()->all())->toBe([
            'Conference Operations',
            'Program',
        ]);

    expect(AttendeeResource::getNavigationGroup())->toBe('Conference Operations')
        ->and(ConferenceResource::getNavigationGroup())->toBe('Conference Operations')
        ->and(SpeakerResource::getNavigationGroup())->toBe('Program')
        ->and(TalkResource::getNavigationGroup())->toBe('Program')
        ->and(VenueResource::getRecordTitleAttribute())->toBe('name')
        ->and(AttendeeResource::getRecordTitleAttribute())->toBe('name')
        ->and(ConferenceResource::getRecordTitleAttribute())->toBe('name')
        ->and(TalkResource::getRecordTitleAttribute())->toBe('title');

    $conference = Conference::factory()->create([
        'name' => 'Laraconf US',
    ]);

    $attendee = Attendee::factory()
        ->for($conference)
        ->create([
            'name' => 'Kevin Malone',
        ]);

    expect(AttendeeResource::getNavigationBadge())->toBe('1')
        ->and(AttendeeResource::getNavigationBadgeColor())->toBe('success')
        ->and(AttendeeResource::getGlobalSearchResultDetails($attendee))->toBe([
            'Conference' => 'Laraconf US',
        ]);
});
