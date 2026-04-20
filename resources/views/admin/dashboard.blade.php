<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  <title>Dashboard Admin</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" />
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
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>
            @endif

            <div class="card overflow-hidden mb-4" style="background:linear-gradient(135deg,#c19a6b 0%,#8b6340 100%);">
              <div class="row g-0 align-items-center">
                <div class="col-sm-7">
                  <div class="card-body py-4">
                    <h4 class="text-white mb-2">Selamat datang, {{ Auth::user()->name }}</h4>
                    <p class="text-white mb-0" style="opacity:.85;">Kelola karyawan, jenis cuti, dan approval pengajuan dari dashboard ini.</p>
                  </div>
                </div>
                <div class="col-sm-5 text-center d-none d-sm-block">
                  <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="150" alt="Admin">
                </div>
              </div>
            </div>

            <div class="row g-4 mb-4">
              <div class="col-xl-3 col-sm-6">
                <div class="card h-100"><div class="card-body"><h3 class="mb-1">{{ $karyawanCount }}</h3><p class="text-muted mb-1">Total Karyawan</p><a href="{{ route('admin.karyawan.index') }}">Kelola karyawan</a></div></div>
              </div>
              <div class="col-xl-3 col-sm-6">
                <div class="card h-100"><div class="card-body"><h3 class="mb-1">{{ $pendingCount }}</h3><p class="text-muted mb-1">Menunggu Persetujuan</p><a href="{{ route('admin.cuti.index') }}">Proses pengajuan</a></div></div>
              </div>
              <div class="col-xl-3 col-sm-6">
                <div class="card h-100"><div class="card-body"><h3 class="mb-1">{{ $approvedCount }}</h3><p class="text-muted mb-1">Cuti Disetujui</p><span class="text-success">Approval selesai</span></div></div>
              </div>
              <div class="col-xl-3 col-sm-6">
                <div class="card h-100"><div class="card-body"><h3 class="mb-1">{{ \App\Models\JenisCuti::count() }}</h3><p class="text-muted mb-1">Jenis Cuti</p><a href="{{ route('admin.jenis-cuti.index') }}">Atur kuota tahunan</a></div></div>
              </div>
            </div>

            <div class="card">
              <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                  <h5 class="mb-0">Pengajuan Cuti Menunggu Persetujuan</h5>
                  <small class="text-muted">Daftar terbaru dengan paging</small>
                </div>
                <a href="{{ route('admin.cuti.index') }}" class="btn btn-sm btn-primary">Kelola Semua</a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Karyawan</th>
                        <th>Jenis</th>
                        <th>Periode</th>
                        <th>Durasi</th>
                        <th>Alasan</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($recentCutis as $cuti)
                        <tr>
                          <td>{{ $cuti->karyawan?->user?->name ?? '-' }}</td>
                          <td>{{ $cuti->jenisCuti?->nama ?? '-' }}</td>
                          <td>{{ \Carbon\Carbon::parse($cuti->tanggal_masuk)->format('d M Y') }} - {{ \Carbon\Carbon::parse($cuti->tanggal_keluar)->format('d M Y') }}</td>
                          <td>{{ $cuti->jumlah_hari ?? '-' }} hari</td>
                          <td>{{ \Illuminate\Support\Str::limit($cuti->alasan_cuti, 40) }}</td>
                        </tr>
                      @empty
                        <tr>
                          <td colspan="5" class="text-center text-muted py-4">Tidak ada pengajuan cuti yang menunggu persetujuan.</td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
                <div class="mt-3">{{ $recentCutis->links() }}</div>
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
