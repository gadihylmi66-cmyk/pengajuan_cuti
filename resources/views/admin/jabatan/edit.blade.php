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

    <title>Edit Jabatan</title>
    <meta name="description" content="Halaman form edit jabatan." />

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
                      <h4 class="card-title mb-2" style="color: #4e3b23;">Edit Jabatan</h4>
                      <p class="text-muted mb-4">Perbarui nama jabatan yang sudah tersimpan.</p>

                      @if ($errors->any())
                        <div class="alert alert-danger">
                          <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                        </div>
                      @endif

                      <form action="{{ route('admin.jabatan.update', $jabatan->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4">
                          <label for="jabatan" class="form-label">Nama Jabatan</label>
                          <input
                            type="text"
                            id="jabatan"
                            name="jabatan"
                            class="form-control"
                            value="{{ old('jabatan', $jabatan->jabatan) }}"
                            placeholder="Contoh: Staff HR"
                            required
                          />
                        </div>

                        <div class="d-flex gap-2">
                          <button type="submit" class="btn btn-primary">Perbarui Jabatan</button>
                          <a href="{{ route('admin.jabatan.index') }}" class="btn btn-outline-secondary">Kembali</a>
                        </div>
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
