<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="{{ url('/dashboard') }}" class="brand-link">

            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Sistem Bon Pengeluaran</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="navigation"
                aria-label="Main navigation"
                data-accordion="false">

              <!-- Dashboard -->
              <li class="nav-item">
                <a href="{{ url('/dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item {{ request()->is('opening-balance*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('opening-balance*') ? 'active' : '' }}">
                  <i class="nav-icon bi bi-database"></i>
                  <p>
                    Master Data
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('opening-balances.index') }}"
                      class="nav-link {{ request()->routeIs('opening-balance.*') ? 'active' : '' }}">
                      <i class="nav-icon bi bi-cash-stack"></i>
                      <p>Saldo Awal</p>
                    </a>
                  </li>
                </ul>
              </li>

              <!-- Bukti Pengeluaran -->
              <li class="nav-item {{ request()->is('expense-voucher*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('expense-voucher*') ? 'active' : '' }}">
                  <i class="nav-icon bi bi-receipt"></i>
                  <p>
                    Transaksi
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('expense-voucher') }}"
                      class="nav-link {{ request()->routeIs('expense-voucher') ? 'active' : '' }}">
                      <i class="nav-icon bi bi-list-check"></i>
                      <p>Pengeluaran</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ route('income-voucher') }}" class="nav-link">
                      <i class="nav-icon bi bi-arrow-down-circle"></i>
                      <p>Penerimaan</p>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- Laporan -->
              <li class="nav-item {{ request()->is('reports*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ request()->is('reports*') ? 'active' : '' }}">
                  <i class="nav-icon bi bi-journal-text"></i>
                  <p>
                    Laporan
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('reports.cash-book') }}"
                      class="nav-link {{ request()->routeIs('reports.cash-book*') ? 'active' : '' }}">
                      <i class="nav-icon bi bi-table"></i>
                      <p>Rekap Buku Kas</p>
                    </a>
                  </li>
                </ul>
              </li>

            </ul>
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>