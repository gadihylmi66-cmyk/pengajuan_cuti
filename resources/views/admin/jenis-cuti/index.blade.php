<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  <title>Master Jenis Cuti</title>
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

            <div class="card mb-4" style="background: linear-gradient(180deg, #f9f4ea 0%, #ddc6a7 100%); border-color: rgba(78, 59, 35, 0.18);">
              <div class="card-body d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <div>
                  <h4 class="mb-1" style="color:#4e3b23;">Master Jenis Cuti</h4>
                  <p class="mb-0 text-muted">Atur nama jenis cuti dan batas maksimal per tahun dari modal.</p>
                </div>
                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createJenisCutiModal">Tambah Jenis Cuti</button>
              </div>
            </div>

            <div class="card" style="border-color: rgba(78, 59, 35, 0.18);">
              <div class="card-header"><h5 class="mb-0">Daftar Jenis Cuti</h5></div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover align-middle">
                    <thead>
                      <tr><th>No</th><th>Jenis Cuti</th><th>Maksimal/Tahun</th><th>Status</th><th>Aksi</th></tr>
                    </thead>
                    <tbody>
                      @forelse($jenisCutis as $jenisCuti)
                        <tr>
                          <td>{{ $jenisCutis->firstItem() + $loop->index }}</td>
                          <td><div class="fw-semibold">{{ $jenisCuti->nama }}</div><small class="text-muted">{{ $jenisCuti->deskripsi ?: 'Tanpa deskripsi' }}</small></td>
                          <td>{{ $jenisCuti->maksimal_hari_per_tahun }} hari</td>
                          <td>@if($jenisCuti->is_active)<span class="badge bg-success">Aktif</span>@else<span class="badge bg-secondary">Nonaktif</span>@endif</td>
                          <td>
                            <div class="d-flex gap-2">
                              <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editJenisCutiModal{{ $jenisCuti->id }}"><i class="bx bx-edit"></i></button>
                              <form action="{{ route('admin.jenis-cuti.destroy', $jenisCuti->id) }}" method="POST" onsubmit="return confirm('Hapus jenis cuti ini?');">@csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="bx bx-trash"></i></button>
                              </form>
                            </div>
                          </td>
                        </tr>
                      @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada jenis cuti.</td></tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
                <div class="mt-3">{{ $jenisCutis->links() }}</div>
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

  <div class="modal fade" id="createJenisCutiModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"><div class="modal-content"><form action="{{ route('admin.jenis-cuti.store') }}" method="POST">@csrf
      <div class="modal-header"><h5 class="modal-title">Tambah Jenis Cuti</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body">
        <div class="mb-3"><label class="form-label">Nama</label><input type="text" name="nama" class="form-control" required></div>
        <div class="mb-3"><label class="form-label">Deskripsi</label><textarea name="deskripsi" class="form-control" rows="3"></textarea></div>
        <div class="mb-3"><label class="form-label">Maksimal Hari per Tahun</label><input type="number" name="maksimal_hari_per_tahun" class="form-control" min="1" max="365" value="12" required></div>
        <div class="form-check"><input class="form-check-input" type="checkbox" name="is_active" value="1" checked><label class="form-check-label">Aktif</label></div>
      </div>
      <div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary">Simpan</button></div>
    </form></div></div>
  </div>

  @foreach($jenisCutis as $jenisCuti)
    <div class="modal fade" id="editJenisCutiModal{{ $jenisCuti->id }}" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered"><div class="modal-content"><form action="{{ route('admin.jenis-cuti.update', $jenisCuti->id) }}" method="POST">@csrf @method('PUT')
        <div class="modal-header"><h5 class="modal-title">Edit Jenis Cuti</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
          <div class="mb-3"><label class="form-label">Nama</label><input type="text" name="nama" class="form-control" value="{{ $jenisCuti->nama }}" required></div>
          <div class="mb-3"><label class="form-label">Deskripsi</label><textarea name="deskripsi" class="form-control" rows="3">{{ $jenisCuti->deskripsi }}</textarea></div>
          <div class="mb-3"><label class="form-label">Maksimal Hari per Tahun</label><input type="number" name="maksimal_hari_per_tahun" class="form-control" min="1" max="365" value="{{ $jenisCuti->maksimal_hari_per_tahun }}" required></div>
          <div class="form-check"><input class="form-check-input" type="checkbox" name="is_active" value="1" @checked($jenisCuti->is_active)><label class="form-check-label">Aktif</label></div>
        </div>
        <div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary">Update</button></div>
      </form></div></div>
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
