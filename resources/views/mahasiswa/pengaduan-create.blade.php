@extends('layouts.mahasiswa')

@section('title', 'Buat Pengaduan')
@section('page_title', 'Buat Pengaduan')
@section('page_subtitle', 'Sampaikan laporan baru dengan menyertakan data yang jelas dan lengkap.')

@section('content')
    <!-- Hero Header Card -->
    <section class="page-hero">
        <article class="hero-card bg-gradient-to-tr from-white to-slate-50/50">
            <div class="eyebrow">Pengaduan Baru</div>
            <h1>Buat laporan pengaduan yang mudah ditindaklanjuti.</h1>
            <p>Isi kategori laporan, judul aduan, kronologi kejadian secara lengkap, prioritas urgensi, dan sertakan dokumen lampiran pendukung bila tersedia agar proses penanganan berjalan lancar.</p>
        </article>

        <aside class="guide-card panel bg-white/85">
            <div>
                <strong class="flex items-center gap-1.5 text-indigo-650"><i data-lucide="shield-alert" class="w-4.5 h-4.5"></i> Checklist Laporan</strong>
                <p>Gunakan judul laporan yang ringkas, tunjukkan lokasi kejadian fisik secara detail, sebutkan dampaknya, dan lampirkan bukti foto/dokumen pendukung.</p>
            </div>
            <a href="{{ route('mahasiswa.dashboard') }}" class="btn-secondary flex items-center justify-center gap-1.5"><i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Dashboard</a>
        </aside>
    </section>

    <!-- Error validation banner -->
    @if($errors->any())
        <div class="alert alert-danger shadow-3xs flex flex-col gap-1.5">
            <div class="font-extrabold flex items-center gap-1.5"><i data-lucide="alert-octagon" class="w-4 h-4"></i> Mohon lengkapi formulir Anda:</div>
            <ul class="pl-5 list-disc text-xs space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Create Form Card -->
    <section class="panel bg-white/90 max-w-4xl">
        <div class="panel-head">
            <div>
                <div class="panel-title flex items-center gap-1.5"><i data-lucide="file-plus" class="w-4.5 h-4.5 text-indigo-650"></i> Formulir Pembuatan Pengaduan</div>
                <p class="panel-subtitle">Pastikan data pengaduan yang Anda masukkan sesuai fakta agar mempercepat verifikasi pihak terkait.</p>
            </div>
        </div>

        <form action="{{ route('mahasiswa.pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="id_kategori" class="form-label">Kategori Laporan</label>
                    <div class="relative">
                        <select name="id_kategori" id="id_kategori" class="form-select font-semibold cursor-pointer" required>
                            <option value="">Pilih kategori aduan...</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id_kategori }}" {{ old('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label for="priority" class="form-label">Tingkat Urgensi (Prioritas)</label>
                    <select name="priority" id="priority" class="form-select font-semibold cursor-pointer" required>
                        @foreach($priorityLabels as $key => $label)
                            <option value="{{ $key }}" {{ old('priority', 'sedang') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    <div class="file-note mt-1">Pilih status Darurat hanya jika kendala menghalangi proses perkuliahan/akademik secara langsung.</div>
                </div>
            </div>

            <div>
                <label for="judul" class="form-label">Judul Aduan Singkat</label>
                <input type="text" name="judul" id="judul" class="form-input font-semibold" placeholder="Contoh: Lampu Proyektor ruang H3-101 tidak menyala" required value="{{ old('judul') }}">
            </div>

            <div>
                <div class="flex justify-between items-center mb-1.5">
                    <label for="isi_pengaduan" class="form-label mb-0">Kronologi & Detail Pengaduan</label>
                    <span id="charCount" class="text-[10px] font-bold text-slate-400">0 Karakter</span>
                </div>
                <textarea name="isi_pengaduan" id="isi_pengaduan" class="form-textarea font-semibold" placeholder="Jelaskan secara rinci kronologi kejadian, lokasi gedung/ruangan, waktu kejadian, dan dampak dari masalah tersebut..." required>{{ old('isi_pengaduan') }}</textarea>
            </div>

            <!-- Premium dropzone wrapper for files upload -->
            <div>
                <label for="lampiran" class="form-label flex items-center justify-between">
                    <span>Lampiran Bukti Pengaduan <span class="text-slate-450 font-bold">(Opsional)</span></span>
                    <span class="text-[10px] text-indigo-600 font-bold">Maks. 2MB / Berkas</span>
                </label>
                
                <div class="border-2 border-dashed border-slate-200 hover:border-indigo-500 rounded-2xl p-6 bg-slate-50/50 hover:bg-slate-50 transition-all flex flex-col items-center justify-center text-center relative group">
                    <input type="file" name="lampiran[]" id="lampiran" class="absolute inset-0 opacity-0 cursor-pointer z-10 w-full h-full" multiple accept=".pdf,.docx,.jpg,.jpeg,.png">
                    <div class="w-12 h-12 rounded-xl bg-white border border-slate-200 text-slate-450 group-hover:text-indigo-650 group-hover:scale-105 transition-all shadow-3xs flex items-center justify-center mb-3">
                        <i data-lucide="upload-cloud" class="w-6 h-6"></i>
                    </div>
                    <p class="text-xs font-bold text-slate-800">Klik atau seret file ke sini untuk mengunggah</p>
                    <p class="text-[10px] text-slate-450 mt-1">Mendukung format: PDF, DOCX, JPG, JPEG, PNG. Maksimal berkas 2 MB.</p>
                </div>
                
                <div id="filePreview" class="grid gap-3.5 mt-4 grid-cols-1 sm:grid-cols-2"></div>
            </div>

            <div class="flex gap-3 pt-4 border-t border-slate-100 justify-end">
                <button type="submit" class="btn-primary flex items-center gap-1.5"><i data-lucide="send" class="w-4 h-4"></i> Kirim Laporan</button>
                <a href="{{ route('mahasiswa.dashboard') }}" class="btn-secondary flex items-center gap-1.5"><i data-lucide="x" class="w-4 h-4"></i> Batal</a>
            </div>
        </form>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Textarea live character counter
            const textarea = document.getElementById('isi_pengaduan');
            const countLabel = document.getElementById('charCount');
            
            textarea?.addEventListener('input', function() {
                const count = this.value.length;
                countLabel.textContent = `${count} Karakter`;
            });

            // File uploading preview logic
            document.getElementById('lampiran')?.addEventListener('change', function () {
                const preview = document.getElementById('filePreview');
                if(!preview) return;

                const files = Array.from(this.files || []);
                preview.innerHTML = ''; // Reset

                if (files.length === 0) return;

                files.forEach((file) => {
                    const sizeInMb = (file.size / (1024 * 1024)).toFixed(2);
                    const isTooLarge = file.size > 2 * 1024 * 1024;
                    const containerClass = isTooLarge
                        ? 'border border-rose-200 bg-rose-50/50 text-rose-750 p-3 rounded-xl flex items-center justify-between gap-3 text-xs shadow-3xs'
                        : 'border border-slate-200 bg-white text-slate-700 p-3 rounded-xl flex items-center justify-between gap-3 text-xs shadow-3xs hover:border-indigo-250 transition-all';
                    
                    const fileCard = document.createElement('div');
                    fileCard.className = containerClass;
                    
                    let previewIcon = '<i data-lucide="file-text" class="w-5 h-5 flex-shrink-0 text-slate-450"></i>';
                    if (file.type.startsWith('image/')) {
                        previewIcon = '<i data-lucide="image" class="w-5 h-5 flex-shrink-0 text-indigo-650"></i>';
                    }

                    fileCard.innerHTML = `
                        <div class="flex items-center gap-2.5 min-w-0">
                            ${previewIcon}
                            <div class="min-w-0">
                                <p class="font-bold truncate text-slate-800" title="${file.name}">${file.name}</p>
                                <p class="text-[9px] font-bold text-slate-450 uppercase">${sizeInMb} MB ${isTooLarge ? '• UKURAN MELEBIHI BATAS!' : '• Siap diunggah'}</p>
                            </div>
                        </div>
                        ${isTooLarge ? '<i data-lucide="alert-triangle" class="w-4 h-4 text-rose-600 flex-shrink-0"></i>' : '<i data-lucide="check" class="w-4 h-4 text-emerald-600 flex-shrink-0"></i>'}
                    `;
                    
                    preview.appendChild(fileCard);
                });

                if (window.lucide) {
                    window.lucide.createIcons();
                }
            });
        });
    </script>
@endsection
