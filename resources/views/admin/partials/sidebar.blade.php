<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme"
  style="background: linear-gradient(180deg, #f8f0e4 0%, #ddc7a7 100%); color: #4e3b23;">
  <style>
    #layout-menu .menu-link { color: #4e3b23 !important; }
    #layout-menu .menu-link:hover,
    #layout-menu .menu-item.active > .menu-link { color: #2f1f0d !important; background: rgba(78,59,35,.1) !important; }
    #layout-menu .menu-inner-shadow { background: linear-gradient(#f8f0e4 41%, rgba(248,240,228,.85) 95%, rgba(248,240,228,0)) !important; }
  </style>

  <div class="app-brand demo">
    <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
      <span class="app-brand-text demo menu-text fw-bolder ms-2" style="color:#4e3b23;">Admin Panel</span>
    </a>
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <a href="{{ route('admin.dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div>Dashboard</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase mt-2 mb-1" style="color:#8b7761;padding:.5rem 1rem;">
      <span>Manajemen Cuti</span>
    </li>

    <li class="menu-item {{ request()->routeIs('admin.cuti.*') ? 'active' : '' }}">
      <a href="{{ route('admin.cuti.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-calendar-check"></i>
        <div>Kelola Cuti</div>
        @php $pending = \App\Models\Cuti::where('status','menunggu')->count(); @endphp
        @if($pending > 0)
          <span class="badge rounded-pill bg-danger ms-auto">{{ $pending }}</span>
        @endif
      </a>
    </li>

    <li class="menu-header small text-uppercase mt-2 mb-1" style="color:#8b7761;padding:.5rem 1rem;">
      <span>Master Data</span>
    </li>

    <li class="menu-item {{ request()->routeIs('admin.karyawan.*') ? 'active' : '' }}">
      <a href="{{ route('admin.karyawan.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-group"></i>
        <div>Karyawan</div>
      </a>
    </li>

    <li class="menu-item {{ request()->routeIs('admin.jabatan.*') ? 'active' : '' }}">
      <a href="{{ route('admin.jabatan.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-briefcase"></i>
        <div>Jabatan</div>
      </a>
    </li>

    <li class="menu-item {{ request()->routeIs('admin.jenis-cuti.*') ? 'active' : '' }}">
      <a href="{{ route('admin.jenis-cuti.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-category-alt"></i>
        <div>Jenis Cuti</div>
      </a>
    </li>
  </ul>
</aside>
