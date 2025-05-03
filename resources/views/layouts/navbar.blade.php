<style>
    .navbar-custom {
        background-color: #ffffff;
        border-bottom: 2px solid #d4edda;
    }
    .navbar-custom .navbar-brand {
        color: #28a745;
        font-weight: bold;
    }
    .navbar-custom .nav-link {
        color: #28a745;
        font-weight: 500;
        transition: 0.3s;
    }
    .navbar-custom .nav-link:hover {
        color: #1e7e34;
    }
    .navbar-custom .dropdown-menu a.dropdown-item:hover {
        background-color: #d4edda;
        color: #155724;
    }
    .navbar-custom .nav-link.logout {
        color: #dc3545;
        font-weight: 600;
    }
    .navbar-custom .nav-link.logout:hover {
        color: #bd2130;
    }
    .navbar-toggler {
        border: none;
    }
    .navbar-toggler-icon {
        background-image: url('data:image/svg+xml;utf8,<svg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"><path stroke="rgba(0, 0, 0, 0.7)" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"/></svg>');
    }
</style>

<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="{{ auth()->user()->role == 'superadmin' ? route('superadmin.dashboard') : route('admin.dashboard') }}">Kasir Laundry</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ auth()->user()->role == 'superadmin' ? route('superadmin.dashboard') : route('admin.dashboard') }}">Dashboard</a>
                </li>

                @if(auth()->user()->role == 'superadmin')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="kelolaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Master Data</a>
                        <ul class="dropdown-menu" aria-labelledby="kelolaDropdown">
                            <li><a class="dropdown-item" href="{{ route('admin.index') }}">Kelola Admin</a></li>
                            <li><a class="dropdown-item" href="{{ route('layanan.index') }}">Kelola Layanan</a></li>
                            <li><a class="dropdown-item" href="{{ route('pelanggan.index') }}">Kelola Pelanggan</a></li>
                        </ul>
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
