<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ route('admin.dashboard') }}" id="topnav-dashboard"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard me-1"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ route('admin.program.index') }}" id="topnav-dashboard"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-equal-box me-1"></i> Program Kelas
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ route('admin.absent.index') }}" id="topnav-dashboard"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-file-edit me-1"></i> Absent
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ route('admin.event.index') }}" id="topnav-dashboard"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-calendar-multiple me-1"></i> Even Lomba
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ route('admin.member.index') }}" id="topnav-dashboard"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-account-multiple me-1"></i> Anggota
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ route('admin.trainer.index') }}" id="topnav-dashboard"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-account-star me-1"></i> Pelatih
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ route('admin.gallery.index') }}" id="topnav-dashboard"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-image-album me-1"></i> Galeri
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ route('admin.setting.index') }}" id="topnav-dashboard"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-cog me-1"></i> Pengaturan
                        </a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ route('admin.profile.index') }}" id="topnav-dashboard"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-account-box-multiple me-1"></i> Profil
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ route('admin.account.index') }}" id="topnav-dashboard"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-account-cog me-1"></i> Akun
                        </a>
                    </li>
                </ul> <!-- end navbar-->
            </div> <!-- end .collapsed-->
        </nav>
    </div> <!-- end container-fluid -->
</div> <!-- end topnav-->