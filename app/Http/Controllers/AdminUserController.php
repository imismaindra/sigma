<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role === 'pimpinan') {
            abort(403);
        }

        $users = User::query()
            ->when($request->filled('q'), function ($query) use ($request) {
                $q = $request->q;
                $query->where(function ($query) use ($q) {
                    $query->where('nama', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhere('nim_nip', 'like', "%{$q}%");
                });
            })
            ->when($request->filled('role'), fn ($query) => $query->where('role', $request->role))
            ->when($request->filled('account_status'), fn ($query) => $query->where('account_status', $request->account_status))
            ->latest('id_user')
            ->paginate(12)
            ->withQueryString();

        return view('admin.users', [
            'users' => $users,
            'roles' => ['mahasiswa', 'admin', 'pimpinan', 'super_admin'],
            'statuses' => ['aktif' => 'Aktif', 'nonaktif' => 'Nonaktif', 'menunggu_verifikasi' => 'Menunggu Verifikasi'],
        ]);
    }

    public function store(Request $request)
    {
        if (Auth::user()->role === 'pimpinan') {
            abort(403);
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nim_nip' => 'required|string|max:30|unique:users,nim_nip',
            'email' => 'required|email|max:100|unique:users,email',
            'role' => 'required|in:mahasiswa,admin,pimpinan,super_admin',
            'account_status' => 'required|in:aktif,nonaktif,menunggu_verifikasi',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create($validated);
        $this->recordUserActivity('user_ditambahkan', "User {$user->nama} ditambahkan.", null, $user->only(['id_user', 'nama', 'email', 'role', 'account_status']));

        return back()->with('success', 'User baru berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role === 'pimpinan') {
            abort(403);
        }

        $user = User::findOrFail($id);
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'nim_nip' => ['required', 'string', 'max:30', Rule::unique('users', 'nim_nip')->ignore($user->id_user, 'id_user')],
            'email' => ['required', 'email', 'max:100', Rule::unique('users', 'email')->ignore($user->id_user, 'id_user')],
            'role' => 'required|in:mahasiswa,admin,pimpinan,super_admin',
            'account_status' => 'required|in:aktif,nonaktif,menunggu_verifikasi',
            'password' => 'nullable|string|min:8',
        ]);

        if ((int) $user->id_user === (int) Auth::id() && $validated['account_status'] !== 'aktif') {
            return back()->with('warning', 'Akun yang sedang digunakan tidak dapat dinonaktifkan.');
        }

        $before = $user->only(['nama', 'nim_nip', 'email', 'role', 'account_status']);

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $user->update($validated);
        $this->recordUserActivity('user_diperbarui', "User {$user->nama} diperbarui.", $before, $user->only(['nama', 'nim_nip', 'email', 'role', 'account_status']));

        return back()->with('success', 'Data user berhasil diperbarui.');
    }

    protected function recordUserActivity(string $action, string $description, ?array $before, ?array $after): void
    {
        ActivityLog::create([
            'id_user' => Auth::id(),
            'action' => $action,
            'description' => $description,
            'ip_address' => request()->ip(),
            'user_agent' => substr((string) request()->userAgent(), 0, 1000),
            'before_data' => $before,
            'after_data' => $after,
        ]);
    }
}
