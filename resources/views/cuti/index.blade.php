<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Portal Cuti Karyawan</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(105, 108, 255, 0.10), transparent 20%),
                radial-gradient(circle at top right, rgba(255, 171, 0, 0.12), transparent 18%),
                #f6f7fb;
        }
        .page-shell { width: min(1240px, calc(100% - 24px)); margin: 18px auto 28px; }
        .glass-card {
            border: 1px solid rgba(67, 89, 113, 0.10);
            box-shadow: 0 24px 60px rgba(67, 89, 113, 0.08);
        }
        .profile-photo {
            width: 68px;
            height: 68px;
            border-radius: 20px;
            object-fit: cover;
        }
        .profile-fallback {
            width: 68px;
            height: 68px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 800;
            color: #fff;
            background: linear-gradient(135deg, #696cff, #8f8dff);
        }
        .quota-item {
            padding: 14px 16px;
            border: 1px solid rgba(67, 89, 113, 0.10);
            border-radius: 18px;
            background: #fff;
        }
        .hero-card {
            background: linear-gradient(135deg, #1f2b5c 0%, #3949ab 55%, #6073ff 100%);
            color: #fff;
            overflow: hidden;
        }
        .hero-card::after {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            right: -70px;
            top: -70px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.10);
        }
        .section-title { font-size: 1.05rem; font-weight: 700; }
        .table td, .table th { vertical-align: middle; }
    </style>
</head>
<body>
    <div class="page-shell">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
            <div class="d-flex align-items-center gap-3">
                @if($karyawan?->foto_profil)
                    <img src="{{ asset('storage/' . $karyawan->foto_profil) }}" alt="Foto Profil" class="profile-photo">
                @else
                    <div class="profile-fallback">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                @endif
                <div>
                    <div class="text-muted small">Portal Cuti Karyawan</div>
                    <h3 class="mb-1">{{ auth()->user()->name }}</h3>
                    <div class="text-muted">{{ $karyawan?->jabatan?->jabatan ?? 'Data jabatan belum tersedia' }}</div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2">
                @if($karyawan)
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCutiModal">
                        <i class="bx bx-plus me-1"></i> Ajukan Cuti
                    </button>
                @endif
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary">
                        <i class="bx bx-log-out me-1"></i> Keluar
                    </button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show glass-card" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show glass-card" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('warning'))
            <div class="alert alert-warning alert-dismissible fade show glass-card" role="alert">
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger glass-card">
                <strong>Periksa kembali form pengajuan.</strong>
                <ul class="mb-0 mt-2 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card hero-card glass-card position-relative mb-4">
            <div class="card-body p-4 p-lg-5 position-relative">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-8">
                        <div class="badge bg-white text-primary mb-3">Satu halaman untuk pengajuan dan riwayat</div>
                        <h2 class="text-white mb-3">Ajukan cuti, unggah lampiran, dan pantau status persetujuan di tempat yang sama.</h2>
                        <p class="mb-0 text-white" style="opacity:.85;">
                            Sistem akan menghitung durasi cuti secara otomatis dan memeriksa batas tahunan sesuai jenis cuti yang dipilih.
                        </p>
                    </div>
                    <div class="col-lg-4">
                        <div class="row g-3">
                            <div class="col-4">
                                <div class="bg-white rounded-4 p-3 text-center">
                                    <div class="fw-bold fs-4 text-warning">{{ $pendingCount }}</div>
                                    <small class="text-muted">Menunggu</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="bg-white rounded-4 p-3 text-center">
                                    <div class="fw-bold fs-4 text-success">{{ $approvedCount }}</div>
                                    <small class="text-muted">Disetujui</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="bg-white rounded-4 p-3 text-center">
                                    <div class="fw-bold fs-4 text-danger">{{ $rejectedCount }}</div>
                                    <small class="text-muted">Ditolak</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-xl-4">
                <div class="card glass-card h-100">
                    <div class="card-body">
                        <div class="section-title mb-3">Profil Karyawan</div>
                        @if($karyawan)
                            <div class="d-flex align-items-center gap-3 mb-4">
                                @if($karyawan->foto_profil)
                                    <img src="{{ asset('storage/' . $karyawan->foto_profil) }}" alt="Foto Profil" class="profile-photo">
                                @else
                                    <div class="profile-fallback">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                                @endif
                                <div>
                                    <div class="fw-bold">{{ auth()->user()->name }}</div>
                                    <div class="text-muted small">{{ auth()->user()->email }}</div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between py-2 border-bottom">
                                <span class="text-muted">Jabatan</span>
                                <strong>{{ $karyawan->jabatan?->jabatan ?? '-' }}</strong>
                            </div>
                            <div class="d-flex justify-content-between py-2 border-bottom">
                                <span class="text-muted">No. Telp</span>
                                <strong>{{ $karyawan->no_telp }}</strong>
                            </div>
                            <div class="d-flex justify-content-between py-2 border-bottom">
                                <span class="text-muted">Agama</span>
                                <strong>{{ $karyawan->agama }}</strong>
                            </div>
                            <div class="d-flex justify-content-between py-2 border-bottom">
                                <span class="text-muted">Tempat Lahir</span>
                                <strong>{{ $karyawan->tempat_lahir }}</strong>
                            </div>
                            <div class="d-flex justify-content-between py-2">
                                <span class="text-muted">Tanggal Lahir</span>
                                <strong>{{ \Carbon\Carbon::parse($karyawan->tanggal_lahir)->format('d M Y') }}</strong>
                            </div>
                        @else
                            <div class="text-muted">Profil karyawan belum terhubung. Hubungi admin agar data Anda dilengkapi sebelum mengajukan cuti.</div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card glass-card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="section-title">Kuota Cuti Tahun {{ now()->year }}</div>
                            <small class="text-muted">Berdasarkan master jenis cuti</small>
                        </div>
                        <div class="row g-3">
                            @forelse($jenisCutis as $jenisCuti)
                                @php
                                    $used = (int) ($usedQuota[$jenisCuti->id] ?? 0);
                                    $max = (int) $jenisCuti->maksimal_hari_per_tahun;
                                @endphp
                                <div class="col-md-6">
                                    <div class="quota-item">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <div class="fw-bold">{{ $jenisCuti->nama }}</div>
                                                <small class="text-muted">{{ $jenisCuti->deskripsi ?: 'Tanpa deskripsi tambahan.' }}</small>
                                            </div>
                                            <span class="badge bg-label-primary">{{ $used }}/{{ $max }} hari</span>
                                        </div>
                                        <div class="progress mt-3" style="height: 8px;">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $max > 0 ? min(($used / $max) * 100, 100) : 0 }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-muted">Belum ada jenis cuti aktif. Admin perlu menambahkan master jenis cuti terlebih dahulu.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="card glass-card">
                    <div class="card-header d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2">
                        <div>
                            <div class="section-title">Riwayat Pengajuan Cuti</div>
                            <small class="text-muted">Setiap pengajuan, lampiran, dan catatan admin terlihat dari sini.</small>
                        </div>
                        @if($karyawan)
                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createCutiModal">
                                <i class="bx bx-plus me-1"></i> Tambah Pengajuan
                            </button>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Cuti</th>
                                        <th>Periode</th>
                                        <th>Durasi</th>
                                        <th>Status</th>
                                        <th>Lampiran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($cutis as $cuti)
                                        <tr>
                                            <td>{{ $cutis instanceof \Illuminate\Pagination\LengthAwarePaginator ? $cutis->firstItem() + $loop->index : $loop->iteration }}</td>
                                            <td>
                                                <div class="fw-semibold">{{ $cuti->jenisCuti?->nama ?? '-' }}</div>
                                                <small class="text-muted">{{ \Illuminate\Support\Str::limit($cuti->alasan_cuti, 40) }}</small>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($cuti->tanggal_masuk)->format('d M Y') }} - {{ \Carbon\Carbon::parse($cuti->tanggal_keluar)->format('d M Y') }}</td>
                                            <td>{{ $cuti->jumlah_hari }} hari</td>
                                            <td>
                                                @if($cuti->status === 'menunggu')
                                                    <span class="badge bg-warning">Menunggu</span>
                                                @elseif($cuti->status === 'disetujui')
                                                    <span class="badge bg-success">Disetujui</span>
                                                @else
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($cuti->lampiran)
                                                    <a href="{{ asset('storage/' . $cuti->lampiran) }}" target="_blank" class="btn btn-sm btn-outline-secondary">Lihat File</a>
                                                @else
                                                    <span class="text-muted">Tidak ada</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailCutiModal{{ $cuti->id }}">
                                                    Detail
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">Belum ada pengajuan cuti.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if($cutis instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            <div class="mt-3">{{ $cutis->links() }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($karyawan)
        <div class="modal fade" id="createCutiModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('cuti.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Ajukan Cuti Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Jenis Cuti</label>
                                    <select name="jenis_cuti_id" class="form-select" required>
                                        <option value="">Pilih jenis cuti</option>
                                        @foreach($jenisCutis as $jenisCuti)
                                            <option value="{{ $jenisCuti->id }}" @selected(old('jenis_cuti_id') == $jenisCuti->id)>
                                                {{ $jenisCuti->nama }} (maks. {{ $jenisCuti->maksimal_hari_per_tahun }} hari/tahun)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Lampiran</label>
                                    <input type="file" name="lampiran" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                                    <small class="text-muted">Format PDF/JPG/PNG maksimal 2 MB.</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Mulai</label>
                                    <input type="date" name="tanggal_masuk" class="form-control" value="{{ old('tanggal_masuk') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Selesai</label>
                                    <input type="date" name="tanggal_keluar" class="form-control" value="{{ old('tanggal_keluar') }}" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Alasan Cuti</label>
                                    <textarea name="alasan_cuti" rows="4" class="form-control" required>{{ old('alasan_cuti') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    @foreach($cutis as $cuti)
        <div class="modal fade" id="detailCutiModal{{ $cuti->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Pengajuan Cuti</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="text-muted small">Jenis Cuti</div>
                                <div class="fw-semibold">{{ $cuti->jenisCuti?->nama ?? '-' }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-muted small">Status</div>
                                <div>
                                    @if($cuti->status === 'menunggu')
                                        <span class="badge bg-warning">Menunggu</span>
                                    @elseif($cuti->status === 'disetujui')
                                        <span class="badge bg-success">Disetujui</span>
                                    @else
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-muted small">Tanggal Mulai</div>
                                <div class="fw-semibold">{{ \Carbon\Carbon::parse($cuti->tanggal_masuk)->format('d M Y') }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-muted small">Tanggal Selesai</div>
                                <div class="fw-semibold">{{ \Carbon\Carbon::parse($cuti->tanggal_keluar)->format('d M Y') }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-muted small">Durasi</div>
                                <div class="fw-semibold">{{ $cuti->jumlah_hari }} hari</div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-muted small">Lampiran</div>
                                <div>
                                    @if($cuti->lampiran)
                                        <a href="{{ asset('storage/' . $cuti->lampiran) }}" target="_blank">Buka lampiran</a>
                                    @else
                                        <span class="text-muted">Tidak ada lampiran</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="text-muted small">Alasan Cuti</div>
                                <div class="fw-semibold">{{ $cuti->alasan_cuti }}</div>
                            </div>
                            <div class="col-12">
                                <div class="text-muted small">Catatan Admin</div>
                                <div class="fw-semibold">{{ $cuti->catatan_admin ?: 'Belum ada catatan admin.' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script>
        @if($errors->any())
            const createCutiModalElement = document.getElementById('createCutiModal');
            if (createCutiModalElement) {
                const createCutiModal = new bootstrap.Modal(createCutiModalElement);
                createCutiModal.show();
            }
        @endif
    </script>
</body>
</html>
