<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
        <a class="nav-link" href="{{ auth()->user()->role == 'superadmin' ? route('superadmin.dashboard') : route('admin.dashboard') }}">
            Dashboard
        </a>
    </li>

    @if(auth()->user()->role == 'superadmin')
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="kelolaDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Manajemen Kelola
            </a>
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
        <a class="nav-link text-danger" href="{{ route('logout') }}">Logout</a>
    </li>
    @endauth
</ul>

        </div>
    </div>
</nav>
