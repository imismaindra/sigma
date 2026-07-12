# Product Requirements Document (PRD) — SIPMA

**Sistem Informasi Pengaduan Mahasiswa**  
**Versi:** 1.0 | **Tanggal:** 11 Juni 2026  
**Mata Kuliah:** Manajemen Proyek Teknologi Informasi (MPTI)

---

## 1. Latar Belakang

Mahasiswa sering menghadapi berbagai permasalahan akademik, administrasi, fasilitas, dan layanan kampus lainnya yang membutuhkan wadah pengaduan yang terstruktur, transparan, dan terdokumentasi. Saat ini banyak kampus belum memiliki sistem terpusat untuk mencatat, memverifikasi, memproses, dan melaporkan pengaduan mahasiswa secara digital.

---

## 2. Tujuan

- Menyediakan platform pengaduan mahasiswa yang tertib, transparan, dan terdokumentasi.
- Mempermudah mahasiswa menyampaikan keluhan dan memantau status penanganan.
- Membantu admin/pengelola dalam memverifikasi, memproses, dan memberikan tanggapan.
- Menyediakan laporan dan statistik bagi pimpinan untuk evaluasi layanan kampus.

---

## 3. Ruang Lingkup

### 3.1 Pengguna & Role

| Role | Deskripsi |
|------|-----------|
| Mahasiswa | Melihat dashboard, membuat & mengelola pengaduan, mengirim komentar, konfirmasi selesai, reopen |
| Admin Kemahasiswaan | Dashboard admin, verifikasi, proses, tolak pengaduan, kelola kategori & pengguna, export data |
| Pimpinan / Reviewer | Melihat laporan dan statistik pengaduan |
| Super Admin | Seluruh akses admin + manajemen pengguna sistem |

### 3.2 Kategori Pengaduan

1. Akademik — jadwal, dosen, nilai, kelas, pembelajaran
2. Administrasi — surat, pembayaran, registrasi
3. Fasilitas — ruang kelas, laboratorium, internet, toilet, parkir
4. Kemahasiswaan — organisasi, beasiswa, kegiatan mahasiswa
5. Keamanan dan Kenyamanan — keamanan lingkungan, ketertiban

### 3.3 Alur Status Pengaduan

```
Diajukan → Diverifikasi → Diproses → Selesai
                                      → Ditolak (dengan alasan)
```

Mahasiswa dapat *reopen* jika pengaduan selesai tetapi masalah belum teratasi.

---

## 4. Fitur Utama

### 4.1 Autentikasi & Manajemen Akun
- Register & Login (email & password)
- Role-based access control (RBAC)
- Manajemen pengguna oleh super admin

### 4.2 Dashboard Mahasiswa
- Ringkasan jumlah pengaduan (total, diajukan, diproses, selesai)
- Tiket terbaru dan statusnya
- Riwayat pengaduan dalam bentuk tabel
- Alur pengaduan (informasi visual)

### 4.3 Form Pengaduan
- Pemilihan kategori & prioritas (Tinggi/Sedang/Rendah)
- Judul, deskripsi, dan lampiran file (PDF/JPG/PNG)
- Nomor tiket otomatis (format: `SPM-YYYY-NNN`)

### 4.4 Detail & Riwayat Pengaduan
- Informasi lengkap tiket
- Timeline perubahan status
- Tanggapan admin
- Lampiran dan komentar

### 4.5 Dashboard Admin
- Ringkasan jumlah pengaduan tiap status
- Filter (kategori, status, prioritas, tanggal)
- Tabel daftar pengaduan dengan aksi detail
- Update status (verifikasi, proses, tolak, selesai)
- Beri tanggapan pada pengaduan

### 4.6 Manajemen Kategori
- CRUD kategori pengaduan
- Aktif/nonaktifkan kategori

### 4.7 Laporan & Statistik
- Filter berdasarkan periode, kategori, dan status
- Grafik distribusi per status
- Grafik distribusi per kategori
- Tabel ringkasan evaluasi (total, selesai, rata-rata penanganan)
- Export data

### 4.8 Profil Mahasiswa
- Lihat dan edit profil

---

## 5. Alur Bisnis Utama

1. **Mahasiswa** login → buat pengaduan (pilih kategori, prioritas, isi deskripsi, lampirkan bukti) → sistem generate nomor tiket → status **Diajukan**
2. **Admin** melihat pengaduan baru → verifikasi kelengkapan data → status **Diverifikasi**
3. **Admin** meneruskan ke unit terkait → status **Diproses** + catatan/tanggapan
4. **Admin** menyelesaikan penanganan → status **Selesai** atau **Ditolak** (dengan alasan)
5. **Mahasiswa** menerima notifikasi → konfirmasi selesai, atau **reopen** jika masalah belum teratasi

---

## 6. Tech Stack

| Layer | Teknologi |
|-------|-----------|
| Backend | PHP 8.3 / Laravel 13 |
| Frontend | Blade, Tailwind CSS 4 |
| Build Tool | Vite 8 + laravel-vite-plugin |
| Database | SQLite (dev), support migrasi ke MySQL/PostgreSQL |
| Session | Database session driver |
| Cache | Database cache driver |
| Queue | Database queue driver |

---

## 7. Struktur Database (Early Design)

### Tabel Utama
- `users` — id, nama, email, password, role (mahasiswa/admin/pimpinan/super_admin), nim, prodi, no_hp, avatar
- `pengaduans` — id, user_id, kategori_id, no_tiket, judul, deskripsi, prioritas, status, lampiran, created_at
- `kategoris` — id, nama, deskripsi, is_active
- `status_logs` — id, pengaduan_id, status, keterangan, user_id, created_at
- `tanggapans` — id, pengaduan_id, user_id, isi, created_at
- `komentars` — id, pengaduan_id, user_id, isi, created_at
- `notifikasis` — id, user_id, pengaduan_id, judul, isi, is_read, created_at

---

## 8. Non-Functional Requirements

- **Keamanan:** Autentikasi wajib, RBAC, validasi input, proteksi CSRF
- **Responsivitas:** Tampilan mobile-friendly dengan Tailwind CSS
- **Audit Trail:** Semua perubahan status tercatat di `status_logs`
- **SLA:** Prioritas tinggi ditangani lebih cepat
- **Dokumentasi:** Kode terdokumentasi dengan komentar pada logika bisnis kompleks

---

## 9. Milestone Pengembangan

| Fase | Kegiatan |
|------|----------|
| Fase 1 | Setup proyek Laravel, database, autentikasi, RBAC |
| Fase 2 | CRUD kategori, form & penyimpanan pengaduan |
| Fase 3 | Dashboard mahasiswa & admin, detail pengaduan |
| Fase 4 | Alur status, tanggapan, komentar, reopen |
| Fase 5 | Laporan, statistik, export data |
| Fase 6 | Pengujian, deployment, dokumentasi |

---

## 10. Dokumen Terkait

- [UI/UX Mockup — Figma / Static HTML](MPTI-UI/)
- [README](README.md)
- Database migration files di `database/migrations/`
- Route definitions di `routes/web.php`
