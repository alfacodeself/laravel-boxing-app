@php
    if (isset(auth()->user()->trainer)) {
        $nama = auth()->user()->trainer->nama;
        $foto = url(auth()->user()->trainer->foto);
    }else {
        $nama = auth()->user()->nama;
        $foto = asset('assets/images/default-avatar.png');
    }
@endphp

<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-end mb-0">
            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown"
                    href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ $foto }}" alt="user-image" class="rounded-circle">
                    <span class="pro-user-name ms-1 text-capitalize">
                       {{$nama}}
                        <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Selamat Datang Trainer!</h6>
                    </div>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        @method('POST')
                        <button type="submit" class="dropdown-item notify-item">
                            <i class="fe-log-out"></i>
                            <span>Logout</span>
                        </button>
                    </form>

                </div>
            </li>

        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="#" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="{{ $foto }}" alt="" height="22">
                </span>
                <span class="logo-lg text-light font-22 fw-bold">
                    {{ $nama }}
                </span>
            </a>
        </div>
        <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">

            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>

        </ul>

        <div class="clearfix"></div>

    </div>

</div>
