<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectUserBasedOnRole(Auth::user());
        }
        return view('auth.login');
    }

    /**
     * Proses autentikasi login.
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus 6 karakter.',
        ]);

        // Proses login (password diverifikasi & dienkripsi otomatis oleh Laravel Auth)
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            return $this->redirectUserBasedOnRole($user)->with('success', "Selamat datang kembali, {$user->nama}!");
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan data kami.',
        ])->onlyInput('email');
    }

    /**
     * Proses logout user.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }

    /**
     * Helper redirect berdasarkan role user.
     */
    protected function redirectUserBasedOnRole($user)
    {
        switch ($user->role) {
            case 'mahasiswa':
                return redirect()->intended('/mahasiswa/dashboard');
            case 'admin':
                return redirect()->intended('/admin/dashboard');
            case 'pimpinan':
                return redirect()->intended('/pimpinan/dashboard');
            case 'super_admin':
                return redirect()->intended('/super-admin/dashboard');
            default:
                Auth::logout();
                return redirect()->route('login')->with('error', 'Role user tidak dikenali.');
        }
    }
}
