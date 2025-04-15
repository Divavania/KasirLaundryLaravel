<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Kasir Laundry</a>
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
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.index') }}">Kelola Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('layanan.index') }}">Kelola Layanan</a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pelanggan.index') }}">Kelola Pelanggan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="{{ route('logout') }}">Logout</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
