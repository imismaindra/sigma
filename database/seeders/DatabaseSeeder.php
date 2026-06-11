<?php

namespace Database\Seeders;

use App\Models\KategoriPengaduan;
use App\Models\Lampiran;
use App\Models\Pengaduan;
use App\Models\StatusLog;
use App\Models\Tanggapan;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Users
        $this->call(UserSeeder::class);

        // 2. Seed Kategori Pengaduan
        $this->call(KategoriPengaduanSeeder::class);

        // Ambil data user (mahasiswa & admin) dan kategori untuk mengisi relasi
        $mahasiswas = User::where('role', 'mahasiswa')->get();
        $admins = User::where('role', 'admin')->get();
        $kategoris = KategoriPengaduan::all();

        // 3. Seed Pengaduan beserta Lampiran, StatusLog, dan Tanggapan
        // Membuat 15 data pengaduan secara acak dengan relasi logis
        foreach (range(1, 15) as $i) {
            $mahasiswa = $mahasiswas->random();
            $kategori = $kategoris->random();
            $status = fake()->randomElement(['pending', 'proses', 'selesai', 'ditolak']);

            $pengaduan = Pengaduan::create([
                'id_user' => $mahasiswa->id_user,
                'id_kategori' => $kategori->id_kategori,
                'judul' => fake()->sentence(fake()->numberBetween(4, 8)),
                'isi_pengaduan' => fake()->paragraph(fake()->numberBetween(3, 6)),
                'status' => $status,
            ]);

            // Tambahkan lampiran (peluang 70%, berisi 1-2 berkas)
            if (fake()->boolean(70)) {
                $jumlahLampiran = fake()->numberBetween(1, 2);
                Lampiran::factory($jumlahLampiran)->create([
                    'id_pengaduan' => $pengaduan->id_pengaduan,
                ]);
            }

            // Tambahkan log status dan tanggapan sesuai status pengaduan saat ini
            if ($status !== 'pending') {
                $admin = $admins->random();
                
                // Log perubahan pertama: pending -> proses
                StatusLog::create([
                    'id_pengaduan' => $pengaduan->id_pengaduan,
                    'status_lama' => 'pending',
                    'status_baru' => 'proses',
                    'catatan' => 'Pengaduan telah diverifikasi dan masuk dalam proses peninjauan.',
                    'created_by' => $admin->id_user,
                ]);

                // Log perubahan kedua (jika selesai atau ditolak): proses -> selesai/ditolak
                if (in_array($status, ['selesai', 'ditolak'])) {
                    $catatan = $status === 'selesai' 
                        ? 'Masalah telah diselesaikan oleh unit/divisi terkait.'
                        : 'Pengaduan ditolak karena alasan ketidaksesuaian kriteria atau informasi kurang lengkap.';

                    StatusLog::create([
                        'id_pengaduan' => $pengaduan->id_pengaduan,
                        'status_lama' => 'proses',
                        'status_baru' => $status,
                        'catatan' => $catatan,
                        'created_by' => $admin->id_user,
                    ]);

                    // Buat Tanggapan resmi dari Admin
                    Tanggapan::create([
                        'id_pengaduan' => $pengaduan->id_pengaduan,
                        'id_admin' => $admin->id_user,
                        'isi_tanggapan' => 'Terima kasih atas laporan yang Anda sampaikan. ' . $catatan . ' Kami sangat menghargai kontribusi Anda dalam menjaga kualitas pelayanan kampus.',
                    ]);
                }
            }
        }
    }
}
