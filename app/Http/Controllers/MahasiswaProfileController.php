<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class MahasiswaProfileController extends Controller
{
    /**
     * Tampilkan halaman profil mahasiswa.
     */
    public function show()
    {
        $user = Auth::user();

        $unreadNotifications = $user->notifications()->whereNull('read_at')->count();

        return view('mahasiswa.profile', [
            'user' => $user,
            'unreadNotifications' => $unreadNotifications,
            'summary' => [
                'total' => $user->pengaduan()->count(),
                'pending' => $user->pengaduan()->where('status', 'pending')->count(),
                'proses' => $user->pengaduan()->whereIn('status', ['proses', 'menunggu_klarifikasi', 'ditindaklanjuti', 'menunggu_verifikasi_mahasiswa'])->count(),
                'selesai' => $user->pengaduan()->where('status', 'selesai')->count(),
            ],
        ]);
    }

    /**
     * Simpan perubahan profil mahasiswa.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nim' => [
                'required',
                'string',
                'max:30',
                'regex:/^\d{2}\.\d{4}\.\d\.\d{5}$/',
                Rule::unique('users', 'nim_nip')->ignore($user->id_user, 'id_user'),
            ],
            'nama' => 'required|string|max:100',
            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('users', 'email')->ignore($user->id_user, 'id_user'),
            ],
            'nomor_telepon' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s()]+$/'],
            'jurusan' => 'required|string|max:100',
            'current_password' => 'required_with:password|nullable|string',
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'nim.required' => 'NIM wajib diisi.',
            'nim.regex' => 'Format NIM harus seperti 06.2023.1.07661.',
            'nim.unique' => 'NIM sudah digunakan akun lain.',
            'nama.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan akun lain.',
            'nomor_telepon.required' => 'Nomor telepon wajib diisi.',
            'nomor_telepon.regex' => 'Nomor telepon hanya boleh berisi angka, spasi, tanda +, tanda -, dan tanda kurung.',
            'jurusan.required' => 'Jurusan wajib diisi.',
            'current_password.required_with' => 'Password saat ini wajib diisi jika ingin mengganti password.',
            'password.min' => 'Password baru minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        if (!empty($validated['password']) && !Hash::check($validated['current_password'], $user->password)) {
            return back()
                ->withErrors(['current_password' => 'Password saat ini tidak sesuai.'])
                ->withInput($request->except(['current_password', 'password', 'password_confirmation']));
        }

        $user->fill([
            'nama' => $validated['nama'],
            'nim_nip' => $validated['nim'],
            'email' => $validated['email'],
            'nomor_telepon' => $validated['nomor_telepon'],
            'jurusan' => $validated['jurusan'],
        ]);

        if (!empty($validated['password'])) {
            $user->password = $validated['password'];
        }

        $user->save();

        return back()->with('success', 'Profil mahasiswa berhasil diperbarui.');
    }
}
