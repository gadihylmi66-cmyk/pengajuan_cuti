<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Kelola Pengajuan Cuti - Admin</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
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
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>
            @endif

            <div class="row mb-4">
              <div class="col-12">
                <div class="card bg-primary text-white">
                  <div class="card-body d-flex align-items-center justify-content-between gap-3">
                    <div>
                      <h4 class="card-title text-white mb-1">Kelola Pengajuan Cuti</h4>
                      <p class="card-text text-white-75 mb-0">Setujui atau tolak pengajuan cuti karyawan.</p>
                    </div>
                    <i class="bx bx-calendar-check fs-1 text-white-50"></i>
                  </div>
                </div>
              </div>
            </div>

            {{-- Statistik --}}
            <div class="row g-3 mb-4">
              <div class="col-md-4">
                <div class="card text-center border-warning">
                  <div class="card-body">
                    <i class="bx bx-time fs-2 text-warning mb-2"></i>
                    <h3 class="text-warning">{{ $pendingCount }}</h3>
                    <p class="mb-0 text-muted">Menunggu</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card text-center border-success">
                  <div class="card-body">
                    <i class="bx bx-check-circle fs-2 text-success mb-2"></i>
                    <h3 class="text-success">{{ $approvedCount }}</h3>
                    <p class="mb-0 text-muted">Disetujui</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card text-center border-danger">
                  <div class="card-body">
                    <i class="bx bx-x-circle fs-2 text-danger mb-2"></i>
                    <h3 class="text-danger">{{ $rejectedCount }}</h3>
                    <p class="mb-0 text-muted">Ditolak</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h5 class="mb-0">Daftar Pengajuan Cuti</h5>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Alasan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($cutis as $cuti)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $cuti->karyawan?->user?->name ?? '-' }}</td>
                          <td>{{ \Carbon\Carbon::parse($cuti->tanggal_masuk)->format('d M Y') }}</td>
                          <td>{{ \Carbon\Carbon::parse($cuti->tanggal_keluar)->format('d M Y') }}</td>
                          <td>{{ Str::limit($cuti->alasan_cuti, 40) }}</td>
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
                            <a href="{{ route('admin.cuti.show', $cuti) }}" class="btn btn-sm btn-outline-info me-1">Detail</a>
                            @if($cuti->status === 'menunggu')
                              <form action="{{ route('admin.cuti.approve', $cuti) }}" method="POST" class="d-inline-block">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-success me-1"
                                  onclick="return confirm('Setujui pengajuan cuti ini?')">Setujui</button>
                              </form>
                              <form action="{{ route('admin.cuti.reject', $cuti) }}" method="POST" class="d-inline-block">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-danger"
                                  onclick="return confirm('Tolak pengajuan cuti ini?')">Tolak</button>
                              </form>
                            @endif
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
