<!-- resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    @include('layouts.app')

    <div style="text-align: center;">
        <h2>Halo, {{ auth()->user()->username }} ({{ auth()->user()->role }})</h2>
        <p>Selamat datang di sistem kasir laundry!</p>
    </div>

    <div class="d-flex gap-4 mb-4">
    <div class="bg-light p-3 rounded flex-fill text-center border">
        <div class="text-muted small">Total Pesanan</div>
        <div class="fs-4 fw-semibold text-primary">{{ $totalPesanan }}</div>
    </div>
    <div class="bg-light p-3 rounded flex-fill text-center border">
        <div class="text-muted small">Status Selesai</div>
        <div class="fs-4 fw-semibold text-success">{{ $totalSelesai }}</div>
    </div>
</div>
<hr>

    <div class="container">
        <h2>Daftar Pesanan</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <a href="{{ route('pesanan.create') }}" class="btn btn-primary mb-3">Tambah Pesanan</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Pelanggan</th>
                    <th>Layanan</th>
                    <th>Berat (kg)</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesanans as $pesanan)
                <tr>
                    <td>{{ $pesanan->pelanggan->nama }}</td>
                    <td>{{ $pesanan->layanan->nama_layanan ?? '-' }}</td>
                    <td>{{ $pesanan->berat }}</td>
                    <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('pesanan.update.status', $pesanan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()">
                                <option value="Diproses" {{ $pesanan->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="Selesai" {{ $pesanan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="Diambil" {{ $pesanan->status == 'Diambil' ? 'selected' : '' }}>Diambil</option>
                            </select>
                        </form>
                    </td>
                    <td>{{ $pesanan->tanggal_pesanan }}</td>
                    <td>
                        <a href="{{ route('pesanan.cetak', $pesanan->id) }}" class="btn btn-sm btn-info" target="_blank">Cetak</a>
                        <form action="{{ route('pesanan.destroy', $pesanan->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus pesanan?')" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
