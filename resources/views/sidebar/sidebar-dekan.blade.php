<div class="main-sidebar sidebar-style-2 border-success">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <h4></h4>
            {{-- <a href="/"><img width="180" src="assets_index/assets/img/logo-fri-hijau.png"></a> --}}
            <a href="/"><img width="180" src="{{ asset('assets_index/assets/img/logo-fri-hijau.png') }}" width="70">

            {{-- <img class="rounded-circle img-fluid" src="assets_index/assets/img/logo-fri-hijau.png" alt="NOPE"  style="width: 80%"/> --}}

        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/"><img width="40" src="assets_index/assets/img/logo-fri-hijau-2.png" width="70">
                {{-- <img class="rounded-circle img-fluid" src="assets_index/assets/img/about/1.jpg" alt="..."  style="width: 80%"/> --}}
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main Menu</li>

            <li class="{{ Request::is('dekan-charts') ? 'active' : '' }}"><a class="nav-link"
                href=<?php echo url('dekan-charts'); ?>><i class="	fa fa-line-chart">
                    </i><span>Dashboard</span></a>
            </li>
            <li class="{{ Request::is('dekan-search') ? 'active' : '' }}"><a class="nav-link"
                    href=<?php echo url('dekan-search'); ?>><i class="	fa fa-search">
                        </i><span>Search Data Dosen</span></a>
            </li>
            <li class="{{ Request::is('profile') ? 'active' : '' }}"><a class="nav-link"
                    href=<?php echo url('profile'); ?>>
                    <i class="fa fa-pencil"></i><span>Profile</span></a>
            </li>
        </ul>
    </aside>
</div>
