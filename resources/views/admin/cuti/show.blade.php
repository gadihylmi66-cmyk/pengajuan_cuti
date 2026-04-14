<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-free">
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
</head>
<body>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      @include('admin.partials.sidebar')
      <div class="layout-page">
        @include('admin.partials.navbar')
        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row">
              <div class="col-md-8 mx-auto">
                <div class="card">
                  <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Detail Pengajuan Cuti</h5>
                    <a href="{{ route('admin.cuti.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
                  </div>
                  <div class="card-body">
                    <table class="table table-borderless">
                      <tr>
                        <th width="200">Nama Karyawan</th>
                        <td>{{ $cuti->karyawan?->user?->name ?? '-' }}</td>
                      </tr>
                      <tr>
                        <th>Tanggal Mulai</th>
                        <td>{{ \Carbon\Carbon::parse($cuti->tanggal_masuk)->format('d M Y') }}</td>
                      </tr>
                      <tr>
                        <th>Tanggal Selesai</th>
                        <td>{{ \Carbon\Carbon::parse($cuti->tanggal_keluar)->format('d M Y') }}</td>
                      </tr>
                      <tr>
                        <th>Alasan Cuti</th>
                        <td>{{ $cuti->alasan_cuti }}</td>
                      </tr>
                      <tr>
                        <th>Status</th>
                        <td>
                          @if($cuti->status === 'menunggu')
                            <span class="badge bg-warning">Menunggu</span>
                          @elseif($cuti->status === 'disetujui')
                            <span class="badge bg-success">Disetujui</span>
                          @else
                            <span class="badge bg-danger">Ditolak</span>
                          @endif
                        </td>
                      </tr>
                      @if($cuti->catatan_admin)
                      <tr>
                        <th>Catatan Admin</th>
                        <td>{{ $cuti->catatan_admin }}</td>
                      </tr>
                      @endif
                      <tr>
                        <th>Diajukan Pada</th>
                        <td>{{ $cuti->created_at->format('d M Y H:i') }}</td>
                      </tr>
                    </table>

                    @if($cuti->status === 'menunggu')
                      <hr>
                      <h6 class="mb-3">Proses Pengajuan</h6>
                      <div class="row g-3">
                        <div class="col-md-6">
                          <form action="{{ route('admin.cuti.approve', $cuti) }}" method="POST">
                            @csrf @method('PATCH')
                            <div class="mb-3">
                              <label class="form-label">Catatan (opsional)</label>
                              <textarea name="catatan_admin" class="form-control" rows="2" placeholder="Catatan persetujuan..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-success w-100"
                              onclick="return confirm('Setujui pengajuan cuti ini?')">
                              <i class="bx bx-check me-1"></i> Setujui
                            </button>
                          </form>
                        </div>
                        <div class="col-md-6">
                          <form action="{{ route('admin.cuti.reject', $cuti) }}" method="POST">
                            @csrf @method('PATCH')
                            <div class="mb-3">
                              <label class="form-label">Alasan penolakan (opsional)</label>
                              <textarea name="catatan_admin" class="form-control" rows="2" placeholder="Alasan penolakan..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger w-100"
                              onclick="return confirm('Tolak pengajuan cuti ini?')">
                              <i class="bx bx-x me-1"></i> Tolak
                            </button>
                          </form>
                        </div>
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
