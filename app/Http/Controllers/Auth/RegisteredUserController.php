<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Buat user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => true, // opsional, sesuaikan dengan sistemmu
        ]);

        // Event Laravel (email verification, dll)
        event(new Registered($user));

        /**
         * ❗ PENTING:
         * Jangan auto-login di sistem multi-role
         * Biarkan user login manual agar role & middleware aman
         */
        return redirect()
            ->route('login')
            ->with('status', 'Akun berhasil dibuat. Silakan login.');
    }
}
