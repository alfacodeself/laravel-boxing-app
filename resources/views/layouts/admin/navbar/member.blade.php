<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ route('member.dashboard') }}" id="topnav-dashboard"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard me-1"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ route('member.program.index') }}" id="topnav-dashboard"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-equal-box me-1"></i> Program Kelas
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ route('member.event.index') }}" id="topnav-dashboard"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-calendar-multiple me-1"></i> Pengajuan Lomba
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ route('member.transaction.index') }}" id="topnav-dashboard"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-file-document-multiple me-1"></i> Transaksi
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ route('member.profile.index') }}" id="topnav-dashboard"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-account-box-multiple me-1"></i> Profil
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ route('member.account.index') }}" id="topnav-dashboard"
                            role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-account-cog me-1"></i> Akun
                        </a>
                    </li>
                </ul> <!-- end navbar-->
            </div> <!-- end .collapsed-->
        </nav>
    </div> <!-- end container-fluid -->
</div> <!-- end topnav-->