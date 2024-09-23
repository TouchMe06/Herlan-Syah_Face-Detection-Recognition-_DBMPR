<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0">
            <img src="{{ asset('assets/logo.png') }}" class="navbar-brand-img h-100" alt="Lambang Jawa Barat" />
            <span class="ms-1 font-weight-bold">Dashboard</span>
        </a>

        <hr class="horizontal dark mt-0" />

        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}"
                        href="{{ route('admin-dashboard') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-tv text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('daftar-tamu*') ? 'active' : '' }}"
                        href="{{ route('daftar_tamu') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-users text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Daftar Tamu</span>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('unit-kerja*') ? 'active' : '' }}"
                        href="{{ route('nitKerja') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-building text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Unit Kerja</span>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('pegawai*') ? 'active' : '' }}" href="{{ route('pegawai') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-user text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pegawai</span>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('keperluan*') ? 'active' : '' }}" href="{{ route('perlu') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-comments text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Keperluan</span>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('pertanyaan*') ? 'active' : '' }}"
                        href="{{ route('tanya') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-question text-secondary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pertanyaan</span>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('jawaban*') ? 'active' : '' }}" href="{{ route('jawab') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-clipboard text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Jawaban</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
