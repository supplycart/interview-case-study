<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    public function login(): void
    {
        $this->validate();
        $this->form->authenticate();
        Session::regenerate();
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
        <div class="mb-8 text-center">
            <h2 class="text-2xl font-bold text-gray-800">Login</h2>
            <p class="text-gray-600">Welcome back! Please login to your account.</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form wire:submit="login" class="space-y-6">
            <div>
                <x-input-label for="email" value="Email" />
                <x-text-input wire:model="form.email" id="email"
                    class="block w-full mt-1" type="email" name="email"
                    required autofocus autocomplete="email"
                    placeholder="Enter your email" />
                <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" value="Password" />
                <x-text-input wire:model="form.password" id="password"
                    class="block w-full mt-1" type="password" name="password"
                    required autocomplete="current-password"
                    placeholder="Enter your password" />
                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-sm text-blue-600 hover:text-blue-800"
                        wire:navigate>
                        Forgot password?
                    </a>
                @endif
            </div>

            <button type="submit"
                class="w-full px-4 py-2 font-semibold text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700">
                Login
            </button>

            <p class="text-sm text-center text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}"
                    class="font-semibold text-blue-600 hover:text-blue-800">
                    Register here
                </a>
            </p>
        </form>
    </div>
</div>
