<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  <title>Kelola Pengajuan Cuti</title>
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
        <div class="content-wrapper" style="background-color: #f5efe5; color: #4e3b23;">
          <div class="container-xxl flex-grow-1 container-p-y">
            @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>
            @endif

            <div class="row g-3 mb-4">
              <div class="col-md-4"><div class="card text-center border-warning"><div class="card-body"><h3 class="text-warning">{{ $pendingCount }}</h3><p class="mb-0 text-muted">Menunggu</p></div></div></div>
              <div class="col-md-4"><div class="card text-center border-success"><div class="card-body"><h3 class="text-success">{{ $approvedCount }}</h3><p class="mb-0 text-muted">Disetujui</p></div></div></div>
              <div class="col-md-4"><div class="card text-center border-danger"><div class="card-body"><h3 class="text-danger">{{ $rejectedCount }}</h3><p class="mb-0 text-muted">Ditolak</p></div></div></div>
            </div>

            <div class="card" style="border-color: rgba(78, 59, 35, 0.18);">
              <div class="card-header">
                <h5 class="mb-0">Daftar Pengajuan Cuti</h5>
                <small class="text-muted">Seluruh detail ditampilkan melalui modal dan tabel memakai paging.</small>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover align-middle">
                    <thead>
                      <tr><th>No</th><th>Karyawan</th><th>Jenis Cuti</th><th>Periode</th><th>Durasi</th><th>Status</th><th>Aksi</th></tr>
                    </thead>
                    <tbody>
                      @forelse($cutis as $cuti)
                        <tr>
                          <td>{{ $cutis->firstItem() + $loop->index }}</td>
                          <td>{{ $cuti->karyawan?->user?->name ?? '-' }}</td>
                          <td>{{ $cuti->jenisCuti?->nama ?? '-' }}</td>
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
                            <div class="d-flex gap-2">
                              <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#detailCutiModal{{ $cuti->id }}">Detail</button>
                              <form action="{{ route('admin.cuti.destroy', $cuti) }}" method="POST" onsubmit="return confirm('Hapus pengajuan ini?');">@csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                              </form>
                            </div>
                          </td>
                        </tr>
                      @empty
                        <tr><td colspan="7" class="text-center text-muted py-4">Belum ada pengajuan cuti.</td></tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
                <div class="mt-3">{{ $cutis->links() }}</div>
              </div>
            </div>
          </div>
          @include('admin.partials.footer')
          <div class="content-backdrop fade"></div>
        </div>
      </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>

  @foreach($cutis as $cuti)
    <div class="modal fade" id="detailCutiModal{{ $cuti->id }}" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered"><div class="modal-content">
        <div class="modal-header"><h5 class="modal-title">Detail Pengajuan Cuti</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6"><label class="form-label text-muted">Karyawan</label><div class="fw-semibold">{{ $cuti->karyawan?->user?->name ?? '-' }}</div></div>
            <div class="col-md-6"><label class="form-label text-muted">Jenis Cuti</label><div class="fw-semibold">{{ $cuti->jenisCuti?->nama ?? '-' }}</div></div>
            <div class="col-md-6"><label class="form-label text-muted">Tanggal Mulai</label><div class="fw-semibold">{{ \Carbon\Carbon::parse($cuti->tanggal_masuk)->format('d M Y') }}</div></div>
            <div class="col-md-6"><label class="form-label text-muted">Tanggal Selesai</label><div class="fw-semibold">{{ \Carbon\Carbon::parse($cuti->tanggal_keluar)->format('d M Y') }}</div></div>
            <div class="col-md-6"><label class="form-label text-muted">Durasi</label><div class="fw-semibold">{{ $cuti->jumlah_hari }} hari</div></div>
            <div class="col-md-6">
              <label class="form-label text-muted">Lampiran</label>
              <div>@if($cuti->lampiran)<a href="{{ asset('storage/' . $cuti->lampiran) }}" target="_blank">Lihat lampiran</a>@else<span class="text-muted">Tidak ada lampiran</span>@endif</div>
            </div>
            <div class="col-12"><label class="form-label text-muted">Alasan Cuti</label><div class="fw-semibold">{{ $cuti->alasan_cuti }}</div></div>
          </div>

          @if($cuti->status === 'menunggu')
            <hr>
            <div class="row g-3">
              <div class="col-md-6">
                <form action="{{ route('admin.cuti.approve', $cuti) }}" method="POST">@csrf @method('PATCH')
                  <label class="form-label">Catatan Persetujuan</label>
                  <textarea name="catatan_admin" class="form-control mb-3" rows="3"></textarea>
                  <button type="submit" class="btn btn-success w-100">Setujui</button>
                </form>
              </div>
              <div class="col-md-6">
                <form action="{{ route('admin.cuti.reject', $cuti) }}" method="POST">@csrf @method('PATCH')
                  <label class="form-label">Catatan Penolakan</label>
                  <textarea name="catatan_admin" class="form-control mb-3" rows="3"></textarea>
                  <button type="submit" class="btn btn-danger w-100">Tolak</button>
                </form>
              </div>
            </div>
          @else
            <hr>
            <label class="form-label text-muted">Catatan Admin</label>
            <div class="fw-semibold">{{ $cuti->catatan_admin ?: 'Tidak ada catatan.' }}</div>
          @endif
        </div>
      </div></div>
    </div>
  @endforeach

  <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
