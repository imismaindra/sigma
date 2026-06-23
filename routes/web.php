<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\MahasiswaProfileController;
use App\Http\Controllers\PengaduanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route Home (Redirection based on auth state)
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role === 'mahasiswa') {
            return redirect()->route('mahasiswa.dashboard');
        } elseif (in_array($user->role, ['admin', 'pimpinan', 'super_admin'])) {
            return redirect()->route('admin.dashboard');
        }
    }
    return redirect()->route('login');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Group Protected Routes
Route::middleware(['auth'])->group(function () {

    // 1. Mahasiswa Routes
    Route::middleware(['role:mahasiswa'])->prefix('mahasiswa')->group(function () {
        Route::get('/dashboard', [PengaduanController::class, 'mahasiswaDashboard'])->name('mahasiswa.dashboard');
        Route::get('/pengaduan', [PengaduanController::class, 'mahasiswaRiwayat'])->name('mahasiswa.pengaduan.index');
        Route::get('/pengaduan/create', [PengaduanController::class, 'createPengaduan'])->name('mahasiswa.pengaduan.create');
        Route::post('/pengaduan', [PengaduanController::class, 'storePengaduan'])->name('mahasiswa.pengaduan.store');
        Route::get('/pengaduan/{id}', [PengaduanController::class, 'showMahasiswaPengaduan'])->name('mahasiswa.pengaduan.show');
        Route::put('/pengaduan/{id}', [PengaduanController::class, 'updateMahasiswaPengaduan'])->name('mahasiswa.pengaduan.update');
        Route::post('/pengaduan/{id}/cancel', [PengaduanController::class, 'cancelMahasiswaPengaduan'])->name('mahasiswa.pengaduan.cancel');
        Route::post('/pengaduan/{id}/komentar', [PengaduanController::class, 'storeComment'])->name('mahasiswa.pengaduan.comment');
        Route::post('/pengaduan/{id}/confirm', [PengaduanController::class, 'confirmCompletion'])->name('mahasiswa.pengaduan.confirm');
        Route::post('/pengaduan/{id}/reopen', [PengaduanController::class, 'reopenPengaduan'])->name('mahasiswa.pengaduan.reopen');
        Route::get('/profile', [MahasiswaProfileController::class, 'show'])->name('mahasiswa.profile');
        Route::put('/profile', [MahasiswaProfileController::class, 'update'])->name('mahasiswa.profile.update');
    });

    // 2. Admin/Super Admin/Pimpinan Routes
    Route::middleware(['role:admin,super_admin,pimpinan'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [PengaduanController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::get('/export/pengaduan', [PengaduanController::class, 'exportPengaduan'])->name('admin.pengaduan.export');
        Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
        Route::post('/users', [AdminUserController::class, 'store'])->name('admin.users.store');
        Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
        Route::get('/pengaduan/{id}', [PengaduanController::class, 'showAdminPengaduan'])->name('admin.pengaduan.show');
        Route::post('/pengaduan/{id}/status', [PengaduanController::class, 'updateStatus'])->name('admin.pengaduan.status.update');
        Route::post('/pengaduan/{id}/tanggapan', [PengaduanController::class, 'storeTanggapan'])->name('admin.pengaduan.tanggapan.store');
        Route::post('/pengaduan/{id}/komentar', [PengaduanController::class, 'storeComment'])->name('admin.pengaduan.comment');
        Route::post('/kategori', [PengaduanController::class, 'storeKategori'])->name('admin.kategori.store');
        Route::put('/kategori/{id}', [PengaduanController::class, 'updateKategori'])->name('admin.kategori.update');
    });

});
