<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration page.
     */
    public function create(): Response
    {
        return Inertia::render('auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'phone_no' => ['required','alpha_num:ascii','max:11'],
            'address_line_1' => ['required','max:100'],
            'address_line_2' => ['nullable','max:100'],
            'address_line_3' => ['nullable','max:100'],
            'is_member' => ['required', Rule::in(['yes', 'no']) ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'address_line_3' => $request->address_line_3,
            'is_member' => $request->is_member == 'yes',
            'password' => Hash::make($request->password),
        ]);

        activity()
            ->causedBy($user)
            ->performedOn($user)
            ->log($user->name . ' has successfully registered their account');

        event(new Registered($user));

        Auth::login($user);

        return to_route('user.dashboard');
    }
}
