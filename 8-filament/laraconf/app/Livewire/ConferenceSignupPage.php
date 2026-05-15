<?php

namespace App\Livewire;

use App\Models\Attendee;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Notifications\Notification;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Illuminate\Support\HtmlString;
use Livewire\Component;

class ConferenceSignupPage extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    public int $conferenceId;

    public int $price = 50000;

    public function mount(): void
    {
        $this->conferenceId = 1;
    }

    public function signUpAction(): Action
    {
        return Action::make('signUp')
            ->slideOver()
            ->schema([
                Placeholder::make('totalPrice')
                    ->hiddenLabel()
                    ->content(function (callable $get): HtmlString {
                        $count = count($get('attendees') ?? []);

                        return new HtmlString('<p class="text-xl font-bold">Total: $'.number_format(($count * $this->price) / 100, 2).'</p>');
                    }),
                Repeater::make('attendees')
                    ->schema(Attendee::getForm())
                    ->columns(2),
            ])
            ->action(function (array $data): void {
                collect($data['attendees'])->each(function (array $attendee): void {
                    Attendee::create([
                        'name' => $attendee['name'],
                        'email' => $attendee['email'],
                        'ticket_cost' => $this->price,
                        'is_paid' => true,
                        'conference_id' => $this->conferenceId,
                    ]);
                });

                Notification::make()
                    ->success()
                    ->title('You\'ve been registered!')
                    ->body('Thanks for signing up. We\'ll see you at the conference.')
                    ->send();
            });
    }

    public function render()
    {
        return view('livewire.conference-signup-page')
            ->layout('layouts.app');
    }
}
