<div class="main-sidebar sidebar-style-2 border-success">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <h4></h4>
            <a href="/"><img width="180" src="assets_index/assets/img/logo-fri-hijau.png"></a>
            {{-- <img class="rounded-circle img-fluid" src="assets_index/assets/img/logo-fri-hijau.png" alt="NOPE"  style="width: 80%"/> --}}

        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/"><img width="40" src="assets_index/assets/img/logo-fri-hijau-2.png" width="70">
                {{-- <img class="rounded-circle img-fluid" src="assets_index/assets/img/about/1.jpg" alt="..."  style="width: 80%"/> --}}
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main Menu</li>

            <li class="{{ Request::is('sekretariat2-charts') ? 'active' : '' }}"><a class="nav-link"
                href=<?php echo url('sekretariat2-charts'); ?>><i class="	fa fa-line-chart">
                    </i><span>Dashboard</span></a>
            </li>
            <li class="{{ Request::is('sekretariat2-search') ? 'active' : '' }}"><a class="nav-link"
                    href=<?php echo url('sekretariat2-search'); ?>><i class="	fa fa-search">
                        </i><span>Search Data Dosen</span></a>
                </li>

            {{-- <li class="{{ Request::is('sekretariat2-dashboard') ? 'active' : '' }}"><a class="nav-link"
                    href=<?php echo url('sekretariat2-dashboard'); ?>>
                    <i class="fas fa-book-open"></i><span>Data Dosen</span></a>
                </li> --}}

            <li class="{{ Request::is('sekretariat2-register') ? 'active' : '' }}"><a class="nav-link"
                    href=<?php echo url('sekretariat2-register'); ?>>
                    <i class="fas fa-plus-circle"></i><span>Register Akun Dosen</span></a>
                </li>

            {{-- <li class="{{ Request::is('dashboard-mahasiswa-sidang-ta') ? 'active' : '' }}"><a class="nav-link"
                    href=<?php echo url('dashboard-mahasiswa-sidang-ta'); ?>>
                    <i class="fas fa-book-reader"></i><span>Data Dosen</span></a>
                </li> --}}


            {{-- <li class="{{ Request::is('dashboard-mahasiswa-bimbingan-ta') ? 'active' : '' }}"><a class="nav-link"
                    href=<?php echo url('dashboard-mahasiswa-bimbingan-ta'); ?>><i class="fas fa-file-alt"></i>
                    <span>Bimbingan Tugas Akhir</span></a></li>
            <li class="menu-header">Management Pendaftaran Kerja Praktik</li>
            <li class="{{ Request::is('dashboard-mahasiswa-form-001') ? 'active' : '' }}"><a class="nav-link"
                    href=<?php echo url('dashboard-mahasiswa-form-001'); ?>><i class="fas fa-sticky-note"></i>
                    <span>Pengajuan Kerja
                        Praktik (Form-001)</span></a></li>
            <li class="{{ Request::is('dashboard-mahasiswa-kp') ? 'active' : '' }}"><a class="nav-link"
                    href=<?php echo url('dashboard-mahasiswa-kp'); ?>><i class="fas fa-sticky-note"></i>
                    <span>Daftar Kerja Praktik</span></a></li>
            <li class="{{ Request::is('dashboard-mahasiswa-bimbingan-kp') ? 'active' : '' }}"><a class="nav-link"
                    href=<?php echo url('dashboard-mahasiswa-bimbingan-kp'); ?>><i class="fas fa-book-open"></i>
                    <span>Bimbingan Kerja Praktik</span></a></li>
            <li class="{{ Request::is('dashboard-mahasiswa-sidang-kp') ? 'active' : '' }}"><a class="nav-link"
                href=<?php echo url('dashboard-mahasiswa-sidang-kp'); ?>><i class="fas fa-book-open"></i>
                <span>Sidang Kerja
                        Praktik</span></a></li>
            <li class="{{ Request::is('dashboard-mahasiswa-penilaian-kp') ? 'active' : '' }}"><a class="nav-link"
                href=<?php echo url('dashboard-mahasiswa-penilaian-kp'); ?>><i class="fas fa-book-open"></i>
                <span>Nilai Kerja
                        Praktik</span></a></li>
            <li class="menu-header">Yudisium</li>
            <li class="{{ Request::is('dashboard-mahasiswa-yudisium') ? 'active' : '' }}"><a class="nav-link"
                    href=<?php echo url('dashboard-mahasiswa-yudisium'); ?>><i class="fas fa-graduation-cap"></i>
                    <span>Daftar Yudisium</span></a></li>
            <li class="{{ Request::is('dashboard-mahasiswa-yudisium/tentang-yudisium') ? 'active' : '' }}"><a
                    class="nav-link" href=<?php echo url('dashboard-mahasiswa-yudisium/tentang-yudisium'); ?>><i
                        class="fas fa-graduation-cap"></i>
                    <span>Tata Cara Yudisium</span></a></li>
            <li class="menu-header">Informasi</li>
            <li class="{{ Request::is('profile-mahasiswa') ? 'active' : '' }}"><a class="nav-link"
                    href=<?php echo url('profile-mahasiswa'); ?>><i class="fas fa-user-alt"></i>
                    <span>Profile</span></a></li> --}}
        </ul>
    </aside>
</div>
