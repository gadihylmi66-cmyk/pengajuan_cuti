<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets/') }}"
  data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Dashboard Admin - Pengajuan Cuti</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
  <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
  <script src="{{ asset('assets/js/config.js') }}"></script>
</head>
<body>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      @include('admin.partials.sidebar')
      <div class="layout-page">
        @include('admin.partials.navbar')
        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">

            @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show mb-4">
                <i class="bx bx-check-circle me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>
            @endif

            {{-- Welcome Banner --}}
            <div class="row mb-4">
              <div class="col-12">
                <div class="card overflow-hidden" style="background:linear-gradient(135deg,#c19a6b 0%,#8b6340 100%);">
                  <div class="row g-0 align-items-center">
                    <div class="col-sm-7">
                      <div class="card-body py-4">
                        <h4 class="text-white mb-2">Selamat datang, {{ Auth::user()->name }}! 👑</h4>
                        <p class="text-white mb-4" style="opacity:.85;">
                          Kelola pengajuan cuti karyawan, data jabatan, dan karyawan dari sini.
                        </p>
                      </div>
                    </div>
                    <div class="col-sm-5 text-center d-none d-sm-block">
                      <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}"
                        height="160" alt="Admin" class="mt-2" />
                    </div>
                  </div>
                </div>
              </div>
            </div>

            {{-- Stat Cards --}}
            <div class="row g-4 mb-4">
              <div class="col-xl-3 col-sm-6">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                      <div class="avatar rounded p-2" style="background:rgba(105,108,255,.16);">
                        <i class="bx bx-group fs-4" style="color:#696cff;"></i>
                      </div>
                      <span class="badge rounded-pill" style="background:rgba(105,108,255,.16);color:#696cff;">Karyawan</span>
                    </div>
                    <h3 class="mb-1">{{ $karyawanCount }}</h3>
                    <p class="mb-0 text-muted">Total Karyawan</p>
                    <a href="{{ route('admin.karyawan.index') }}" class="small text-primary">Lihat semua →</a>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                      <div class="avatar rounded p-2" style="background:rgba(255,171,0,.16);">
                        <i class="bx bx-time fs-4 text-warning"></i>
                      </div>
                      <span class="badge bg-label-warning">Pending</span>
                    </div>
                    <h3 class="mb-1">{{ $pendingCount }}</h3>
                    <p class="mb-0 text-muted">Menunggu Persetujuan</p>
                    <a href="{{ route('admin.cuti.index') }}" class="small text-warning">Proses sekarang →</a>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                      <div class="avatar rounded p-2" style="background:rgba(40,199,111,.16);">
                        <i class="bx bx-check-circle fs-4 text-success"></i>
                      </div>
                      <span class="badge bg-label-success">Disetujui</span>
                    </div>
                    <h3 class="mb-1">{{ $approvedCount }}</h3>
                    <p class="mb-0 text-muted">Cuti Disetujui</p>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                      <div class="avatar rounded p-2" style="background:rgba(255,62,29,.16);">
                        <i class="bx bx-x-circle fs-4 text-danger"></i>
                      </div>
                      <span class="badge bg-label-danger">Ditolak</span>
                    </div>
                    <h3 class="mb-1">{{ $rejectedCount }}</h3>
                    <p class="mb-0 text-muted">Cuti Ditolak</p>
                  </div>
                </div>
              </div>
            </div>

            {{-- Tabel Cuti Pending --}}
            <div class="card">
              <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                  <h5 class="mb-0">Pengajuan Cuti Menunggu Persetujuan</h5>
                  <small class="text-muted">Perlu tindakan segera</small>
                </div>
                <a href="{{ route('admin.cuti.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-hover mb-0">
                    <thead class="table-light">
                      <tr>
                        <th>Karyawan</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Alasan</th>
                        <th>Diajukan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($recentCutis as $cuti)
                        <tr>
                          <td>
                            <div class="d-flex align-items-center">
                              <div class="d-flex align-items-center justify-content-center rounded-circle text-white fw-bold me-2"
                                style="width:32px;height:32px;background:#696cff;font-size:.8rem;flex-shrink:0;">
                                {{ strtoupper(substr($cuti->karyawan?->user?->name ?? 'U', 0, 1)) }}
                              </div>
                              <div>
                                <span class="fw-medium">{{ $cuti->karyawan?->user?->name ?? '-' }}</span><br>
                                <small class="text-muted">{{ $cuti->karyawan?->jabatan?->jabatan ?? '-' }}</small>
                              </div>
                            </div>
                          </td>
                          <td>{{ \Carbon\Carbon::parse($cuti->tanggal_masuk)->format('d M Y') }}</td>
                          <td>{{ \Carbon\Carbon::parse($cuti->tanggal_keluar)->format('d M Y') }}</td>
                          <td>{{ Str::limit($cuti->alasan_cuti, 35) }}</td>
                          <td>
                            {{ $cuti->created_at->format('d M Y') }}<br>
                            <small class="text-muted">{{ $cuti->created_at->diffForHumans() }}</small>
                          </td>
                          <td>
                            <a href="{{ route('admin.cuti.show', $cuti) }}" class="btn btn-sm btn-outline-info me-1">Detail</a>
                            <form action="{{ route('admin.cuti.approve', $cuti) }}" method="POST" class="d-inline-block">
                              @csrf @method('PATCH')
                              <button type="submit" class="btn btn-sm btn-success me-1"
                                onclick="return confirm('Setujui cuti ini?')">✓</button>
                            </form>
                            <form action="{{ route('admin.cuti.reject', $cuti) }}" method="POST" class="d-inline-block">
                              @csrf @method('PATCH')
                              <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Tolak cuti ini?')">✗</button>
                            </form>
                          </td>
                        </tr>
                      @empty
                        <tr>
                          <td colspan="6" class="text-center text-muted py-4">
                            <i class="bx bx-check-circle fs-3 text-success d-block mb-2"></i>
                            Tidak ada pengajuan cuti yang menunggu persetujuan.
                          </td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
          @include('layouts.partials.footer')
          <div class="content-backdrop fade"></div>
        </div>
      </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>

  <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
