<?php

namespace Database\Seeders;

use App\Models\KategoriPengaduan;
use App\Models\ActivityLog;
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

        $contohPengaduan = [
            'Fasilitas Akademik' => [
                [
                    'judul' => 'AC ruang H3-101 tidak dingin',
                    'isi_pengaduan' => 'AC di ruang H3-101 sudah beberapa kali dinyalakan, tetapi udara tetap terasa panas. Kondisi ini membuat proses perkuliahan kurang nyaman, terutama saat kelas siang hari.',
                ],
                [
                    'judul' => 'Proyektor ruang kelas buram',
                    'isi_pengaduan' => 'Proyektor di ruang kelas sering menampilkan gambar buram dan warna kurang jelas. Materi presentasi dosen menjadi sulit dibaca dari barisan belakang.',
                ],
                [
                    'judul' => 'Kursi kuliah banyak yang rusak',
                    'isi_pengaduan' => 'Beberapa kursi di ruang kuliah sudah goyang dan sandarannya rusak. Mohon dilakukan pengecekan agar mahasiswa dapat belajar dengan lebih nyaman.',
                ],
            ],
            'Pelayanan Administrasi' => [
                [
                    'judul' => 'Pengurusan surat keterangan lama',
                    'isi_pengaduan' => 'Saya sudah mengajukan surat keterangan aktif kuliah, tetapi belum mendapatkan informasi lanjutan. Mohon ada estimasi waktu penyelesaian yang lebih jelas.',
                ],
                [
                    'judul' => 'Informasi jadwal pelayanan kurang jelas',
                    'isi_pengaduan' => 'Jam pelayanan administrasi sering berubah, tetapi informasinya belum diperbarui di papan pengumuman maupun kanal resmi kampus.',
                ],
                [
                    'judul' => 'Antrean loket administrasi terlalu panjang',
                    'isi_pengaduan' => 'Antrean di loket administrasi sering menumpuk pada jam tertentu. Mohon dipertimbangkan penambahan petugas atau sistem antrean yang lebih tertib.',
                ],
            ],
            'Infrastruktur Kampus' => [
                [
                    'judul' => 'Toilet lantai dua airnya tidak mengalir',
                    'isi_pengaduan' => 'Air di toilet lantai dua sering tidak mengalir pada siang hari. Kondisi ini mengganggu kenyamanan dan kebersihan pengguna toilet.',
                ],
                [
                    'judul' => 'Lampu koridor gedung mati',
                    'isi_pengaduan' => 'Beberapa lampu koridor gedung perkuliahan mati sejak minggu lalu. Area menjadi cukup gelap saat sore dan malam hari.',
                ],
                [
                    'judul' => 'Atap depan kelas bocor',
                    'isi_pengaduan' => 'Saat hujan, bagian depan kelas mengalami kebocoran dan air menetes ke lantai. Mohon segera diperbaiki agar tidak membahayakan mahasiswa.',
                ],
            ],
            'Keamanan & Parkir' => [
                [
                    'judul' => 'Area parkir motor tidak tertata',
                    'isi_pengaduan' => 'Area parkir motor sering penuh dan beberapa kendaraan diparkir di jalur keluar masuk. Mohon ada penataan agar akses lebih lancar.',
                ],
                [
                    'judul' => 'Helm mahasiswa sering tertukar',
                    'isi_pengaduan' => 'Beberapa mahasiswa mengalami helm tertukar di area parkir. Mohon ada pengawasan tambahan atau imbauan agar mahasiswa lebih berhati-hati.',
                ],
                [
                    'judul' => 'Penerangan area parkir kurang terang',
                    'isi_pengaduan' => 'Lampu di area parkir belakang kurang terang pada malam hari. Kondisi ini membuat mahasiswa merasa kurang aman saat mengambil kendaraan.',
                ],
            ],
            'Kebersihan Lingkungan' => [
                [
                    'judul' => 'Tempat sampah di koridor penuh',
                    'isi_pengaduan' => 'Tempat sampah di koridor gedung sering penuh hingga sampah berserakan. Mohon jadwal pengangkutan sampah bisa ditambah.',
                ],
                [
                    'judul' => 'Ruang kelas belum dibersihkan',
                    'isi_pengaduan' => 'Ruang kelas masih terdapat sampah kertas dan debu di beberapa meja sebelum perkuliahan dimulai. Mohon dilakukan pembersihan lebih rutin.',
                ],
                [
                    'judul' => 'Kantin kurang bersih setelah jam makan siang',
                    'isi_pengaduan' => 'Area kantin sering terlihat kotor setelah jam makan siang karena sisa makanan dan tisu berserakan. Mohon ada pembersihan berkala.',
                ],
            ],
            'Sistem IT & Jaringan' => [
                [
                    'judul' => 'Wi-Fi kampus sering terputus',
                    'isi_pengaduan' => 'Koneksi Wi-Fi di area kampus sering terputus saat digunakan untuk membuka e-learning dan mengunggah tugas. Mohon dilakukan pengecekan jaringan.',
                ],
                [
                    'judul' => 'Portal akademik sulit diakses',
                    'isi_pengaduan' => 'Portal akademik beberapa kali tidak dapat diakses saat mahasiswa ingin melihat jadwal dan nilai. Mohon dilakukan perbaikan agar layanan lebih stabil.',
                ],
                [
                    'judul' => 'E-learning lambat saat unggah tugas',
                    'isi_pengaduan' => 'Halaman e-learning terasa lambat saat mahasiswa mengunggah tugas, terutama menjelang batas waktu pengumpulan. Mohon kapasitas server diperiksa.',
                ],
            ],
        ];

        // 3. Seed Pengaduan beserta Lampiran, StatusLog, dan Tanggapan
        // Membuat 15 data pengaduan secara acak dengan relasi logis
        foreach (range(1, 15) as $i) {
            $mahasiswa = $mahasiswas->random();
            $kategori = $kategoris->random();
            $status = fake()->randomElement(['pending', 'proses', 'selesai', 'ditolak']);
            $laporan = fake()->randomElement($contohPengaduan[$kategori->nama_kategori] ?? $contohPengaduan['Fasilitas Akademik']);

            $pengaduan = Pengaduan::create([
                'id_user' => $mahasiswa->id_user,
                'id_kategori' => $kategori->id_kategori,
                'judul' => $laporan['judul'],
                'isi_pengaduan' => $laporan['isi_pengaduan'],
                'status' => $status,
                'due_at' => now()->subDays(fake()->numberBetween(0, 2))->addDays(3),
            ]);

            ActivityLog::create([
                'id_user' => $mahasiswa->id_user,
                'id_pengaduan' => $pengaduan->id_pengaduan,
                'action' => 'pengaduan_dibuat',
                'description' => 'Mahasiswa membuat pengaduan melalui dashboard.',
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
