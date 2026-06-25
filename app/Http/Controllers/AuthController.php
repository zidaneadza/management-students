<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

        $user = DB::table('users')->where('username', $credentials['username'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
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

        $user = DB::table('users')->where('username', $data['username'])->first();

        if ($user) {
            DB::table('users')
                ->where('username', $data['username'])
                ->update([
                    'password' => Hash::make($data['new_password']),
                    'updated_at' => now(),
                ]);

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
