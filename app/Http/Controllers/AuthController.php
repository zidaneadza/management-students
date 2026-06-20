<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;

class AuthController extends BaseController
{
    public function showLoginForm(): View
    {
        if (session('is_logged_in')) {
            return redirect()->route('mahasiswa.index');
        }

        return view('auth.login');
    }

    public function showResetForm(): View
    {
        return view('auth.reset-password');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $storedPassword = session('password', 'admin123');

        if (($credentials['username'] === 'admin') && ($credentials['password'] === $storedPassword)) {
            session([
                'is_logged_in' => true,
                'username' => $credentials['username'],
            ]);

            return redirect()->intended(route('mahasiswa.index'));
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput();
    }

    public function resetPassword(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'username' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:6'],
        ]);

        if ($data['username'] === 'admin') {
            session(['password' => $data['new_password']]);

            return redirect()->route('login')->with('status', 'Password berhasil direset.');
        }

        return back()->withErrors([
            'username' => 'Username tidak ditemukan.',
        ])->withInput();
    }

    public function logout(): RedirectResponse
    {
        session()->forget(['is_logged_in', 'username']);

        return redirect()->route('login');
    }
}
