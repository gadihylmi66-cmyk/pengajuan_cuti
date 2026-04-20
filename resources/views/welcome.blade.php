<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengajuan Cuti Karyawan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f6f1e8;
            --panel: rgba(255, 255, 255, 0.88);
            --ink: #2d2218;
            --muted: #6a5a4a;
            --line: rgba(76, 57, 34, 0.12);
            --primary: #9f6c3d;
            --primary-dark: #72431f;
            --accent: #d8b48d;
            --success: #1f7a5a;
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

        .shell {
            width: min(1180px, calc(100% - 32px));
            margin: 24px auto 48px;
        }

        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 0;
        }

        .brand {
            display: flex;
            gap: 14px;
            align-items: center;
            font-weight: 800;
            letter-spacing: 0.02em;
        }

        .brand-mark {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            color: #fff;
            background: linear-gradient(145deg, var(--primary), var(--primary-dark));
            box-shadow: var(--shadow);
        }

        .nav-actions {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 13px 20px;
            border-radius: 999px;
            border: 1px solid transparent;
            font-weight: 700;
            transition: transform .25s ease, background .25s ease, color .25s ease;
        }

        .btn:hover { transform: translateY(-1px); }
        .btn-outline { border-color: var(--line); background: rgba(255,255,255,.7); }
        .btn-primary { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: #fff; }

        .hero {
            display: grid;
            grid-template-columns: 1.15fr .85fr;
            gap: 28px;
            align-items: stretch;
            margin-top: 24px;
        }

        .hero-main,
        .hero-side,
        .feature,
        .metric {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 28px;
            backdrop-filter: blur(12px);
            box-shadow: var(--shadow);
        }

        .hero-main {
            padding: 42px;
            position: relative;
            overflow: hidden;
        }

        .hero-main::after {
            content: "";
            position: absolute;
            inset: auto -120px -140px auto;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(216,180,141,.7), rgba(216,180,141,0));
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(159,108,61,.12);
            color: var(--primary-dark);
            font-size: 14px;
            font-weight: 700;
        }

        h1 {
            margin: 20px 0 14px;
            font-size: clamp(38px, 5vw, 66px);
            line-height: 1.02;
            max-width: 720px;
        }

        .lead {
            max-width: 620px;
            font-size: 17px;
            line-height: 1.75;
            color: var(--muted);
            margin-bottom: 28px;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-top: 26px;
        }

        .metric {
            padding: 18px;
        }

        .metric strong {
            display: block;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .metric span {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.5;
        }

        .hero-side {
            padding: 24px;
            display: grid;
            gap: 18px;
        }

        .calendar-card {
            padding: 24px;
            border-radius: 24px;
            background: linear-gradient(180deg, #fff, #f2e5d7);
            border: 1px solid var(--line);
        }

        .calendar-head,
        .mini-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 8px;
            margin-top: 18px;
        }

        .calendar-grid span {
            text-align: center;
            padding: 10px 0;
            border-radius: 12px;
            font-size: 13px;
            color: var(--muted);
            background: rgba(255,255,255,.8);
        }

        .calendar-grid .active {
            color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        }

        .mini-card {
            padding: 18px;
            border-radius: 20px;
            border: 1px solid var(--line);
            background: rgba(255,255,255,.78);
        }

        .section {
            margin-top: 28px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .feature {
            padding: 26px;
        }

        .feature h3 {
            margin: 16px 0 10px;
            font-size: 20px;
        }

        .feature p {
            margin: 0;
            color: var(--muted);
            line-height: 1.7;
            font-size: 15px;
        }

        .icon {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            display: grid;
            place-items: center;
            color: #fff;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        }

        .footer {
            margin-top: 28px;
            color: var(--muted);
            font-size: 14px;
            text-align: center;
        }

        @media (max-width: 980px) {
            .hero,
            .section {
                grid-template-columns: 1fr;
            }

            .hero-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .nav {
                flex-direction: column;
                gap: 16px;
                align-items: flex-start;
            }

            .nav-actions {
                width: 100%;
                flex-wrap: wrap;
            }

            .btn {
                width: 100%;
            }

            .hero-main,
            .hero-side,
            .feature {
                padding: 22px;
            }
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

            <div class="nav-actions">
                @auth
                    <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('cuti.index') }}" class="btn btn-primary">Masuk ke Aplikasi</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary">Daftar Akun</a>
                    @endif
                @endauth
            </div>
        </div>

        <section class="hero">
            <div class="hero-main">
                <div class="eyebrow">Workflow cuti lebih jelas dan terdokumentasi</div>
                <h1>Ajukan cuti, lampirkan dokumen, dan pantau persetujuan tanpa proses manual.</h1>
                <p class="lead">
                    Aplikasi ini membantu karyawan dan admin mengelola pengajuan cuti dalam satu alur yang tertib:
                    jenis cuti terstruktur, kuota tahunan terkontrol, serta riwayat persetujuan mudah ditelusuri.
                </p>

                <div class="nav-actions">
                    <a href="{{ route('login') }}" class="btn btn-primary">Mulai Sekarang</a>
                    <a href="#fitur" class="btn btn-outline">Lihat Fitur</a>
                </div>

                <div class="hero-grid">
                    <div class="metric">
                        <strong>1 halaman</strong>
                        <span>User bisa ajukan cuti dan lihat riwayat tanpa menu samping yang berlebihan.</span>
                    </div>
                    <div class="metric">
                        <strong>Lampiran</strong>
                        <span>Dukung file PDF atau gambar sebagai bukti kebutuhan cuti.</span>
                    </div>
                    <div class="metric">
                        <strong>Kuota tahunan</strong>
                        <span>Batas maksimal cuti dikendalikan dari master jenis cuti.</span>
                    </div>
                </div>
            </div>

            <div class="hero-side">
                <div class="calendar-card">
                    <div class="calendar-head">
                        <div>
                            <strong style="display:block; font-size: 20px;">Agenda Cuti</strong>
                            <small style="color: var(--muted);">Pantau tanggal penting dengan cepat</small>
                        </div>
                        <span style="padding: 8px 12px; border-radius: 999px; background: rgba(31,122,90,.12); color: var(--success); font-weight: 700;">Aktif</span>
                    </div>
                    <div class="calendar-grid">
                        <span>Sn</span><span>Sl</span><span>Rb</span><span>Km</span><span>Jm</span><span>Sb</span><span>Mg</span>
                        <span>10</span><span>11</span><span>12</span><span class="active">13</span><span class="active">14</span><span>15</span><span>16</span>
                    </div>
                </div>

                <div class="mini-card">
                    <div class="mini-row">
                        <strong>Alur Persetujuan</strong>
                        <span style="color: var(--primary-dark); font-weight: 700;">Realtime</span>
                    </div>
                    <p style="color: var(--muted); line-height: 1.7; margin: 12px 0 0;">
                        Admin dapat melihat permohonan, membaca lampiran, dan memberi keputusan langsung dari dashboard.
                    </p>
                </div>

                <div class="mini-card">
                    <div class="mini-row">
                        <strong>Data Karyawan</strong>
                        <span style="color: var(--primary-dark); font-weight: 700;">Terlengkapi</span>
                    </div>
                    <p style="color: var(--muted); line-height: 1.7; margin: 12px 0 0;">
                        Foto profil, jabatan, dan identitas dasar karyawan tersimpan rapi untuk mendukung proses administrasi.
                    </p>
                </div>
            </div>
        </section>

        <section class="section" id="fitur">
            <article class="feature">
                <div class="icon">01</div>
                <h3>Pengajuan lebih tertata</h3>
                <p>Karyawan cukup membuka satu halaman untuk mengajukan cuti baru, memeriksa sisa kuota per jenis cuti, dan meninjau riwayat pengajuan.</p>
            </article>
            <article class="feature">
                <div class="icon">02</div>
                <h3>Kontrol admin lebih praktis</h3>
                <p>Master jabatan, karyawan, dan jenis cuti dapat dikelola dari tabel yang sama dengan form modal tanpa berpindah halaman.</p>
            </article>
            <article class="feature">
                <div class="icon">03</div>
                <h3>Riwayat dan paging</h3>
                <p>Setiap tabel utama dilengkapi paging agar data tetap nyaman dibaca saat jumlah karyawan dan pengajuan terus bertambah.</p>
            </article>
        </section>

        <div class="footer">
            {{ date('Y') }} Pengajuan Cuti Karyawan. Dirancang untuk alur administrasi yang lebih rapi.
        </div>
    </div>
</body>
</html>
