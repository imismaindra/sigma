<?php

namespace Database\Factories;

use App\Models\KategoriPengaduan;
use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pengaduan>
 */
class PengaduanFactory extends Factory
{
    protected $model = Pengaduan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $laporan = fake()->randomElement([
            [
                'judul' => 'AC ruang kelas tidak dingin',
                'isi_pengaduan' => 'AC di ruang kelas terasa tidak dingin sejak awal perkuliahan. Kondisi ini membuat mahasiswa kurang nyaman saat mengikuti kegiatan belajar.',
            ],
            [
                'judul' => 'Wi-Fi kampus sering terputus',
                'isi_pengaduan' => 'Koneksi Wi-Fi di area kampus sering terputus saat digunakan untuk mengakses e-learning dan mengunggah tugas. Mohon dilakukan pengecekan jaringan.',
            ],
            [
                'judul' => 'Toilet lantai dua kurang bersih',
                'isi_pengaduan' => 'Toilet lantai dua beberapa hari terakhir kurang bersih dan air sering tidak mengalir. Kondisi ini mengganggu kenyamanan mahasiswa.',
            ],
            [
                'judul' => 'Lampu koridor mati',
                'isi_pengaduan' => 'Beberapa lampu di koridor gedung perkuliahan mati pada sore hingga malam hari. Area tersebut menjadi cukup gelap dan kurang aman untuk dilalui.',
            ],
            [
                'judul' => 'Pelayanan administrasi terlalu lama',
                'isi_pengaduan' => 'Proses pengurusan surat keterangan mahasiswa memerlukan waktu cukup lama dan belum ada informasi estimasi selesai yang jelas.',
            ],
            [
                'judul' => 'Area parkir tidak tertata',
                'isi_pengaduan' => 'Area parkir mahasiswa sering penuh dan beberapa kendaraan diparkir tidak sesuai jalur. Mohon ada penataan agar akses keluar masuk lebih lancar.',
            ],
        ]);

        return [
            'id_user' => User::factory()->mahasiswa(),
            'id_kategori' => KategoriPengaduan::factory(),
            'judul' => $laporan['judul'],
            'isi_pengaduan' => $laporan['isi_pengaduan'],
            'status' => fake()->randomElement(['pending', 'proses', 'selesai', 'ditolak']),
            'due_at' => now()->addDays(fake()->numberBetween(1, 5)),
        ];
    }

    /**
     * State: pending
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }

    /**
     * State: proses
     */
    public function proses(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'proses',
        ]);
    }

    /**
     * State: selesai
     */
    public function selesai(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'selesai',
        ]);
    }

    /**
     * State: ditolak
     */
    public function ditolak(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'ditolak',
        ]);
    }
}
