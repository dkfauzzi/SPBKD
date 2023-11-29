<nav class="navbar navbar-expand-lg main-navbar">
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3 ">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
            </li>
            <li>
                <h1 class="header-nav">Sistem Informasi Tugas Penunjang Dosen</h1>
            </li>
        </ul>
    </div>
    <ul class="navbar-nav navbar-right">

        <li class="dropdown dropdown-list-toggle">
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Notifications
                    <div class="float-right">
                        <a href="{{ url('/clearNotifications') }}">Mark All As Read</a>
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-icons" tabindex="3"
                    style="outline: none; height: fit-content; max-height: 300px;">
                </div>
                <div class="dropdown-footer text-center">
                    <a href="{{ url('/notifikasi') }}">Lihat Semua <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </li>
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block"></div>

            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ URL::to('/logout') }}" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>

        </li>
    </ul>
</nav>
