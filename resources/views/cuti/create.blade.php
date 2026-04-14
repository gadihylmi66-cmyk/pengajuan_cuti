<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Ajukan Cuti</title>
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
              <div class="row">
                <div class="col-12 mb-4">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title mb-2">Form Pengajuan Cuti</h4>
                      <p class="text-muted mb-4">Lengkapi informasi cuti Anda, lalu kirim permintaan kepada admin.</p>

                      @if ($errors->any())
                        <div class="alert alert-danger">
                          <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                        </div>
                      @endif

                      <div class="mb-3">
                        <label class="form-label">Nama Karyawan</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled />
                      </div>

                      <form action="{{ route('cuti.store') }}" method="POST">
                        @csrf

                        <div class="row g-3 mb-3">
                          <div class="col-md-6">
                            <label for="tanggal_masuk" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror"
                              id="tanggal_masuk" name="tanggal_masuk"
                              value="{{ old('tanggal_masuk') }}" required />
                            @error('tanggal_masuk')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="col-md-6">
                            <label for="tanggal_keluar" class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control @error('tanggal_keluar') is-invalid @enderror"
                              id="tanggal_keluar" name="tanggal_keluar"
                              value="{{ old('tanggal_keluar') }}" required />
                            @error('tanggal_keluar')
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>

                        <div class="mb-4">
                          <label for="alasan_cuti" class="form-label">Alasan Cuti</label>
                          <textarea class="form-control @error('alasan_cuti') is-invalid @enderror"
                            id="alasan_cuti" name="alasan_cuti" rows="4"
                            placeholder="Tuliskan alasan cuti Anda" required>{{ old('alasan_cuti') }}</textarea>
                          @error('alasan_cuti')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
                        <a href="{{ route('cuti.index') }}" class="btn btn-outline-secondary ms-2">Kembali</a>
                      </form>
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
