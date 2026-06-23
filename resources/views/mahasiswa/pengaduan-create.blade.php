@extends('layouts.mahasiswa')

@section('title', 'Buat Pengaduan')
@section('page_title', 'Buat Pengaduan')
@section('page_subtitle', 'Sampaikan laporan baru dengan data yang jelas dan lengkap.')

@section('content')
    <section class="page-hero">
        <article class="hero-card">
            <div class="eyebrow">Pengaduan baru</div>
            <h1>Buat laporan kampus yang mudah ditindaklanjuti.</h1>
            <p>Isi kategori, judul, kronologi, lokasi, dan lampiran pendukung bila ada. Laporan baru akan masuk sebagai status pending dan diverifikasi admin.</p>
        </article>

        <aside class="guide-card panel">
            <div>
                <strong>Checklist laporan</strong>
                <p>Gunakan judul singkat, tulis lokasi kejadian, jelaskan dampaknya, dan unggah bukti jika tersedia.</p>
            </div>
            <a href="{{ route('mahasiswa.dashboard') }}" class="btn-secondary">Kembali ke Dashboard</a>
        </aside>
    </section>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul style="padding-left:16px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="panel" style="max-width:860px;">
        <div class="panel-head">
            <div>
                <div class="panel-title">Form Pengaduan</div>
                <p class="panel-subtitle">Pastikan data yang dikirim benar agar admin dapat memproses laporan dengan cepat.</p>
            </div>
        </div>

        <form action="{{ route('mahasiswa.pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="form-grid">
            @csrf
            <div>
                <label for="id_kategori" class="form-label">Kategori Laporan</label>
                <select name="id_kategori" id="id_kategori" class="form-select" required>
                    <option value="">Pilih kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id_kategori }}" {{ old('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="judul" class="form-label">Judul Laporan</label>
                <input type="text" name="judul" id="judul" class="form-input" placeholder="Contoh: AC ruang H3-101 tidak dingin" required value="{{ old('judul') }}">
            </div>

            <div>
                <label for="priority" class="form-label">Prioritas</label>
                <select name="priority" id="priority" class="form-select" required>
                    @foreach($priorityLabels as $key => $label)
                        <option value="{{ $key }}" {{ old('priority', 'sedang') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                <div class="file-note">Gunakan Darurat hanya untuk kendala yang menghambat kegiatan akademik secara langsung.</div>
            </div>

            <div>
                <label for="isi_pengaduan" class="form-label">Detail Pengaduan</label>
                <textarea name="isi_pengaduan" id="isi_pengaduan" class="form-textarea" placeholder="Jelaskan kronologi, lokasi, waktu kejadian, dan dampaknya..." required>{{ old('isi_pengaduan') }}</textarea>
            </div>

            <div>
                <label for="lampiran" class="form-label">Lampiran <span style="color:var(--muted);font-weight:700;">Opsional</span></label>
                <input type="file" name="lampiran[]" id="lampiran" class="form-input" multiple accept=".pdf,.docx,.jpg,.jpeg,.png">
                <div class="file-note">Format: PDF, DOCX, JPG, PNG. Maksimal 2 MB per berkas.</div>
                <div id="filePreview" class="file-note" style="display:grid;gap:4px;margin-top:8px;"></div>
            </div>

            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <button type="submit" class="btn-primary">Kirim Pengaduan</button>
                <a href="{{ route('mahasiswa.dashboard') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </section>

    <script>
        document.getElementById('lampiran')?.addEventListener('change', function () {
            const preview = document.getElementById('filePreview');
            const files = Array.from(this.files || []);
            preview.innerHTML = files.length ? files.map((file) => {
                const size = (file.size / 1024 / 1024).toFixed(2);
                const warning = file.size > 2 * 1024 * 1024 ? ' - melebihi 2 MB' : '';
                return `<span>${file.name} (${size} MB)${warning}</span>`;
            }).join('') : '';
        });
    </script>
@endsection
