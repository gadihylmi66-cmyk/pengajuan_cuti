<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Daftar Pengajuan Cuti</title>
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

              @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
              @endif

              @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{ session('error') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
              @endif

              @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  {{ session('warning') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
              @endif

              <div class="row mb-4">
                <div class="col-12">
                  <div class="card bg-primary text-white">
                    <div class="card-body d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
                      <div>
                        <h4 class="card-title text-white mb-1">Daftar Pengajuan Cuti</h4>
                        <p class="card-text text-white-75 mb-0">Pantau semua pengajuan cuti Anda dan lihat status konfirmasi admin.</p>
                      </div>
                      <a href="{{ route('cuti.create') }}" class="btn btn-outline-light">Ajukan Cuti Baru</a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row g-4">
                <div class="col-xl-8 col-lg-12">
                  <div class="card">
                    <div class="card-header">
                      <h5 class="mb-0">Riwayat Pengajuan</h5>
                      <small class="text-muted">Daftar cuti yang pernah diajukan.</small>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th>No</th>
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
                                  <a href="{{ route('cuti.show', $cuti) }}" class="btn btn-sm btn-outline-info">
                                    <i class="bx bx-show me-1"></i> Detail
                                  </a>
                                </td>
                              </tr>
                            @empty
                              <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                  Belum ada pengajuan cuti. Klik "Ajukan Cuti Baru" untuk membuat permintaan pertama.
                                </td>
                              </tr>
                            @endforelse
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-xl-4 col-lg-12">
                  <div class="row g-4">
                    <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex align-items-start justify-content-between">
                            <div>
                              <h6 class="mb-2">Ringkasan Status</h6>
                              <p class="mb-0 text-muted">Sekilas tentang pengajuan cuti Anda.</p>
                            </div>
                            <i class="bx bx-list-check fs-2 text-primary"></i>
                          </div>
                          <div class="mt-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                              <span>Menunggu</span>
                              <strong class="text-warning">{{ $pendingCount }}</strong>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                              <span>Disetujui</span>
                              <strong class="text-success">{{ $approvedCount }}</strong>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                              <span>Ditolak</span>
                              <strong class="text-danger">{{ $rejectedCount }}</strong>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="card bg-light">
                        <div class="card-body">
                          <h6 class="mb-3">Petunjuk Singkat</h6>
                          <ul class="ps-3 mb-0">
                            <li>Periksa tanggal cuti agar tidak bentrok dengan jadwal kerja.</li>
                            <li>Gunakan alasan cuti yang singkat dan jelas.</li>
                            <li>Admin akan memproses permintaan Anda secepatnya.</li>
                            <li>Cuti yang sudah diproses tidak dapat diedit atau dihapus.</li>
                          </ul>
                        </div>
                      </div>
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
