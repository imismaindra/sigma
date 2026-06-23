<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User - SIPMA</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary:#2563eb; --dark:#1e3a8a; --bg:#f3f6fb; --card:#fff; --border:#e2e8f0; --text:#0f172a; --muted:#64748b; --danger:#dc2626; }
        * { box-sizing:border-box; margin:0; padding:0; font-family:'Inter',-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif; }
        body { min-height:100vh; background:var(--bg); color:var(--text); }
        .navbar { min-height:64px; padding:0 28px; background:var(--dark); color:#fff; display:flex; align-items:center; justify-content:space-between; gap:16px; }
        .navbar a { color:#fff; text-decoration:none; font-weight:800; }
        .container { width:100%; max-width:1500px; margin:0 auto; padding:24px 24px 48px; }
        .header, .card { background:var(--card); border:1px solid var(--border); border-radius:10px; box-shadow:0 10px 30px rgba(15,23,42,.06); }
        .header { padding:22px; margin-bottom:18px; display:flex; justify-content:space-between; gap:16px; align-items:flex-start; }
        h1 { font-size:24px; margin-bottom:6px; }
        p { color:var(--muted); font-size:14px; line-height:1.55; }
        .card { padding:18px; margin-bottom:18px; }
        .section-title { font-size:16px; font-weight:800; margin-bottom:14px; }
        .grid { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:12px; }
        .filter { display:grid; grid-template-columns:minmax(180px,1fr) 150px 190px auto; gap:10px; align-items:end; }
        label { display:block; font-size:12px; font-weight:800; margin-bottom:6px; }
        input, select { width:100%; min-height:42px; border:1px solid var(--border); border-radius:8px; padding:0 36px 0 12px; font-size:13px; background:#f8fafc; color:var(--text); }
        select { appearance:auto; white-space:nowrap; text-overflow:ellipsis; }
        .role-select { min-width:150px; font-weight:700; }
        .btn { min-height:42px; border:0; border-radius:8px; background:var(--primary); color:#fff; padding:0 14px; font-size:13px; font-weight:800; cursor:pointer; text-decoration:none; display:inline-flex; align-items:center; justify-content:center; }
        .btn-soft { background:#fff; color:var(--dark); border:1px solid var(--border); }
        .badge { display:inline-flex; min-height:24px; align-items:center; border-radius:999px; padding:0 9px; font-size:11px; font-weight:800; }
        .badge-aktif { background:#dcfce7; color:#166534; }
        .badge-nonaktif { background:#fee2e2; color:#991b1b; }
        .badge-menunggu_verifikasi { background:#fef3c7; color:#92400e; }
        .row-form { display:grid; grid-template-columns:140px 130px 190px 125px 155px 150px auto; gap:8px; align-items:end; }
        .user-sheet { border:1px solid var(--border); border-radius:12px; overflow:hidden; background:#fff; }
        .user-row,
        .user-head {
            display:grid;
            grid-template-columns:minmax(150px,1.05fr) minmax(120px,.75fr) minmax(190px,1.3fr) minmax(140px,.75fr) minmax(160px,.85fr) minmax(160px,.9fr) 96px;
            gap:10px;
            align-items:center;
        }
        .user-head { min-height:42px; padding:0 12px; background:#f8fafc; color:var(--muted); font-size:11px; font-weight:800; text-transform:uppercase; letter-spacing:.04em; border-bottom:1px solid var(--border); }
        .user-row { padding:12px; border-bottom:1px solid var(--border); }
        .user-row:last-child { border-bottom:0; }
        .user-row input,
        .user-row select { min-height:40px; }
        .user-primary { display:flex; flex-direction:column; gap:4px; min-width:0; }
        .user-primary small { color:var(--muted); font-size:11px; font-weight:700; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
        .field-full { min-width:0; }
        .sr-label { position:absolute; width:1px; height:1px; padding:0; margin:-1px; overflow:hidden; clip:rect(0,0,0,0); white-space:nowrap; border:0; }
        .save-cell { display:flex; align-items:center; }
        .save-cell .btn { width:100%; min-height:40px; }
        .simple-pagination { display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap; border-top:1px solid var(--border); padding-top:14px; margin-top:16px; }
        .page-button { min-height:36px; border:1px solid var(--border); border-radius:8px; padding:0 12px; display:inline-flex; align-items:center; justify-content:center; background:#fff; color:var(--dark); text-decoration:none; font-size:12px; font-weight:800; }
        .page-button.disabled { color:#94a3b8; background:#f8fafc; cursor:not-allowed; }
        .page-info { color:var(--muted); font-size:13px; font-weight:700; display:flex; flex-direction:column; gap:2px; text-align:center; }
        .page-info span { font-size:12px; font-weight:600; }
        @media(max-width:1180px){
            .user-head { display:none; }
            .user-row { grid-template-columns:repeat(3,minmax(0,1fr)); align-items:end; }
            .sr-label { position:static; width:auto; height:auto; margin:0; overflow:visible; clip:auto; white-space:normal; display:block; font-size:12px; font-weight:800; margin-bottom:6px; }
        }
        @media(max-width:820px){ .navbar{padding:12px 16px;align-items:flex-start;flex-direction:column}.container{padding:20px 14px 34px}.header{display:block}.grid,.filter,.row-form{grid-template-columns:1fr}.user-row{grid-template-columns:1fr}.save-cell .btn{width:100%;} }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('admin.dashboard') }}">SIPMA Admin</a>
        <a href="{{ route('admin.dashboard') }}">Kembali ke Dashboard</a>
    </nav>

    <main class="container">
        <section class="header">
            <div>
                <h1>Manajemen User</h1>
                <p>Kelola akun mahasiswa, admin, pimpinan, dan status akun yang boleh mengakses sistem.</p>
            </div>
        </section>

        @if($errors->any())
            <div class="card" style="border-color:#fecaca;color:#991b1b;">
                <ul style="padding-left:18px;">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <section class="card">
            <div class="section-title">Tambah User</div>
            <form action="{{ route('admin.users.store') }}" method="POST" class="grid">
                @csrf
                <div><label>Nama</label><input type="text" name="nama" required></div>
                <div><label>NIM/NIP</label><input type="text" name="nim_nip" required></div>
                <div><label>Email</label><input type="email" name="email" required></div>
                <div><label>Role</label><select name="role" class="role-select" required>@foreach($roles as $role)<option value="{{ $role }}">{{ Str::title(str_replace('_',' ', $role)) }}</option>@endforeach</select></div>
                <div><label>Status Akun</label><select name="account_status" required>@foreach($statuses as $key => $label)<option value="{{ $key }}">{{ $label }}</option>@endforeach</select></div>
                <div><label>Password</label><input type="password" name="password" required></div>
                <div style="display:flex;align-items:end;"><button type="submit" class="btn" style="width:100%;">Tambah User</button></div>
            </form>
        </section>

        <section class="card">
            <div class="section-title">Filter User</div>
            <form action="{{ route('admin.users.index') }}" method="GET" class="filter">
                <div><label>Cari</label><input type="text" name="q" value="{{ request('q') }}" placeholder="Nama, email, NIM/NIP"></div>
                <div><label>Role</label><select name="role" class="role-select"><option value="">Semua</option>@foreach($roles as $role)<option value="{{ $role }}" {{ request('role') === $role ? 'selected' : '' }}>{{ Str::title(str_replace('_',' ', $role)) }}</option>@endforeach</select></div>
                <div><label>Status Akun</label><select name="account_status"><option value="">Semua</option>@foreach($statuses as $key => $label)<option value="{{ $key }}" {{ request('account_status') === $key ? 'selected' : '' }}>{{ $label }}</option>@endforeach</select></div>
                <div style="display:flex;gap:8px;"><button type="submit" class="btn">Filter</button><a href="{{ route('admin.users.index') }}" class="btn btn-soft">Reset</a></div>
            </form>
        </section>

        <section class="card">
            <div class="section-title">Daftar User</div>
            <div class="user-sheet">
                <div class="user-head">
                    <div>Nama</div>
                    <div>NIM/NIP</div>
                    <div>Email</div>
                    <div>Role</div>
                    <div>Status Akun</div>
                    <div>Password Baru</div>
                    <div>Aksi</div>
                </div>
                @forelse($users as $user)
                    <form action="{{ route('admin.users.update', $user->id_user) }}" method="POST" class="user-row">
                            @csrf
                            @method('PUT')
                            <div class="field-full">
                                <label class="sr-label">Nama</label>
                                <input type="text" name="nama" value="{{ $user->nama }}" required>
                            </div>
                            <div class="field-full">
                                <label class="sr-label">NIM/NIP</label>
                                <input type="text" name="nim_nip" value="{{ $user->nim_nip }}" required>
                            </div>
                            <div class="field-full">
                                <label class="sr-label">Email</label>
                                <input type="email" name="email" value="{{ $user->email }}" required>
                            </div>
                            <div class="field-full">
                                <label class="sr-label">Role</label>
                                <select name="role" class="role-select" required>
                                    @foreach($roles as $role)
                                        <option value="{{ $role }}" {{ $user->role === $role ? 'selected' : '' }}>{{ Str::title(str_replace('_',' ', $role)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="field-full">
                                <label class="sr-label">Status Akun</label>
                                <select name="account_status" required>
                                    @foreach($statuses as $key => $label)
                                        <option value="{{ $key }}" {{ ($user->account_status ?? 'aktif') === $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="field-full">
                                <label class="sr-label">Password Baru</label>
                                <input type="password" name="password" placeholder="Kosongkan jika tetap">
                            </div>
                            <div class="save-cell">
                                <button type="submit" class="btn">Simpan</button>
                            </div>
                    </form>
                @empty
                    <div style="padding:18px;">
                        <p>Belum ada user yang cocok dengan filter.</p>
                    </div>
                @endforelse
            </div>
            @include('partials.simple-pagination', ['paginator' => $users])
        </section>
    </main>
    @include('partials.toast')
</body>
</html>
