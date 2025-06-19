<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        Auth::user()->sendEmailVerificationNotification();

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
        <div class="mb-8 text-center">
            <h2 class="text-2xl font-bold text-gray-800">Register</h2>
            <p class="text-gray-600">Create your account</p>
        </div>

        <form wire:submit="register" class="space-y-6">
            <!-- Name -->
            <div>
                <x-input-label for="name" value="Name" />
                <x-text-input wire:model="name" id="name" class="block w-full mt-1"
                    type="text" name="name" required autofocus autocomplete="name"
                    placeholder="Enter your name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" value="Email" />
                <x-text-input wire:model="email" id="email" class="block w-full mt-1"
                    type="email" name="email" required autocomplete="email"
                    placeholder="Enter your email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" value="Password" />
                <x-text-input wire:model="password" id="password" class="block w-full mt-1"
                    type="password" name="password" required autocomplete="new-password"
                    placeholder="Enter your password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" value="Confirm Password" />
                <x-text-input wire:model="password_confirmation" id="password_confirmation"
                    class="block w-full mt-1" type="password" name="password_confirmation"
                    required autocomplete="new-password"
                    placeholder="Confirm your password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <button type="submit"
                class="w-full px-4 py-2 font-semibold text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700">
                Register
            </button>

            <p class="text-sm text-center text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}"
                    class="font-semibold text-blue-600 hover:text-blue-800">
                    Login here
                </a>
            </p>
        </form>
    </div>
</div>
