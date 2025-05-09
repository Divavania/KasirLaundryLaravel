<style>
    .navbar-custom {
        background-color: #ffffff !important;
        border-bottom: 2px solid #d4edda !important;
    }

    .navbar-custom .navbar-brand {
        color: #28a745 !important;
        font-weight: bold;
    }

    .navbar-custom .nav-link {
        color: #28a745 !important;
        font-weight: 500;
        transition: 0.3s;
    }

    .navbar-custom .nav-link:hover {
        color: #1e7e34 !important;
    }

    .navbar-custom .dropdown-menu a.dropdown-item:hover {
        background-color: #d4edda !important;
        color: #155724 !important;
    }

    .navbar-custom .nav-link.logout {
        color: #dc3545 !important;
        font-weight: 600;
    }

    .navbar-custom .nav-link.logout:hover {
        color: #bd2130 !important;
    }

    .navbar-toggler {
        border: none;
    }

    .navbar-toggler-icon {
        background-image: url('data:image/svg+xml;utf8,<svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><path stroke="rgba(0, 0, 0, 0.7)" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"/></svg>') !important;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ auth()->user()->role == 'superadmin' ? route('superadmin.dashboard') : route('admin.dashboard') }}">Kasir Laundry</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ auth()->user()->role == 'superadmin' ? route('superadmin.dashboard') : route('admin.dashboard') }}">Dashboard</a>
                </li>

                @if(auth()->user()->role == 'superadmin')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="kelolaDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Master Data</a>
                    <div class="dropdown-menu" aria-labelledby="kelolaDropdown">
                        <a class="dropdown-item" href="{{ route('admin.index') }}">Kelola Admin</a>
                        <a class="dropdown-item" href="{{ route('layanan.index') }}">Kelola Layanan</a>
                        <a class="dropdown-item" href="{{ route('pelanggan.index') }}">Kelola Pelanggan</a>
                    </div>
                </li>
                @elseif(auth()->user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pelanggan.index') }}">Kelola Pelanggan</a>
                </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link logout" href="{{ route('logout') }}">Logout</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>