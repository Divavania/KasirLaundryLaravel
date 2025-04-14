@extends('layouts.app')

@section('content')
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
@endsection
