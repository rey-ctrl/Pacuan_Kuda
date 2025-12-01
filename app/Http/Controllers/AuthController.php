<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Tampilkan form login.
     *
     * @return \Illuminate\View\View
     */
    public function showLogin()
    {
        return view('login');
    }

    /**
     * Tampilkan form register.
     *
     * @return \Illuminate\View\View
     */
    public function showRegister()
    {
        return view('register');
    }

    /**
     * Proses pendaftaran user baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => null, // Asumsi nama belum diisi saat register awal
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false, // Default: bukan admin
        ]);

        Auth::login($user);

        // Arahkan setelah register
        return redirect($user->is_admin ? '/admin/dashboard' : '/pages/pendaftaran');
    }

    /**
     * Proses login user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            // Login berhasil
            $user = Auth::user();

            // Redirect sesuai role (is_admin)
            return redirect($user->is_admin
                ? '/admin/dashboard'
                : '/pages/pendaftaran'
            );
        }

        // Login gagal, kembali dengan error
        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    /**
     * Proses logout user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        
        // Hapus sesi dan regenerasi
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');
    }
}