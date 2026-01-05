<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $this->redirectByRole($request->user());
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }

    protected function redirectByRole($user): RedirectResponse
    {
        if ($user->hasRole('admin')) {
            return redirect()->route('dashboard');
        }

        if ($user->hasRole('pimpinan')) {
            return redirect()->route('pimpinan.dashboard');
        }

        if ($user->hasRole('pegawai')) {
            return redirect()->route('pegawai.dashboard');
        }

        Auth::logout();
        abort(403, 'Role tidak dikenali');
    }
}
