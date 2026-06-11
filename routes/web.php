<?php

use App\Http\Controllers\AuthController;
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
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Group Protected Routes
Route::middleware(['auth'])->group(function () {

    // 1. Mahasiswa Routes
    Route::middleware(['role:mahasiswa'])->prefix('mahasiswa')->group(function () {
        Route::get('/dashboard', [PengaduanController::class, 'mahasiswaDashboard'])->name('mahasiswa.dashboard');
        Route::post('/pengaduan', [PengaduanController::class, 'storePengaduan'])->name('mahasiswa.pengaduan.store');
    });

    // 2. Admin/Super Admin/Pimpinan Routes
    Route::middleware(['role:admin,super_admin,pimpinan'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [PengaduanController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::post('/pengaduan/{id}/status', [PengaduanController::class, 'updateStatus'])->name('admin.pengaduan.status.update');
        Route::post('/pengaduan/{id}/tanggapan', [PengaduanController::class, 'storeTanggapan'])->name('admin.pengaduan.tanggapan.store');
    });

});
