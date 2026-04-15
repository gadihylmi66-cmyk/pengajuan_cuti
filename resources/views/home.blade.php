<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets/') }}"
  data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Dashboard - Pengajuan Cuti</title>
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

      @include('layouts.partials.sidebar')

      <div class="layout-page">
        @include('layouts.partials.navbar')

        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">

            {{-- Flash Messages --}}
            @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="bx bx-check-circle me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>
            @endif
            @if(session('error'))
              <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="bx bx-error-circle me-1"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>
            @endif

            {{-- Warning jika belum terdaftar sebagai karyawan --}}
            @if(!$karyawan)
              <div class="alert alert-warning mb-4">
                <i class="bx bx-info-circle me-1"></i>
                Data karyawan Anda belum terdaftar. Hubungi admin untuk mendaftarkan data Anda sebelum bisa mengajukan cuti.
              </div>
            @endif

            {{-- Welcome Banner --}}
            <div class="row mb-4">
              <div class="col-12">
                <div class="card overflow-hidden" style="background: linear-gradient(135deg, #696cff 0%, #9155fd 100%);">
                  <div class="row g-0 align-items-center">
                    <div class="col-sm-7">
                      <div class="card-body py-4">
                        <h4 class="card-title text-white mb-2">
                          Selamat datang, {{ Auth::user()->name }}! 👋
                        </h4>
                        <p class="text-white mb-1" style="opacity:.85;">
                          @if($karyawan)
                            Jabatan: <strong>{{ $karyawan->jabatan?->jabatan ?? '-' }}</strong>
                          @else
                            Anda belum terdaftar sebagai karyawan.
                          @endif
                        </p>
                        <p class="text-white mb-4" style="opacity:.75; font-size:.875rem;">
                          Pantau dan kelola pengajuan cuti Anda dari sini.
                        </p>
                      </div>
                    </div>
                    <div class="col-sm-5 text-center d-none d-sm-block">
                      <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}"
                        height="160" alt="Welcome" class="mt-2" />
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
                      <div class="avatar rounded p-2" style="background: rgba(105,108,255,.16);">
                        <i class="bx bx-calendar fs-4" style="color:#696cff;"></i>
                      </div>
                      <span class="badge rounded-pill" style="background:rgba(105,108,255,.16);color:#696cff;">Total</span>
                    </div>
                    <h3 class="mb-1">{{ $cutiCount }}</h3>
                    <p class="mb-0 text-muted">Total Pengajuan Cuti</p>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                      <div class="avatar rounded p-2" style="background: rgba(255,171,0,.16);">
                        <i class="bx bx-time fs-4 text-warning"></i>
                      </div>
                      <span class="badge bg-label-warning">Menunggu</span>
                    </div>
                    <h3 class="mb-1">{{ $pendingCount }}</h3>
                    <p class="mb-0 text-muted">Menunggu Persetujuan</p>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6">
                <div class="card h-100">
                  <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                      <div class="avatar rounded p-2" style="background: rgba(40,199,111,.16);">
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
                      <div class="avatar rounded p-2" style="background: rgba(255,62,29,.16);">
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

            {{-- Riwayat Cuti Terbaru + Info Profil --}}
            <div class="row g-4">

              {{-- Tabel Riwayat Cuti Terbaru --}}
              <div class="col-lg-8">
                <div class="card h-100">
                  <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Riwayat Cuti Terbaru</h5>
                    <a href="{{ route('cuti.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-hover mb-0">
                        <thead class="table-light">
                          <tr>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Alasan</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($recentCutis as $cuti)
                            <tr>
                              <td>{{ \Carbon\Carbon::parse($cuti->tanggal_masuk)->format('d M Y') }}</td>
                              <td>{{ \Carbon\Carbon::parse($cuti->tanggal_keluar)->format('d M Y') }}</td>
                              <td>{{ Str::limit($cuti->alasan_cuti, 35) }}</td>
                              <td>
                                @if($cuti->status === 'menunggu')
                                  <span class="badge bg-label-warning">Menunggu</span>
                                @elseif($cuti->status === 'disetujui')
                                  <span class="badge bg-label-success">Disetujui</span>
                                @else
                                  <span class="badge bg-label-danger">Ditolak</span>
                                @endif
                              </td>
                            </tr>
                          @empty
                            <tr>
                              <td colspan="4" class="text-center text-muted py-4">
                                <i class="bx bx-calendar-x fs-3 d-block mb-2"></i>
                                Belum ada pengajuan cuti.
                                @if($karyawan)
                                  <a href="{{ route('cuti.create') }}">Ajukan sekarang</a>
                                @endif
                              </td>
                            </tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              {{-- Info Profil Karyawan --}}
              <div class="col-lg-4">
                <div class="card h-100">
                  <div class="card-header">
                    <h5 class="mb-0">Profil Saya</h5>
                  </div>
                  <div class="card-body">
                    {{-- Avatar inisial --}}
                    <div class="d-flex align-items-center mb-4">
                      <div class="avatar me-3 d-flex align-items-center justify-content-center rounded-circle fw-bold text-white fs-4"
                        style="width:56px;height:56px;background:linear-gradient(135deg,#696cff,#9155fd);flex-shrink:0;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                      </div>
                      <div>
                        <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                        <small class="text-muted">{{ Auth::user()->email }}</small>
                      </div>
                    </div>

                    @if($karyawan)
                      <ul class="list-unstyled mb-4">
                        <li class="d-flex justify-content-between py-2 border-bottom">
                          <span class="text-muted">Jabatan</span>
                          <span class="fw-medium">{{ $karyawan->jabatan?->jabatan ?? '-' }}</span>
                        </li>
                        <li class="d-flex justify-content-between py-2 border-bottom">
                          <span class="text-muted">Jenis Kelamin</span>
                          <span class="fw-medium">{{ $karyawan->jenis_kelamin }}</span>
                        </li>
                        <li class="d-flex justify-content-between py-2 border-bottom">
                          <span class="text-muted">No. Telp</span>
                          <span class="fw-medium">{{ $karyawan->no_telp }}</span>
                        </li>
                        <li class="d-flex justify-content-between py-2 border-bottom">
                          <span class="text-muted">Agama</span>
                          <span class="fw-medium">{{ $karyawan->agama }}</span>
                        </li>
                        <li class="d-flex justify-content-between py-2">
                          <span class="text-muted">Tempat Lahir</span>
                          <span class="fw-medium">{{ $karyawan->tempat_lahir }}</span>
                        </li>
                      </ul>
                    @else
                      <div class="text-center text-muted py-3">
                        <i class="bx bx-user-x fs-2 d-block mb-2"></i>
                        Data karyawan belum tersedia.
                      </div>
                    @endif

                    <a href="{{ route('cuti.create') }}" class="btn btn-primary w-100 {{ !$karyawan ? 'disabled' : '' }}">
                      <i class="bx bx-plus me-1"></i> Ajukan Cuti Baru
                    </a>
                  </div>
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
