<?php

namespace Database\Seeders;

use App\Models\KategoriPengaduan;
use Illuminate\Database\Seeder;

class KategoriPengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'nama_kategori' => 'Fasilitas Akademik',
                'deskripsi' => 'Pengaduan terkait fasilitas penunjang perkuliahan seperti ruang kelas, proyektor, laboratorium, AC, dll.',
                'status_aktif' => true,
            ],
            [
                'nama_kategori' => 'Pelayanan Administrasi',
                'deskripsi' => 'Pengaduan terkait pelayanan staf administrasi, pengurusan surat, pendaftaran, atau birokrasi kampus.',
                'status_aktif' => true,
            ],
            [
                'nama_kategori' => 'Infrastruktur Kampus',
                'deskripsi' => 'Pengaduan terkait kondisi gedung, jalanan kampus, toilet, lift, tempat ibadah, dll.',
                'status_aktif' => true,
            ],
            [
                'nama_kategori' => 'Keamanan & Parkir',
                'deskripsi' => 'Pengaduan terkait keamanan area kampus, kehilangan, ketertiban parkir, atau layanan satpam.',
                'status_aktif' => true,
            ],
            [
                'nama_kategori' => 'Kebersihan Lingkungan',
                'deskripsi' => 'Pengaduan terkait kebersihan kelas, koridor, tumpukan sampah, taman, atau higienitas kantin.',
                'status_aktif' => true,
            ],
            [
                'nama_kategori' => 'Sistem IT & Jaringan',
                'deskripsi' => 'Pengaduan terkait website kampus, portal akademik (SIAKAD), e-learning, atau koneksi Wi-Fi.',
                'status_aktif' => true,
            ],
        ];

        foreach ($categories as $category) {
            KategoriPengaduan::create($category);
        }
    }
}
