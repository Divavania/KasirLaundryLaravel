@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Pesanan</h2>
        <form action="{{ route('pesanan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="pelanggan_id">Pelanggan</label>
                <select name="pelanggan_id" id="pelanggan_id" class="form-control" required>
                    <option value="">Pilih Pelanggan</option>
                    @foreach ($pelanggans as $pelanggan)
                        <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="layanan_id">Layanan</label>
                <select name="layanan_id" id="layanan_id" class="form-control" required>
                    <option value="">Pilih Layanan</option>
                    @foreach ($layanans as $layanan)
                        <option value="{{ $layanan->id }}" data-harga="{{ $layanan->harga_per_kg }}">
                            {{ $layanan->nama_layanan }} - Rp {{ number_format($layanan->harga_per_kg, 0, ',', '.') }} per kg
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="berat">Berat (Kg)</label>
                <input type="number" step="0.01" name="berat" id="berat" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="total_harga">Total Harga</label>
                <input type="text" name="total_harga" id="total_harga" class="form-control" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <script>
        // Fungsi untuk menghitung total harga
        function hitungTotalHarga() {
            var layanan = document.getElementById('layanan_id');
            var berat = document.getElementById('berat').value;
            var hargaPerKg = layanan.options[layanan.selectedIndex].getAttribute('data-harga');
            var totalHarga = berat * hargaPerKg;
            document.getElementById('total_harga').value = totalHarga.toFixed(0); // Format tanpa desimal
        }

        // Menjalankan hitungTotalHarga ketika layanan atau berat berubah
        document.getElementById('layanan_id').addEventListener('change', hitungTotalHarga);
        document.getElementById('berat').addEventListener('input', hitungTotalHarga);
    </script>
@endsection
