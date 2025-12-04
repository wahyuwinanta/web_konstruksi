<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    // public function edit(Request $request): View
    // {
    //     return view('profile.edit', [
    //         'user' => $request->user(),
    //     ]);
    // }

    public function editAdmin(Request $request): View
    {
        return view('profile.editAdmin', [
            'user' => $request->user(),
        ]);
    }

    public function editPekerja(Request $request): View
    {
        return view('profile.editPekerja', [
            'user' => $request->user(),
        ]);
    }

    public function editOwner(Request $request): View
    {
        return view('profile.editOwner', [
            'user' => $request->user(),
        ]);
    }
    

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        // redirect super admin
        if ($request->user()->hasRole('super_admin')) {
            return Redirect::route('profile.editAdmin')
                ->with('status', 'profile-updated');
        }

        // redirect owner
        if ($request->user()->hasRole('owner')) {
            return Redirect::route('profile.editOwner')
                ->with('status', 'profile-updated');
        }

        // redirect pekerja
        if ($request->user()->hasRole('pekerja')) {
            return Redirect::route('profile.editPekerja')
                ->with('status', 'profile-updated');
        }

        return Redirect::route('dashboard')
            ->with('status', 'profile-updated');
    }



    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
