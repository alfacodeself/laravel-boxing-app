<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ route('trainer.dashboard') }}" id="topnav-dashboard"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard me-1"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ route('trainer.program.index') }}" id="topnav-dashboard"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-equal-box me-1"></i> Program Kelas Saya
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ route('trainer.profile.index') }}" id="topnav-dashboard"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-account-box-multiple me-1"></i> Profil
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ route('trainer.account.index') }}" id="topnav-dashboard"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-account-cog me-1"></i> Akun
                        </a>
                    </li>
                </ul> <!-- end navbar-->
            </div> <!-- end .collapsed-->
        </nav>
    </div> <!-- end container-fluid -->
</div> <!-- end topnav-->