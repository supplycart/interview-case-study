<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\AddressOptionsStoreRequest;
use App\Models\Address;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        dd('Update method is being called');
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function store(AddressOptionsStoreRequest $request)
    {
        try {
            
            // Get the current user's address, if it exists
            $address = Address::where('user_id', auth()->user()->id)->first();

            // If the user doesn't have an address yet, create a new one
            if (!$address) {
                $address = new Address;
                $address->user_id = auth()->user()->id;
            }

            // Update the address fields
            $address->addr1 = $request->input('addr1');
            $address->addr2 = $request->input('addr2');
            $address->city = $request->input('city');
            $address->postcode = $request->input('postcode');
            $address->country = $request->input('country');

            // Save the updated or newly created address to the database
            $address->save();

        } catch (\Exception $e) {

            \Log::error('Error while storing address: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while storing the address.']);
        }
    }

}
