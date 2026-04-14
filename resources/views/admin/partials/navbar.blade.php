<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center"
  id="layout-navbar"
  style="background: linear-gradient(180deg, #f8f2e7 0%, #e6cfb0 100%) !important; border-bottom: 1px solid rgba(78,59,35,.15) !important;">
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="bx bx-menu bx-sm"></i>
    </a>
  </div>

  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <div class="navbar-nav align-items-center">
      <div class="nav-item d-flex align-items-center">
        <i class="bx bx-search fs-4 lh-0" style="color:#4e3b23;"></i>
        <input type="text" class="form-control border-0 shadow-none" placeholder="Cari..." style="background:transparent;color:#4e3b23;" />
      </div>
    </div>

    <ul class="navbar-nav flex-row align-items-center ms-auto">
      {{-- Notif cuti pending --}}
      @php $pendingCuti = \App\Models\Cuti::where('status','menunggu')->count(); @endphp
      @if($pendingCuti > 0)
      <li class="nav-item me-3">
        <a href="{{ route('admin.cuti.index') }}" class="nav-link position-relative" style="color:#4e3b23;">
          <i class="bx bx-bell fs-4"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:.65rem;">
            {{ $pendingCuti }}
          </span>
        </a>
      </li>
      @endif

      <!-- User Dropdown -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <div class="d-flex align-items-center justify-content-center rounded-circle fw-bold text-white"
            style="width:38px;height:38px;background:linear-gradient(135deg,#c19a6b,#8b6340);font-size:.95rem;flex-shrink:0;">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" style="background:#f8f2e7;border:1px solid rgba(78,59,35,.15);">
          <li>
            <div class="dropdown-item">
              <div class="d-flex align-items-center">
                <div class="d-flex align-items-center justify-content-center rounded-circle fw-bold text-white me-3"
                  style="width:38px;height:38px;background:linear-gradient(135deg,#c19a6b,#8b6340);font-size:.95rem;flex-shrink:0;">
                  {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                  <span class="fw-semibold d-block" style="color:#4e3b23;">{{ Auth::user()->name }}</span>
                  <small class="text-muted">{{ ucfirst(Auth::user()->role) }}</small>
                </div>
              </div>
            </div>
          </li>
          <li><div class="dropdown-divider"></div></li>
          <li>
            <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();"
              style="color:#4e3b23;">
              <i class="bx bx-power-off me-2"></i> Keluar
            </a>
            <form id="admin-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
