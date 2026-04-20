<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  <title>Master Jabatan</title>
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
                  <h4 class="mb-1" style="color:#4e3b23;">Master Jabatan</h4>
                  <p class="mb-0 text-muted">Tambah dan edit jabatan menggunakan modal tanpa pindah route.</p>
                </div>
                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createJabatanModal">Tambah Jabatan</button>
              </div>
            </div>

            <div class="card" style="border-color: rgba(78, 59, 35, 0.18);">
              <div class="card-header"><h5 class="mb-0">Daftar Jabatan</h5></div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr><th>No</th><th>Nama Jabatan</th><th>Dibuat</th><th>Aksi</th></tr>
                    </thead>
                    <tbody>
                      @forelse($jabatan as $item)
                        <tr>
                          <td>{{ $jabatan->firstItem() + $loop->index }}</td>
                          <td class="fw-semibold">{{ $item->jabatan }}</td>
                          <td>{{ optional($item->created_at)->format('d M Y') ?: '-' }}</td>
                          <td>
                            <div class="d-flex gap-2">
                              <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editJabatanModal{{ $item->id }}"><i class="bx bx-edit"></i></button>
                              <form action="{{ route('admin.jabatan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus jabatan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="bx bx-trash"></i></button>
                              </form>
                            </div>
                          </td>
                        </tr>
                      @empty
                        <tr><td colspan="4" class="text-center text-muted py-4">Belum ada data jabatan.</td></tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
                <div class="mt-3">{{ $jabatan->links() }}</div>
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

  <div class="modal fade" id="createJabatanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"><div class="modal-content"><form action="{{ route('admin.jabatan.store') }}" method="POST">@csrf
      <div class="modal-header"><h5 class="modal-title">Tambah Jabatan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body"><label class="form-label">Nama Jabatan</label><input type="text" name="jabatan" class="form-control" required></div>
      <div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary">Simpan</button></div>
    </form></div></div>
  </div>

  @foreach($jabatan as $item)
    <div class="modal fade" id="editJabatanModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered"><div class="modal-content"><form action="{{ route('admin.jabatan.update', $item->id) }}" method="POST">@csrf @method('PUT')
        <div class="modal-header"><h5 class="modal-title">Edit Jabatan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body"><label class="form-label">Nama Jabatan</label><input type="text" name="jabatan" class="form-control" value="{{ $item->jabatan }}" required></div>
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
