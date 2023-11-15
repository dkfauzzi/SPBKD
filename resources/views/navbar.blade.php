<nav class="navbar navbar-expand-lg main-navbar">
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3 ">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
            </li>
            <li>
                <h1 class="header-nav">Sistem ... Beban Kerja Dosen</h1>
            </li>
        </ul>
    </div>
    <ul class="navbar-nav navbar-right">

        <li class="dropdown dropdown-list-toggle">
            {{-- @if ($beepState)
                <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i
                        class="far fa-bell"></i>
                </a>
            @else
                <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg"><i
                        class="far fa-bell"></i>
                </a>
            @endif --}}
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Notifications
                    <div class="float-right">
                        <a href="{{ url('/clearNotifications') }}">Mark All As Read</a>
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-icons" tabindex="3"
                    style="outline: none; height: fit-content; max-height: 300px;">
                    {{-- @foreach ($notifikasi as $n)
                        {{ Form::open(['url' => url('/readNotification')]) }}
                        {{ Form::hidden('inputNotificationID', $n->notifikasi_id) }}
                        {{ Form::hidden('inputNotificationRedirectLink', $n->notifikasi_link) }}
                        @if ($n->notifikasi_read == 0)
                            <button onclick="javascript:this.form.submit();"
                                class="dropdown-item dt-notification-button">
                                <div class="dropdown-item-icon bg-{{ $n->notifikasi_color }} text-white">
                                    <i class="{{ $n->notifikasi_icon }}"></i>
                                </div>
                                <div class="dropdown-item-desc text-dark">
                                    {{ $n->notifikasi_message }}
                                    <div class="time">{{ date('d-M-Y h:i a', strtotime($n->notifikasi_time)) }}</div>
                                </div>
                            </button>
                        @else
                            <button onclick="javascript:this.form.submit();" class="dropdown-item"
                                style="cursor: pointer;outline: none;">
                                <div class="dropdown-item-icon bg-{{ $n->notifikasi_color }} text-white">
                                    <i class="{{ $n->notifikasi_icon }}"></i>
                                </div>
                                <div class="dropdown-item-desc">
                                    {{ $n->notifikasi_message }}
                                    <div class="time">{{ date('d-M-Y h:i a', strtotime($n->notifikasi_time)) }}</div>
                                </div>
                            </button>
                        @endif
                        {{ Form::close() }}
                    @endforeach --}}
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
                {{-- <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div> --}}

            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ URL::to('/logout') }}" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>

        </li>
    </ul>
</nav>
