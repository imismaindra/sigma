@extends('layouts.admin')

@section('title', 'Manajemen Kategori')

@section('content')
    <section class="bg-white/80 backdrop-blur-md border border-slate-200/80 rounded-2xl p-6 shadow-sm relative overflow-hidden mb-6">
        <div class="absolute -right-24 -bottom-24 w-64 h-64 rounded-full bg-indigo-500/5 blur-3xl pointer-events-none"></div>
        <div class="relative z-10">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-100 text-[10px] font-bold text-indigo-650 uppercase mb-3">
                <i data-lucide="tag" class="w-3.5 h-3.5"></i>
                Kontrol Kategori
            </span>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 leading-tight tracking-tight">Manajemen Kategori Pengaduan</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-2 font-medium leading-relaxed">
                Kelola kategori pengaduan yang tersedia untuk mahasiswa saat membuat laporan baru.
            </p>
        </div>
    </section>

    @if($errors->any())
        <div class="p-4 mb-6 text-xs font-semibold text-rose-700 bg-rose-50 border border-rose-100 rounded-xl space-y-1.5 shadow-3xs">
            <strong class="block text-rose-800 text-[13px]">Gagal memproses data:</strong>
            @foreach ($errors->all() as $error)
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-rose-600 flex-shrink-0"></span>
                    <span>{{ $error }}</span>
                </div>
            @endforeach
        </div>
    @endif

    <section class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-3xs mb-6">
        <h3 class="text-sm font-extrabold text-slate-900 border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
            <i data-lucide="plus-circle" class="w-4.5 h-4.5 text-indigo-650"></i> Tambah Kategori Baru
        </h3>
        <form action="{{ route('admin.kategori.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-12 gap-3">
            @csrf
            <div class="sm:col-span-4">
                <input type="text" name="nama_kategori" class="w-full h-8.5 text-xs border border-slate-200 rounded-lg px-2.5 bg-white focus:border-indigo-650 focus:ring-2 focus:ring-indigo-500/10 outline-none transition-all font-semibold" placeholder="Nama Kategori Baru" required>
            </div>
            <div class="sm:col-span-5">
                <input type="text" name="deskripsi" class="w-full h-8.5 text-xs border border-slate-200 rounded-lg px-2.5 bg-white focus:border-indigo-650 focus:ring-2 focus:ring-indigo-500/10 outline-none transition-all font-semibold" placeholder="Deskripsi Singkat Kategori">
            </div>
            <div class="sm:col-span-3 flex items-center justify-between gap-2.5">
                <label class="relative inline-flex items-center cursor-pointer select-none">
                    <input type="checkbox" name="status_aktif" value="1" checked class="sr-only peer">
                    <div class="w-8 h-4.5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-3.5 after:w-3.5 after:transition-all peer-checked:bg-indigo-600"></div>
                    <span class="ml-1.5 text-[10px] font-bold text-slate-650">Aktif</span>
                </label>
                <button type="submit" class="h-8.5 px-3 bg-indigo-600 hover:bg-indigo-750 text-white rounded-lg text-xs font-bold transition-colors cursor-pointer flex items-center gap-1">
                    <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah
                </button>
            </div>
        </form>
    </section>

    <section class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm">
        <h3 class="text-sm font-extrabold text-slate-900 border-b border-slate-100 pb-3.5 mb-4 flex items-center gap-2">
            <i data-lucide="list" class="w-4.5 h-4.5 text-indigo-600"></i> Daftar Kategori ({{ $kategoris->count() }})
        </h3>

        <div class="border border-slate-200/80 rounded-xl overflow-hidden bg-white">
            <div class="hidden lg:grid lg:grid-cols-12 gap-3.5 items-center bg-slate-50 border-b border-slate-200/85 px-4.5 py-3 text-[10px] font-bold text-slate-500 uppercase tracking-wider">
                <div class="col-span-3">Nama Kategori</div>
                <div class="col-span-5">Deskripsi</div>
                <div class="col-span-2">Status & Jumlah</div>
                <div class="col-span-2 text-right">Aksi</div>
            </div>

            <div class="divide-y divide-slate-150/60">
                @forelse($kategoris as $kategori)
                    <form action="{{ route('admin.kategori.update', $kategori->id_kategori) }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-3 p-4.5 items-center hover:bg-slate-50/40 transition-colors">
                        @csrf
                        @method('PUT')

                        <div class="col-span-3">
                            <label class="lg:hidden block text-[9px] font-bold text-slate-400 uppercase mb-1">Nama Kategori</label>
                            <input type="text" name="nama_kategori" class="w-full h-8.5 text-xs bg-transparent border-b border-transparent focus:border-indigo-650 focus:bg-white px-2 rounded-sm outline-none transition-all font-bold text-slate-800" value="{{ $kategori->nama_kategori }}" required>
                        </div>

                        <div class="col-span-5">
                            <label class="lg:hidden block text-[9px] font-bold text-slate-400 uppercase mb-1">Deskripsi</label>
                            <input type="text" name="deskripsi" class="w-full h-8.5 text-xs bg-transparent border-b border-transparent focus:border-indigo-650 focus:bg-white px-2 rounded-sm outline-none transition-all font-semibold text-slate-650" value="{{ $kategori->deskripsi }}" placeholder="Belum ada deskripsi">
                        </div>

                        <div class="col-span-2 flex items-center gap-2">
                            <label class="relative inline-flex items-center cursor-pointer select-none">
                                <input type="checkbox" name="status_aktif" value="1" {{ $kategori->status_aktif ? 'checked' : '' }} onchange="this.form.submit()" class="sr-only peer">
                                <div class="w-8 h-4.5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-3.5 after:w-3.5 after:transition-all peer-checked:bg-indigo-650"></div>
                                <span class="ml-1.5 text-[10px] font-bold text-slate-650">{{ $kategori->status_aktif ? 'Aktif' : 'Nonaktif' }}</span>
                            </label>
                            <span class="text-[10px] font-bold text-slate-450">({{ $kategori->pengaduan_count }} aduan)</span>
                        </div>

                        <div class="col-span-2 text-right">
                            <button type="submit" class="w-8.5 h-8.5 rounded-lg bg-indigo-50 border border-indigo-150/40 text-indigo-600 hover:bg-indigo-100 flex items-center justify-center transition-colors cursor-pointer ml-auto" title="Simpan Perubahan">
                                <i data-lucide="save" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </form>
                @empty
                    <div class="text-center py-12 text-slate-450 flex flex-col items-center gap-2">
                        <i data-lucide="tag" class="w-8 h-8 text-slate-350"></i>
                        <span>Belum ada kategori pengaduan.</span>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection