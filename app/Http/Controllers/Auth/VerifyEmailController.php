<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Jika sudah terverifikasi
        if ($user->hasVerifiedEmail()) {
            return $this->redirectByRole($user, true);
        }

        // Tandai email sebagai terverifikasi
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return $this->redirectByRole($user, true);
    }

    /**
     * Redirect user berdasarkan role
     */
    protected function redirectByRole($user, bool $verified = false): RedirectResponse
    {
        $query = $verified ? ['verified' => 1] : [];

        if ($user->hasRole('admin')) {
            return redirect()->route('dashboard', $query);
        }

        if ($user->hasRole('pimpinan')) {
            return redirect()->route('pimpinan.dashboard', $query);
        }

        if ($user->hasRole('pegawai')) {
            return redirect()->route('pegawai.dashboard', $query);
        }

        Auth::logout();
        abort(403, 'Role tidak dikenali');
    }
}
