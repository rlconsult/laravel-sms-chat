<?php

namespace Filament\Http\Livewire\Auth;

use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Filament\ComponentConcerns;
use Filament\Fields;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    use ComponentConcerns\HasForm;
    use ComponentConcerns\HasTitle;
    use WithRateLimiting;

    public $email;

    public $password;

    public $remember = false;

    public function fields()
    {
        return [
            Fields\Text::make('email')
                ->label('filament::fields.labels.email')
                ->email()
                ->autofocus()
                ->autocomplete('email')
                ->required(),
            Fields\Text::make('password')
                ->label('filament::fields.labels.password')
                ->hint('[' . __('filament::auth.requestPassword') . '](' . route('filament.auth.password.request') . ')')
                ->password()
                ->autocomplete('current-password')
                ->required(),
            Fields\Checkbox::make('remember')->label('Remember me'),
        ];
    }

    public function submit()
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            $this->addError('email', __('auth.throttle', [
                'seconds' => $exception->secondsUntilAvailable,
                'minutes' => ceil($exception->secondsUntilAvailable / 60),
            ]));

            return;
        }

        $this->validate();

        if (! Auth::guard('filament')->attempt($this->only(['email', 'password']), $this->remember)) {
            $this->addError('email', __('auth.failed'));

            return;
        }

        return redirect()->intended(route('filament.dashboard'));
    }

    public function render()
    {
        return view('filament::.auth.login')
            ->layout('filament::layouts.auth', ['title' => 'filament::auth.signin']);
    }
}
