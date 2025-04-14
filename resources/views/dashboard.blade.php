<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Halo, {{ auth()->user()->username }} ({{ auth()->user()->role }})</h2>

    <nav>
        <ul>
            <li><a href="{{ route('logout') }}">Logout</a></li>

            @if(auth()->user()->role == 'superadmin')
                <li><a href="{{ route('admin.index') }}">Kelola Admin</a></li>
                <li><a href="{{ route('layanan.index') }}">Kelola Layanan</a></li>
            @endif

            <li><a href="{{ route('pelanggan.index') }}">Kelola Pelanggan</a></li>
            <li><a href="{{ route('pesanan.index') }}">Input Pesanan</a></li>
        </ul>
    </nav>

    <p>Selamat datang di sistem kasir laundry!</p>
</body>
</html>
