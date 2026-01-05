<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class EmailVerificationPromptController extends Controller
{
    public function __invoke(Request $request): RedirectResponse|View
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $this->redirectByRole($request->user());
        }

        return view('auth.verify-email');
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
