<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets/') }}"
  data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Detail Pengajuan Cuti</title>
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
  <style>
    .timeline { position: relative; padding-left: 2rem; }
    .timeline::before { content:''; position:absolute; left:.75rem; top:0; bottom:0; width:2px; background:#e0e0e0; }
    .timeline-item { position:relative; margin-bottom:1.5rem; }
    .timeline-item:last-child { margin-bottom:0; }
    .timeline-dot {
      position:absolute; left:-1.75rem; top:.2rem;
      width:1rem; height:1rem; border-radius:50%;
      border:2px solid #fff; box-shadow:0 0 0 2px #e0e0e0;
    }
    .timeline-dot.done { background:#28c76f; box-shadow:0 0 0 2px #28c76f; }
    .timeline-dot.active { background:#ff9f43; box-shadow:0 0 0 2px #ff9f43; }
    .timeline-dot.rejected { background:#ea5455; box-shadow:0 0 0 2px #ea5455; }
    .timeline-dot.pending { background:#e0e0e0; }
  </style>
</head>
<body>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      @include('layouts.partials.sidebar')
      <div class="layout-page">
        @include('layouts.partials.navbar')
        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">

            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="mb-4">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cuti.index') }}">Pengajuan Cuti</a></li>
                <li class="breadcrumb-item active">Detail</li>
              </ol>
            </nav>

            <div class="row g-4">

              {{-- Detail Cuti --}}
              <div class="col-lg-8">
                <div class="card">
                  <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Detail Pengajuan Cuti</h5>
                    <a href="{{ route('cuti.index') }}" class="btn btn-sm btn-outline-secondary">Kembali</a>
                  </div>
                  <div class="card-body">

                    {{-- Status Banner --}}
                    @if($cuti->status === 'menunggu')
                      <div class="alert alert-warning d-flex align-items-center mb-4">
                        <i class="bx bx-time fs-4 me-2"></i>
                        <div>
                          <strong>Menunggu Persetujuan</strong><br>
                          <small>Pengajuan Anda sedang ditinjau oleh admin.</small>
                        </div>
                      </div>
                    @elseif($cuti->status === 'disetujui')
                      <div class="alert alert-success d-flex align-items-center mb-4">
                        <i class="bx bx-check-circle fs-4 me-2"></i>
                        <div>
                          <strong>Pengajuan Disetujui</strong><br>
                          <small>Selamat! Cuti Anda telah disetujui oleh admin.</small>
                        </div>
                      </div>
                    @else
                      <div class="alert alert-danger d-flex align-items-center mb-4">
                        <i class="bx bx-x-circle fs-4 me-2"></i>
                        <div>
                          <strong>Pengajuan Ditolak</strong><br>
                          <small>Maaf, pengajuan cuti Anda tidak disetujui.</small>
                        </div>
                      </div>
                    @endif

                    <table class="table table-borderless">
                      <tr>
                        <th width="180" class="text-muted">Nama Karyawan</th>
                        <td class="fw-medium">{{ auth()->user()->name }}</td>
                      </tr>
                      <tr>
                        <th class="text-muted">Tanggal Mulai</th>
                        <td class="fw-medium">{{ \Carbon\Carbon::parse($cuti->tanggal_masuk)->translatedFormat('d F Y') }}</td>
                      </tr>
                      <tr>
                        <th class="text-muted">Tanggal Selesai</th>
                        <td class="fw-medium">{{ \Carbon\Carbon::parse($cuti->tanggal_keluar)->translatedFormat('d F Y') }}</td>
                      </tr>
                      <tr>
                        <th class="text-muted">Durasi</th>
                        <td class="fw-medium">
                          {{ \Carbon\Carbon::parse($cuti->tanggal_masuk)->diffInDays(\Carbon\Carbon::parse($cuti->tanggal_keluar)) + 1 }} hari
                        </td>
                      </tr>
                      <tr>
                        <th class="text-muted">Alasan Cuti</th>
                        <td>{{ $cuti->alasan_cuti }}</td>
                      </tr>
                      <tr>
                        <th class="text-muted">Status</th>
                        <td>
                          @if($cuti->status === 'menunggu')
                            <span class="badge bg-label-warning fs-6 px-3 py-2">⏳ Menunggu</span>
                          @elseif($cuti->status === 'disetujui')
                            <span class="badge bg-label-success fs-6 px-3 py-2">✓ Disetujui</span>
                          @else
                            <span class="badge bg-label-danger fs-6 px-3 py-2">✗ Ditolak</span>
                          @endif
                        </td>
                      </tr>
                      @if($cuti->catatan_admin)
                        <tr>
                          <th class="text-muted">Catatan Admin</th>
                          <td>
                            <div class="p-3 rounded" style="background:#f8f9fa;border-left:3px solid #696cff;">
                              {{ $cuti->catatan_admin }}
                            </div>
                          </td>
                        </tr>
                      @endif
                      <tr>
                        <th class="text-muted">Diajukan Pada</th>
                        <td class="text-muted">{{ $cuti->created_at->format('d M Y, H:i') }}</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>

              {{-- Timeline Alur --}}
              <div class="col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <h6 class="mb-0">Alur Pengajuan</h6>
                  </div>
                  <div class="card-body">
                    <div class="timeline">

                      {{-- Step 1: Diajukan --}}
                      <div class="timeline-item">
                        <div class="timeline-dot done"></div>
                        <div>
                          <p class="mb-0 fw-medium text-success">✓ Pengajuan Dikirim</p>
                          <small class="text-muted">{{ $cuti->created_at->format('d M Y, H:i') }}</small>
                          <p class="mb-0 small text-muted mt-1">Pengajuan cuti berhasil dikirim ke admin.</p>
                        </div>
                      </div>

                      {{-- Step 2: Review Admin --}}
                      <div class="timeline-item">
                        @if($cuti->status === 'menunggu')
                          <div class="timeline-dot active"></div>
                          <div>
                            <p class="mb-0 fw-medium text-warning">⏳ Sedang Ditinjau</p>
                            <small class="text-muted">Menunggu keputusan admin</small>
                            <p class="mb-0 small text-muted mt-1">Admin sedang memproses pengajuan Anda.</p>
                          </div>
                        @else
                          <div class="timeline-dot done"></div>
                          <div>
                            <p class="mb-0 fw-medium text-success">✓ Sudah Ditinjau</p>
                            <small class="text-muted">{{ $cuti->updated_at->format('d M Y, H:i') }}</small>
                          </div>
                        @endif
                      </div>

                      {{-- Step 3: Keputusan --}}
                      <div class="timeline-item">
                        @if($cuti->status === 'menunggu')
                          <div class="timeline-dot pending"></div>
                          <div>
                            <p class="mb-0 fw-medium text-muted">Keputusan Admin</p>
                            <small class="text-muted">Belum ada keputusan</small>
                          </div>
                        @elseif($cuti->status === 'disetujui')
                          <div class="timeline-dot done"></div>
                          <div>
                            <p class="mb-0 fw-medium text-success">✓ Disetujui</p>
                            <small class="text-muted">{{ $cuti->updated_at->format('d M Y, H:i') }}</small>
                            @if($cuti->catatan_admin)
                              <p class="mb-0 small text-muted mt-1">"{{ $cuti->catatan_admin }}"</p>
                            @endif
                          </div>
                        @else
                          <div class="timeline-dot rejected"></div>
                          <div>
                            <p class="mb-0 fw-medium text-danger">✗ Ditolak</p>
                            <small class="text-muted">{{ $cuti->updated_at->format('d M Y, H:i') }}</small>
                            @if($cuti->catatan_admin)
                              <p class="mb-0 small text-muted mt-1">"{{ $cuti->catatan_admin }}"</p>
                            @endif
                          </div>
                        @endif
                      </div>

                      {{-- Step 4: Selesai --}}
                      <div class="timeline-item">
                        @if($cuti->status === 'disetujui')
                          <div class="timeline-dot done"></div>
                          <div>
                            <p class="mb-0 fw-medium text-success">✓ Selesai</p>
                            <small class="text-muted">Cuti Anda telah disetujui dan tercatat.</small>
                          </div>
                        @elseif($cuti->status === 'ditolak')
                          <div class="timeline-dot rejected"></div>
                          <div>
                            <p class="mb-0 fw-medium text-danger">Pengajuan Ditutup</p>
                            <small class="text-muted">Anda dapat mengajukan cuti baru.</small>
                          </div>
                        @else
                          <div class="timeline-dot pending"></div>
                          <div>
                            <p class="mb-0 fw-medium text-muted">Selesai</p>
                            <small class="text-muted">Menunggu keputusan admin.</small>
                          </div>
                        @endif
                      </div>

                    </div>

                    @if($cuti->status === 'ditolak')
                      <div class="mt-4">
                        <a href="{{ route('cuti.create') }}" class="btn btn-primary w-100 btn-sm">
                          <i class="bx bx-plus me-1"></i> Ajukan Cuti Baru
                        </a>
                      </div>
                    @endif
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
