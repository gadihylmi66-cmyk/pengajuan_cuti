<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  <title>Data Karyawan</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
  <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
  <script src="{{ asset('assets/js/config.js') }}"></script>
  <style>.avatar-photo{width:44px;height:44px;border-radius:14px;object-fit:cover;}</style>
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
                  <h4 class="mb-1" style="color:#4e3b23;">Data Karyawan</h4>
                  <p class="mb-0 text-muted">Kelola data, foto profil, dan jabatan karyawan melalui modal window.</p>
                </div>
                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createKaryawanModal">Tambah Karyawan</button>
              </div>
            </div>

            <div class="card" style="border-color: rgba(78, 59, 35, 0.18);">
              <div class="card-header"><h5 class="mb-0">Daftar Karyawan</h5></div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover align-middle">
                    <thead>
                      <tr><th>No</th><th>Karyawan</th><th>Jabatan</th><th>Jenis Kelamin</th><th>Tanggal Lahir</th><th>No. Telp</th><th>Aksi</th></tr>
                    </thead>
                    <tbody>
                      @forelse($karyawans as $karyawan)
                        <tr>
                          <td>{{ $karyawans->firstItem() + $loop->index }}</td>
                          <td>
                            <div class="d-flex align-items-center gap-3">
                              @if($karyawan->foto_profil)
                                <img src="{{ asset('storage/' . $karyawan->foto_profil) }}" alt="Foto" class="avatar-photo">
                              @else
                                <div class="avatar avatar-sm"><span class="avatar-initial rounded bg-label-primary">{{ strtoupper(substr($karyawan->user->name, 0, 1)) }}</span></div>
                              @endif
                              <div><div class="fw-semibold">{{ $karyawan->user->name }}</div><small class="text-muted">{{ $karyawan->user->email }}</small></div>
                            </div>
                          </td>
                          <td>{{ $karyawan->jabatan?->jabatan ?? '-' }}</td>
                          <td>{{ $karyawan->jenis_kelamin }}</td>
                          <td>{{ \Carbon\Carbon::parse($karyawan->tanggal_lahir)->format('d M Y') }}</td>
                          <td>{{ $karyawan->no_telp }}</td>
                          <td>
                            <div class="d-flex gap-2">
                              <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editKaryawanModal{{ $karyawan->id }}"><i class="bx bx-edit"></i></button>
                              <form action="{{ route('admin.karyawan.destroy', $karyawan->id) }}" method="POST" onsubmit="return confirm('Hapus data karyawan ini?');">@csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="bx bx-trash"></i></button>
                              </form>
                            </div>
                          </td>
                        </tr>
                      @empty
                        <tr><td colspan="7" class="text-center text-muted py-4">Belum ada data karyawan.</td></tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
                <div class="mt-3">{{ $karyawans->links() }}</div>
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

  <div class="modal fade" id="createKaryawanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered"><div class="modal-content"><form action="{{ route('admin.karyawan.store') }}" method="POST" enctype="multipart/form-data">@csrf
      <div class="modal-header"><h5 class="modal-title">Tambah Karyawan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body"><div class="row g-3">
        <div class="col-md-6"><label class="form-label">User</label><select name="id_user" class="form-select" required><option value="">Pilih user</option>@foreach($users as $user)<option value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}</option>@endforeach</select></div>
        <div class="col-md-6"><label class="form-label">Jabatan</label><select name="id_jabatan" class="form-select" required><option value="">Pilih jabatan</option>@foreach($jabatans as $jabatan)<option value="{{ $jabatan->id }}">{{ $jabatan->jabatan }}</option>@endforeach</select></div>
        <div class="col-md-6"><label class="form-label">Foto Profil</label><input type="file" name="foto_profil" class="form-control" accept=".jpg,.jpeg,.png"></div>
        <div class="col-md-6"><label class="form-label">Jenis Kelamin</label><select name="jenis_kelamin" class="form-select" required><option value="">Pilih</option><option value="Laki-laki">Laki-laki</option><option value="Perempuan">Perempuan</option></select></div>
        <div class="col-md-6"><label class="form-label">Tempat Lahir</label><input type="text" name="tempat_lahir" class="form-control" required></div>
        <div class="col-md-6"><label class="form-label">Tanggal Lahir</label><input type="date" name="tanggal_lahir" class="form-control" required></div>
        <div class="col-md-6"><label class="form-label">Agama</label><input type="text" name="agama" class="form-control" required></div>
        <div class="col-md-6"><label class="form-label">No. Telp</label><input type="text" name="no_telp" class="form-control" required></div>
        <div class="col-12"><label class="form-label">Alamat</label><textarea name="alamat" class="form-control" rows="3" required></textarea></div>
      </div></div>
      <div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button><button type="submit" class="btn btn-primary">Simpan</button></div>
    </form></div></div>
  </div>

  @foreach($karyawans as $karyawan)
    <div class="modal fade" id="editKaryawanModal{{ $karyawan->id }}" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered"><div class="modal-content"><form action="{{ route('admin.karyawan.update', $karyawan->id) }}" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
        <div class="modal-header"><h5 class="modal-title">Edit Karyawan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body"><div class="row g-3">
          <div class="col-md-6"><label class="form-label">User</label><select name="id_user" class="form-select" required>@foreach($allUsers as $user)<option value="{{ $user->id }}" @selected($user->id == $karyawan->id_user)>{{ $user->name }} - {{ $user->email }}</option>@endforeach</select></div>
          <div class="col-md-6"><label class="form-label">Jabatan</label><select name="id_jabatan" class="form-select" required>@foreach($jabatans as $jabatan)<option value="{{ $jabatan->id }}" @selected($jabatan->id == $karyawan->id_jabatan)>{{ $jabatan->jabatan }}</option>@endforeach</select></div>
          <div class="col-md-6"><label class="form-label">Foto Profil</label><input type="file" name="foto_profil" class="form-control" accept=".jpg,.jpeg,.png"></div>
          <div class="col-md-6"><label class="form-label">Jenis Kelamin</label><select name="jenis_kelamin" class="form-select" required><option value="Laki-laki" @selected($karyawan->jenis_kelamin === 'Laki-laki')>Laki-laki</option><option value="Perempuan" @selected($karyawan->jenis_kelamin === 'Perempuan')>Perempuan</option></select></div>
          <div class="col-md-6"><label class="form-label">Tempat Lahir</label><input type="text" name="tempat_lahir" class="form-control" value="{{ $karyawan->tempat_lahir }}" required></div>
          <div class="col-md-6"><label class="form-label">Tanggal Lahir</label><input type="date" name="tanggal_lahir" class="form-control" value="{{ $karyawan->tanggal_lahir }}" required></div>
          <div class="col-md-6"><label class="form-label">Agama</label><input type="text" name="agama" class="form-control" value="{{ $karyawan->agama }}" required></div>
          <div class="col-md-6"><label class="form-label">No. Telp</label><input type="text" name="no_telp" class="form-control" value="{{ $karyawan->no_telp }}" required></div>
          <div class="col-12"><label class="form-label">Alamat</label><textarea name="alamat" class="form-control" rows="3" required>{{ $karyawan->alamat }}</textarea></div>
        </div></div>
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
