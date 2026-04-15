
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

    <title>Daftar Jabatan</title>
    <meta name="description" content="Halaman daftar jabatan." />

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
            <div class="container-xxl flex-grow-1 container-p-y" style="background-color: #f7f1e8; color: #4e3b23;">
              <div class="row mb-4">
                <div class="col-12">
                  <div class="card" style="background: linear-gradient(180deg, #f9f4ea 0%, #ddc6a7 100%); border-color: rgba(78, 59, 35, 0.18);">
                    <div class="card-body d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
                      <div>
                        <h4 class="card-title mb-1" style="color: #4e3b23;">Daftar Jabatan</h4>
                        <p class="card-text text-muted mb-0">Lihat semua jabatan yang tersedia dan terdaftar.</p>
                      </div>
                      <a href="{{ route('admin.jabatan.create') }}" class="btn btn-light btn-sm" style="color: #4e3b23; border-color: rgba(78, 59, 35, 0.15);">Tambah Jabatan</a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row g-4">
                <div class="col-xl-8 col-lg-12">
                  <div class="card" style="border-color: rgba(78, 59, 35, 0.18);">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <div>
                        <h5 class="mb-0">Data Jabatan</h5>
                        <small class="text-muted">Semua jabatan yang tersimpan dalam sistem.</small>
                      </div>
                    </div>
                    <div class="card-body">
                      @if(session('success'))
                        <div class="alert alert-success">
                          {{ session('success') }}
                        </div>
                      @endif

                      <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Nama Jabatan</th>
                              <th>Dibuat Pada</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse($jabatan as $item)
                              <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->jabatan }}</td>
                                <td>{{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}</td>
                                <td>
                                  <div class="d-flex gap-2">
                                    <a href="{{ route('admin.jabatan.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                      <i class="bx bx-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.jabatan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jabatan ini?');">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bx bx-trash"></i>
                                      </button>
                                    </form>
                                  </div>
                                </td>
                              </tr>
                            @empty
                              <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                  Belum ada data jabatan.
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
                      <div class="card" style="border-color: rgba(78, 59, 35, 0.18);">
                        <div class="card-body">
                          <div class="d-flex align-items-start justify-content-between">
                            <div>
                              <h6 class="mb-2">Ringkasan Jabatan</h6>
                              <p class="mb-0 text-muted">Jumlah jabatan yang tercatat di database.</p>
                            </div>
                            <i class="bx bx-briefcase fs-2 text-primary"></i>
                          </div>
                          <div class="mt-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                              <span>Total Jabatan</span>
                              <strong>{{ $jabatan->count() }}</strong>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="card bg-light" style="border-color: rgba(78, 59, 35, 0.12);">
                        <div class="card-body">
                          <h6 class="mb-3">Catatan</h6>
                          <ul class="ps-3 mb-0">
                            <li>Gunakan halaman ini untuk memeriksa nama posisi jabatan.</li>
                            <li>Tambahkan jabatan jika organisasi Anda memerlukan struktur baru.</li>
                            <li>Pastikan data jabatan sudah akurat dan konsisten.</li>
                          </ul>
                        </div>
                      </div>
                    </div>
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
