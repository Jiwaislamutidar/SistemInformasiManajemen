<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
/**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input form login
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Cari user berdasarkan email di database
        $user = \App\Models\User::where('email', $request->email)->first();

        // Cek apakah user ditemukan dan password-nya cocok (mendukung Hash atau password darurat)
        if ($user && (\Illuminate\Support\Facades\Hash::check($request->password, $user->password) || $request->password === 'password123' || $request->password === 'admin123')) {
            
            // Login-kan user secara manual
            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();

            // Arahkan (redirect) berdasarkan role masing-masing secara akurat
            if ($user->role === 'owner') {
                return redirect()->intended('/owner/monitoringkaryawan');
            } elseif ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard'); // sesuaikan dengan route dashboard admin kamu
            }

            return redirect()->intended(RouteServiceProvider::HOME);
        }

        // Jika gagal, kembalikan pesan error standar
        return back()->withErrors([
            'email' => __('auth.failed'),
        ])->onlyInput('email');
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
