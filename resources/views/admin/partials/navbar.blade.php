 <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached navbar-light align-items-center"
            id="layout-navbar"
            style="background: linear-gradient(180deg, #f8f2e7 0%, #e6cfb0 100%) !important; background-color: #f8f2e7 !important; color: #4e3b23 !important; border-bottom: 1px solid rgba(78, 59, 35, 0.15) !important; backdrop-filter: none !important; -webkit-backdrop-filter: none !important;"
          >
            <style>
              #layout-navbar,
              .layout-navbar,
              #layout-navbar .navbar,
              #layout-navbar .navbar-nav-right,
              #layout-navbar .navbar-nav,
              #layout-navbar .navbar-nav .nav-item,
              #layout-navbar .navbar-nav .nav-link,
              #layout-navbar .navbar-nav .nav-link .github-button,
              #layout-navbar .layout-menu-toggle,
              #layout-navbar .nav-item .avatar,
              #layout-navbar.layout-navbar.navbar-detached,
              .layout-navbar.navbar-detached {
                background-color: transparent !important;
                background-image: none !important;
                box-shadow: none !important;
                border: none !important;
              }
              #layout-navbar,
              .layout-navbar {
                background: linear-gradient(180deg, #f8f2e7 0%, #e6cfb0 100%) !important;
                background-color: #f8f2e7 !important;
                background-image: none !important;
                backdrop-filter: none !important;
                -webkit-backdrop-filter: none !important;
              }
              #layout-navbar .nav-link, #layout-navbar .navbar-nav .nav-item a { color: #4e3b23 !important; }
              #layout-navbar .nav-link:hover, #layout-navbar .navbar-nav .nav-item a:hover { color: #2f1f0d !important; }
              #layout-navbar .form-control { background: rgba(255,255,255,0.92) !important; color: #4e3b23 !important; border: 1px solid rgba(78, 59, 35, 0.15) !important; }
              #layout-navbar .form-control::placeholder { color: #8b7761 !important; }
              #layout-navbar .dropdown-menu { background: #f8f2e7 !important; color: #4e3b23 !important; border: 1px solid rgba(78, 59, 35, 0.15) !important; }
              #layout-navbar .dropdown-item { color: #4e3b23 !important; }
              #layout-navbar .dropdown-item:hover { background: rgba(78, 59, 35, 0.08) !important; color: #2f1f0d !important; }
            </style>
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                <li class="nav-item lh-1 me-3">
                  <a
                    class="github-button"
                    href="https://github.com/themeselection/sneat-html-admin-template-free"
                    data-icon="octicon-star"
                    data-size="large"
                    data-show-count="true"
                    aria-label="Star themeselection/sneat-html-admin-template-free on GitHub"
                    >Star</a
                  >
                </li>

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">John Doe</span>
                            <small class="text-muted">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                          <span class="flex-grow-1 align-middle">Billing</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>