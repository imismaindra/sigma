<?php

namespace App\Http\Controllers;

use App\Models\User;
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
     * Tampilkan halaman registrasi mahasiswa.
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectUserBasedOnRole(Auth::user());
        }

        return view('auth.register');
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
            if (($user->account_status ?? 'aktif') !== 'aktif') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->with('error', 'Akun Anda belum aktif atau sedang dinonaktifkan. Hubungi admin layanan.');
            }

            return $this->redirectUserBasedOnRole($user)->with('success', "Selamat datang kembali, {$user->nama}!");
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan data kami.',
        ])->onlyInput('email');
    }

    /**
     * Proses registrasi akun mahasiswa.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nim' => ['required', 'string', 'max:30', 'regex:/^\d{2}\.\d{4}\.\d\.\d{5}$/', 'unique:users,nim_nip'],
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email',
            'nomor_telepon' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s()]+$/'],
            'jurusan' => 'required|string|max:100',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'nim.required' => 'NIM wajib diisi.',
            'nim.regex' => 'Format NIM harus seperti 06.2023.1.07661.',
            'nim.unique' => 'NIM sudah terdaftar.',
            'nama.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'nomor_telepon.required' => 'Nomor telepon wajib diisi.',
            'nomor_telepon.regex' => 'Nomor telepon hanya boleh berisi angka, spasi, tanda +, tanda -, dan tanda kurung.',
            'jurusan.required' => 'Jurusan wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::create([
            'nama' => $validated['nama'],
            'nim_nip' => $validated['nim'],
            'email' => $validated['email'],
            'nomor_telepon' => $validated['nomor_telepon'],
            'jurusan' => $validated['jurusan'],
            'password' => $validated['password'],
            'role' => 'mahasiswa',
            'account_status' => 'aktif',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Registrasi berhasil. Selamat datang di SIPMA!');
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
            case 'super_admin':
                return redirect()->intended('/admin/dashboard');
            default:
                Auth::logout();
                return redirect()->route('login')->with('error', 'Role user tidak dikenali.');
        }
    }
}
