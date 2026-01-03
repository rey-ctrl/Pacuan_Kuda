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
     */
    public function showLogin()
    {
        return view('login');
    }

    /**
     * Tampilkan form register.
     */
    public function showRegister()
    {
        return view('register');
    }

    /**
     * Proses pendaftaran user baru.
     */
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => null, 
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false,
        ]);

        Auth::login($user);

        // Redirect menggunakan route name agar lebih aman
        return redirect()->route($user->is_admin ? 'admin.dashboard' : 'pendaftaran.index');
    }

    /**
     * Proses login user (DENGAN REMEMBER ME).
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 1. Cek apakah checkbox "remember" dicentang
        // $request->has('remember') akan return true jika dicentang, false jika tidak
        $remember = $request->has('remember');

        // 2. Masukkan $remember sebagai parameter kedua
        if (Auth::attempt($request->only('email', 'password'), $remember)) {
            
            // Regenerasi session ID untuk keamanan
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect menggunakan Route Name (Sesuai routes/web.php kamu)
            // Ini memperbaiki potensi error 404 karena path '/pages/pendaftaran' mungkin salah
            return redirect()->route($user->is_admin ? 'admin.dashboard' : 'pendaftaran.index');
        }

        // Login gagal
        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    /**
     * Proses logout user.
     */
    public function logout()
    {
        Auth::logout();
        
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }
}