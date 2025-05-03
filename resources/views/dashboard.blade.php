<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <div style="text-align: center;">
        <h2>Halo, {{ auth()->user()->username }} ({{ auth()->user()->role }})</h2>
        <p>Selamat datang di sistem kasir laundry!</p>
    </div>

    <div class="row justify-content-center mb-4">
        <!-- Total Pesanan -->
        <div class="col-10 col-sm-6 col-md-4 col-lg-3 p-3 mx-2 rounded text-center border border-dark shadow-sm mb-3 mb-md-0" style="background: linear-gradient(to bottom right, #e8f5e9, #ffffff); font-family: 'Poppins', sans-serif;">
            <div class="text-dark small">Total Pesanan</div>
            <div class="fs-5 fw-semibold text-dark">{{ $totalPesanan }}</div>
        </div>
        <!-- Status Selesai -->
        <div class="col-10 col-sm-6 col-md-4 col-lg-3 p-3 mx-2 rounded text-center border border-dark shadow-sm mb-3 mb-md-0" style="background: linear-gradient(to bottom right, #e8f5e9, #ffffff); font-family: 'Poppins', sans-serif;">
            <div class="text-dark small">Status Selesai</div>
            <div class="fs-5 fw-semibold text-dark">{{ $totalSelesai }}</div>
        </div>
    </div>
    <hr>

    <div class="container">
        <h2 class="text-success">Daftar Pesanan</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <!-- Form Pencarian -->
        <form action="{{ route('dashboard') }}" method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari Pesanan" value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success">Cari</button>
                </div>
            </div>
        </form>

        <!-- Tombol untuk membuka modal tambah pesanan -->
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahPesananModal">Tambah Pesanan</button>

        <div style="overflow-x: auto;">
            <table class="table table-bordered">
                <thead class="table-success">
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
                        <td style="min-width: 180px;">
                            <div class="d-flex flex-wrap justify-content-center gap-2">
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapusPesananModal{{ $pesanan->id }}">Hapus</button>
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailPesananModal{{ $pesanan->id }}">Detail</button>
                                <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#cetakNotaModal{{ $pesanan->id }}">Nota</button>
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#cetakBuktiModal{{ $pesanan->id }}">Bukti</button>
                            </div>
                        </td>                                     
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal untuk Tambah Pesanan -->
    <div class="modal fade" id="tambahPesananModal" tabindex="-1" aria-labelledby="tambahPesananModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('pesanan.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="tambahPesananModalLabel">Tambah Pesanan Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Pilih Pelanggan -->
                        <div class="mb-3">
                            <label for="pelanggan_id" class="form-label">Pilih Pelanggan</label>
                            <select name="pelanggan_id" class="select2 form-control" style="width: 100%;" required>
                            <option></option>      {{-- placeholder kosong --}}
                            @foreach($pelanggan as $p)
                                <option value="{{ $p->id }}">{{ $p->nama }}</option>
                            @endforeach
                            </select>
                        </div>
                        <!-- Pilih Layanan -->
                        <div class="mb-3">
                            <label for="layanan_id" class="form-label">Pilih Layanan</label>
                            <select name="layanan_id" class="form-control" required>
                                @foreach($layanan as $l)
                                    <option value="{{ $l->id }}">{{ $l->nama_layanan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Berat Cucian -->
                        <div class="mb-3">
                            <label for="berat" class="form-label">Berat (kg)</label>
                            <input type="number" class="form-control" name="berat" required step="0.01" min="0">
                        </div>
                        <!-- Harga -->
                        <div class="mb-3">
                            <label for="total_harga" class="form-label">Total Harga</label>
                            <input type="number" class="form-control" name="total_harga" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Detail Pesanan -->
    @foreach($pesanans as $pesanan)
    <div class="modal fade" id="detailPesananModal{{ $pesanan->id }}" tabindex="-1" aria-labelledby="detailPesananModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="detailPesananModalLabel">Detail Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Pelanggan:</strong> {{ $pesanan->pelanggan->nama }}</p>
                    <p><strong>Layanan:</strong> {{ $pesanan->layanan->nama_layanan ?? '-' }}</p>
                    <p><strong>Berat (kg):</strong> {{ $pesanan->berat }}</p>
                    <p><strong>Total Harga:</strong> Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                    <p><strong>Status:</strong> {{ $pesanan->status }}</p>
                    <p><strong>Tanggal Pesanan:</strong> {{ $pesanan->tanggal_pesanan }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cetak Nota -->
    <div class="modal fade" id="cetakNotaModal{{ $pesanan->id }}" tabindex="-1" aria-labelledby="cetakNotaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="cetakNotaModalLabel">Nota Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body" id="notaContent{{ $pesanan->id }}">
                    <div style="text-align: center;">
                        <h5>Khalifah Laundry</h5>
                        <p>Kiringan<br>Telp: 0812-xxxx-xxxx</p>
                    </div>
                    <hr>
                    <p><strong>Nama:</strong> {{ $pesanan->pelanggan->nama }}</p>
                    <p><strong>Layanan:</strong> {{ $pesanan->layanan->nama_layanan }}</p>
                    <p><strong>Berat:</strong> {{ $pesanan->berat }} kg</p>
                    <p><strong>Total:</strong> Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                    <p><strong>Tanggal:</strong> {{ $pesanan->tanggal_pesanan }}</p>
                    <hr>
                    <p style="text-align: center;">Terima kasih telah menggunakan jasa kami</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button class="btn btn-success" onclick="printNota({{ $pesanan->id }})">Cetak</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cetak Bukti Penerimaan -->
    <div class="modal fade" id="cetakBuktiModal{{ $pesanan->id }}" tabindex="-1" aria-labelledby="cetakBuktiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="cetakBuktiModalLabel">Bukti Penerimaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body" id="buktiContent{{ $pesanan->id }}">
                    <div style="text-align: center;">
                        <h5>Khalifah Laundry</h5>
                        <p>Bukti Penerimaan</p>
                    </div>
                    <hr>
                    <p><strong>Nama:</strong> {{ $pesanan->pelanggan->nama }}</p>
                    <p><strong>Layanan:</strong> {{ $pesanan->layanan->nama_layanan }}</p>
                    <p><strong>Berat:</strong> {{ $pesanan->berat }} kg</p>
                    <p><strong>Status:</strong> {{ $pesanan->status }}</p>
                    <p><strong>Tanggal:</strong> {{ $pesanan->tanggal_pesanan }}</p>
                    <hr>
                    <p style="text-align: center;">Silakan simpan bukti ini untuk pengambilan</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button class="btn btn-success" onclick="printBukti({{ $pesanan->id }})">Cetak</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Pesanan -->
    <div class="modal fade" id="hapusPesananModal{{ $pesanan->id }}" tabindex="-1" aria-labelledby="hapusPesananModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('pesanan.destroy', $pesanan->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="hapusPesananModalLabel">Hapus Pesanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus pesanan ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const beratInput = document.querySelector('input[name="berat"]');
        const totalHargaInput = document.querySelector('input[name="total_harga"]');
        
        // Harga per kg. Contoh 12000. Ini HARUS sesuai layanan yang dipilih.
        const hargaPerKg = 4000; // sementara manual, nanti bisa dinamis

        beratInput.addEventListener('input', function () {
            const berat = parseFloat(beratInput.value) || 0;
            const totalHarga = berat * hargaPerKg;
            totalHargaInput.value = totalHarga;
        });
    });
    </script>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function printNota(id) {
            let content = document.getElementById('notaContent' + id).innerHTML;
            let printWindow = window.open('', '', 'width=300,height=600');
            printWindow.document.write('<html><head><title>Cetak Nota</title></head><body onload="window.print()">' + content + '</body></html>');
            printWindow.document.close();
        }
    
        function printBukti(id) {
            let content = document.getElementById('buktiContent' + id).innerHTML;
            let printWindow = window.open('', '', 'width=300,height=600');
            printWindow.document.write('<html><head><title>Cetak Bukti</title></head><body onload="window.print()">' + content + '</body></html>');
            printWindow.document.close();
        }
    </script>
    @endsection
</body>
</html>
