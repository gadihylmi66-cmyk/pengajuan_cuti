{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
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

    <title>Dashboard - Pengajuan Cuti</title>

    <meta name="description" content="Dashboard admin untuk memantau cuti, jabatan, dan hasil" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        @include('layouts.partials.sidebar')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          @include('layouts.partials.navbar')
          <!-- / Navbar -->
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card overflow-hidden bg-primary text-white">
                    <div class="row g-0 align-items-center">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-white mb-2">Selamat datang, {{ Auth::user()->name }}! 🎉</h5>
                          <p class="card-text text-white-75 mb-4">
                            Kelola pengajuan cuti, jabatan, dan hasil karyawan dengan mudah dari dashboard ini.
                            Semua data diperbarui otomatis setiap kali Anda masuk.
                          </p>
                          <div class="d-flex flex-wrap gap-2">
                            <a href="{{ url('/admin/dashboard') }}" class="btn btn-light btn-sm">Lihat Dashboard</a>
                            <a href="{{ url('/cuti') }}" class="btn btn-outline-light btn-sm">Ajukan Cuti</a>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}"
                            height="170"
                            alt="Dashboard Illustration"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card h-100">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="avatar bg-label-primary rounded">
                          <i class="bx bx-user fs-4 text-primary"></i>
                        </div>
                        <span class="badge bg-primary">Karyawan</span>
                      </div>
                      <h3 class="mt-3">{{ $karyawanCount }}</h3>
                      <p class="mb-0 text-muted">Jumlah karyawan terdaftar</p>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card h-100">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="avatar bg-label-info rounded">
                          <i class="bx bx-briefcase fs-4 text-info"></i>
                        </div>
                        <span class="badge bg-info">Jabatan</span>
                      </div>
                      <h3 class="mt-3">{{ $jabatanCount }}</h3>
                      <p class="mb-0 text-muted">Total jabatan yang tersedia</p>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card h-100">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="avatar bg-label-success rounded">
                          <i class="bx bx-calendar-check fs-4 text-success"></i>
                        </div>
                        <span class="badge bg-success">Cuti</span>
                      </div>
                      <h3 class="mt-3">{{ $cutiCount }}</h3>
                      <p class="mb-0 text-muted">Pengajuan cuti yang tercatat</p>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card h-100">
                    <div class="card-body">
                      <div class="d-flex align-items-start justify-content-between">
                        <div class="avatar bg-label-warning rounded">
                          <i class="bx bx-check-shield fs-4 text-warning"></i>
                        </div>
                        <span class="badge bg-warning">Hasil</span>
                      </div>
                      <h3 class="mt-3">{{ $hasilCount }}</h3>
                      <p class="mb-0 text-muted">Data hasil yang tersimpan</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            @include('layouts.partials.footer')
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
