<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi Pengaduan Mahasiswa</title>
    <!-- Inter Font (Standard & Professional) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #f3f4f6;
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --text-main: #1f2937;
            --text-muted: #4b5563;
            --card-bg: #ffffff;
            --border-color: #e5e7eb;
            --input-border: #d1d5db;
            --danger: #dc2626;
            --success: #16a34a;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 32px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .header {
            text-align: center;
            margin-bottom: 24px;
        }

        .logo-text {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-main);
            line-height: 1.3;
            margin-bottom: 8px;
        }

        .subtitle {
            font-size: 13.5px;
            color: var(--text-muted);
            line-height: 1.4;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 20px;
            line-height: 1.4;
            border: 1px solid transparent;
        }

        .alert-danger {
            background: #fef2f2;
            border-color: #fecaca;
            color: #b91c1c;
        }

        .alert-success {
            background: #f0fdf4;
            border-color: #bbf7d0;
            color: #15803d;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 6px;
        }

        .form-input {
            width: 100%;
            background: #ffffff;
            border: 1px solid var(--input-border);
            border-radius: 6px;
            padding: 10px 12px;
            font-size: 14px;
            color: var(--text-main);
            outline: none;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        .form-input::placeholder {
            color: #9ca3af;
        }

        .remember-forgot {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
            font-size: 13.5px;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            color: var(--text-muted);
        }

        .checkbox-container input {
            cursor: pointer;
            accent-color: var(--primary);
            width: 15px;
            height: 15px;
        }

        .btn-submit {
            width: 100%;
            background-color: var(--primary);
            color: #ffffff;
            border: none;
            border-radius: 6px;
            padding: 11px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.15s ease-in-out;
        }

        .btn-submit:hover {
            background-color: var(--primary-hover);
        }

        .footer-info {
            text-align: center;
            margin-top: 24px;
            font-size: 12px;
            color: var(--text-muted);
            border-top: 1px solid var(--border-color);
            padding-top: 16px;
        }

        .footer-info code {
            background: #e5e7eb;
            color: #1f2937;
            padding: 1px 4px;
            border-radius: 4px;
            font-size: 11.5px;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="header">
            <div class="logo-text">Sistem Informasi Pengaduan Mahasiswa</div>
            <div class="subtitle">Silakan login menggunakan akun universitas Anda untuk mengakses layanan pengaduan.</div>
        </div>

        <!-- Notification Alerts -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-input" placeholder="contoh@example.com" value="{{ old('email') }}" required autocomplete="email" autofocus>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-input" placeholder="Password" required autocomplete="current-password">
            </div>

            <div class="remember-forgot">
                <label class="checkbox-container">
                    <input type="checkbox" name="remember">
                    <span>Ingat saya</span>
                </label>
            </div>

            <button type="submit" class="btn-submit">Login</button>
        </form>

        <div class="footer-info">
            <p>&copy; 2026 MPTI Kelompok Sigma.</p>
            <p style="margin-top: 4px;">Uji coba: <code>mahasiswa@example.com</code> / <code>password</code></p>
        </div>
    </div>

</body>
</html>
