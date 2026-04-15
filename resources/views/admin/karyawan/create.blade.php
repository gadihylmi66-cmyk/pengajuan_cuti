<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Tambah Karyawan</title>
    <meta name="description" content="Halaman form tambah karyawan." />

    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

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
            <div class="container-xxl flex-grow-1 container-p-y" style="background-color: #f7f1e8;">
              <div class="row">
                <div class="col-12 mb-4">
                  <div class="card" style="background: linear-gradient(180deg, #f9f4ea 0%, #ddc6a7 100%); border-color: rgba(78, 59, 35, 0.18);">
                    <div class="card-body">
                      <h4 class="card-title mb-2" style="color: #4e3b23;">Tambah Karyawan</h4>
                      <p class="text-muted mb-4">Isi data karyawan baru dengan lengkap.</p>

                      {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                          <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                        </div>
                      @endif --}}

                      <form action="{{ route('admin.karyawan.store') }}" method="POST">
                        @csrf

                        <div class="row g-3 mb-3">
                          <div class="col-md-6">
                            <label for="id_user" class="form-label">User</label>
                            <select id="id_user" name="id_user" class="form-select" required>
                              <option value="" disabled {{ old('id_user') ? '' : 'selected' }}>Pilih User</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('id_user') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-6">
                            <label for="id_jabatan" class="form-label">Jabatan</label>
                            <select id="id_jabatan" name="id_jabatan" class="form-select" required>
                              <option value="" disabled {{ old('id_jabatan') ? '' : 'selected' }}>Pilih Jabatan</option>
                              @foreach ($jabatans as $jabatan)
                                <option value="{{ $jabatan->id }}" {{ old('id_jabatan') == $jabatan->id ? 'selected' : '' }}>{{ $jabatan->jabatan }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>

                        <div class="row g-3 mb-3">
                          <div class="col-md-6">
                            <label class="form-label d-block">Jenis Kelamin</label>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_l" value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }} required>
                              <label class="form-check-label" for="jenis_kelamin_l">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_p" value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }} required>
                              <label class="form-check-label" for="jenis_kelamin_p">Perempuan</label>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}" placeholder="Contoh: Jakarta" required />
                          </div>
                        </div>

                        <div class="row g-3 mb-3">
                          <div class="col-md-6">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required />
                          </div>
                          <div class="col-md-6">
                            <label for="agama" class="form-label">Agama</label>
                            <select name="agama" id="agama" class="form-select" required>
                              <option value="" disabled {{ old('agama') ? '' : 'selected' }}>Pilih Agama</option>
                              <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                              <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                              <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                              <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                              <option value="Budha" {{ old('agama') == 'Budha' ? 'selected' : '' }}>Budha</option>
                              <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            </select>
                          </div>
                        </div>

                        <div class="mb-3">
                          <label for="alamat" class="form-label">Alamat</label>
                          <textarea id="alamat" name="alamat" class="form-control" rows="3" placeholder="Alamat lengkap" required>{{ old('alamat') }}</textarea>
                        </div>

                        <div class="mb-4">
                          <label for="no_telp" class="form-label">No. Telp</label>
                          <input type="text" id="no_telp" name="no_telp" class="form-control" value="{{ old('no_telp') }}" placeholder="Contoh: 081234567890" required />
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Karyawan</button>
                        <a href="{{ route('admin.karyawan.index') }}" class="btn btn-outline-secondary ms-2">Kembali</a>
                      </form>
                    </div>
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

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
  </body>
</html>
