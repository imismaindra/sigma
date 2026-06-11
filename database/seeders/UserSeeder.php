<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun Dummy Mahasiswa (siap login)
        User::factory()->create([
            'nama' => 'Budi Santoso',
            'nim_nip' => '2100018123',
            'email' => 'mahasiswa@example.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
        ]);

        // 2. Akun Dummy Admin (siap login)
        User::factory()->create([
            'nama' => 'Siti Aminah',
            'nim_nip' => '197605122002122001',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 3. Akun Dummy Pimpinan (siap login)
        User::factory()->create([
            'nama' => 'Prof. Dr. Ahmad Dahlan',
            'nim_nip' => '196508211990031002',
            'email' => 'pimpinan@example.com',
            'password' => Hash::make('password'),
            'role' => 'pimpinan',
        ]);

        // 4. Akun Dummy Super Admin (siap login)
        User::factory()->create([
            'nama' => 'Super Admin Sigma',
            'nim_nip' => '199012312015041001',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
        ]);

        // Tambah beberapa user acak tambahan untuk data testing
        User::factory(5)->mahasiswa()->create();
        User::factory(2)->admin()->create();
        User::factory(2)->pimpinan()->create();
    }
}
