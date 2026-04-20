<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Pengajuan Cuti</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <style>
        :root {
            --bg: #f6f1e8;
            --panel: rgba(255, 255, 255, 0.88);
            --ink: #2d2218;
            --muted: #6a5a4a;
            --line: rgba(76, 57, 34, 0.12);
            --primary: #9f6c3d;
            --primary-dark: #72431f;
            --success: #1f7a5a;
            --danger: #b74343;
            --shadow: 0 24px 70px rgba(71, 46, 20, 0.14);
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at top left, rgba(216, 180, 141, 0.6), transparent 32%),
                radial-gradient(circle at bottom right, rgba(159, 108, 61, 0.18), transparent 28%),
                var(--bg);
        }
        a { color: inherit; text-decoration: none; }
        .shell { width: min(1180px, calc(100% - 32px)); margin: 24px auto 48px; }
        .nav { display: flex; align-items: center; justify-content: space-between; padding: 20px 0; }
        .brand { display: flex; gap: 14px; align-items: center; font-weight: 800; letter-spacing: .02em; }
        .brand-mark {
            width: 46px; height: 46px; border-radius: 14px; display: grid; place-items: center; color: #fff;
            background: linear-gradient(145deg, var(--primary), var(--primary-dark)); box-shadow: var(--shadow);
        }
        .btn {
            display: inline-flex; align-items: center; justify-content: center; padding: 13px 20px; border-radius: 999px;
            border: 1px solid transparent; font-weight: 700; transition: transform .25s ease, background .25s ease;
        }
        .btn:hover { transform: translateY(-1px); }
        .btn-outline { border-color: var(--line); background: rgba(255,255,255,.7); }
        .btn-primary { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: #fff; }
        .auth-wrap { display: grid; grid-template-columns: 1fr 460px; gap: 28px; margin-top: 24px; align-items: stretch; }
        .hero, .form-card {
            background: var(--panel); border: 1px solid var(--line); border-radius: 28px; backdrop-filter: blur(12px); box-shadow: var(--shadow);
        }
        .hero { padding: 42px; position: relative; overflow: hidden; }
        .hero::after {
            content: ""; position: absolute; inset: auto -120px -140px auto; width: 280px; height: 280px; border-radius: 50%;
            background: radial-gradient(circle, rgba(216,180,141,.7), rgba(216,180,141,0));
        }
        .eyebrow {
            display: inline-flex; align-items: center; gap: 8px; padding: 8px 14px; border-radius: 999px;
            background: rgba(159,108,61,.12); color: var(--primary-dark); font-size: 14px; font-weight: 700;
        }
        h1 { margin: 18px 0 12px; font-size: clamp(34px, 4vw, 56px); line-height: 1.04; }
        .lead { max-width: 560px; color: var(--muted); line-height: 1.75; font-size: 16px; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 28px; }
        .info-box { padding: 18px; border-radius: 20px; background: rgba(255,255,255,.78); border: 1px solid var(--line); }
        .info-box strong { display: block; margin-bottom: 8px; }
        .form-card { padding: 32px; }
        .form-title { font-size: 28px; font-weight: 800; margin-bottom: 8px; }
        .muted { color: var(--muted); }
        .alert {
            border-radius: 18px; padding: 14px 16px; margin-bottom: 18px; font-size: 14px;
            border: 1px solid rgba(183,67,67,.15); background: rgba(183,67,67,.08); color: var(--danger);
        }
        .field { margin-bottom: 18px; }
        .field label { display: block; margin-bottom: 8px; font-size: 14px; font-weight: 700; }
        .input-wrap { position: relative; }
        .field input {
            width: 100%; border: 1px solid var(--line); border-radius: 16px; padding: 14px 16px;
            font: inherit; background: rgba(255,255,255,.86); color: var(--ink); outline: none;
        }
        .field input:focus { border-color: rgba(159,108,61,.45); box-shadow: 0 0 0 4px rgba(159,108,61,.10); }
        .password-toggle {
            position: absolute; top: 50%; right: 14px; transform: translateY(-50%); background: transparent; border: 0; cursor: pointer;
            color: var(--muted); font-size: 20px;
        }
        .row-line { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 18px; }
        .check { display: flex; align-items: center; gap: 10px; color: var(--muted); font-size: 14px; }
        .submit-btn { width: 100%; cursor: pointer; font-size: 15px; }
        .foot-link { text-align: center; margin-top: 18px; color: var(--muted); }
        .foot-link a { color: var(--primary-dark); font-weight: 700; }
        .error-text { margin-top: 6px; color: var(--danger); font-size: 13px; }
        @media (max-width: 980px) {
            .auth-wrap { grid-template-columns: 1fr; }
        }
        @media (max-width: 640px) {
            .shell { width: min(100% - 20px, 1180px); }
            .nav { flex-direction: column; gap: 14px; align-items: flex-start; }
            .hero, .form-card { padding: 22px; }
            .info-grid { grid-template-columns: 1fr; }
            .btn { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="shell">
        <div class="nav">
            <div class="brand">
                <div class="brand-mark">C</div>
                <div>
                    <div>Pengajuan Cuti</div>
                    <small style="color: var(--muted); font-weight: 600;">Sistem cuti karyawan yang lebih rapi dan cepat</small>
                </div>
            </div>
            <a href="{{ url('/') }}" class="btn btn-outline">Kembali ke Beranda</a>
        </div>

        <section class="auth-wrap">
            <div class="hero">
                <div class="eyebrow">Akses portal karyawan dan admin</div>
                <h1>Masuk ke sistem cuti dengan tampilan yang konsisten dan lebih nyaman.</h1>
                <p class="lead">
                    Setelah login, karyawan bisa langsung mengajukan cuti dari satu halaman, sementara admin dapat memproses persetujuan, master data, dan kuota tahunan dari dashboard.
                </p>

                <div class="info-grid">
                    <div class="info-box">
                        <strong>Pengajuan Lebih Cepat</strong>
                        <span class="muted">Ajukan cuti, unggah lampiran, dan cek riwayat tanpa berpindah-pindah halaman.</span>
                    </div>
                    <div class="info-box">
                        <strong>Kuota Terkontrol</strong>
                        <span class="muted">Sistem memeriksa batas maksimal cuti tahunan sesuai jenis cuti yang dipilih.</span>
                    </div>
                </div>
            </div>

            <div class="form-card">
                <div class="form-title">Masuk</div>
                <p class="muted">Gunakan email dan password akun Anda untuk melanjutkan.</p>

                @if (session('error'))
                    <div class="alert">{{ session('error') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="field">
                        <label for="email">Email</label>
                        <div class="input-wrap">
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda" required autofocus>
                        </div>
                        @error('email')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field">
                        <div class="row-line" style="margin-bottom:8px;">
                            <label for="password" style="margin:0;">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="muted" style="font-size:14px;">Lupa Password?</a>
                            @endif
                        </div>
                        <div class="input-wrap">
                            <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                            <button type="button" class="password-toggle" id="togglePassword">
                                <i class="bx bx-hide" id="toggleIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row-line">
                        <label class="check">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span>Ingat Saya</span>
                        </label>
                    </div>

                    <button class="btn btn-primary submit-btn" type="submit">Masuk ke Aplikasi</button>
                </form>

                <div class="foot-link">
                    Belum punya akun?
                    <a href="{{ route('register') }}">Daftar sekarang</a>
                </div>
            </div>
        </section>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const input = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bx-hide', 'bx-show');
            } else {
                input.type = 'password';
                icon.classList.replace('bx-show', 'bx-hide');
            }
        });
    </script>
</body>
</html>
