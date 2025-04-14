<!DOCTYPE html>
<html>
<head>
    <title>Nota Pesanan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        .nota { width: 300px; margin: auto; border: 1px dashed #000; padding: 10px; }
        .nota h3 { text-align: center; margin-bottom: 20px; }
        .nota table { width: 100%; }
    </style>
</head>
<body>
    <div class="nota">
        <h3>Nota Laundry</h3>
        <p><strong>Nama:</strong> {{ $pesanan->pelanggan->nama }}</p>
        <p><strong>No HP:</strong> {{ $pesanan->pelanggan->no_hp }}</p>
        <p><strong>Layanan:</strong> {{ $pesanan->layanan->nama_layanan ?? '-' }}</p>
        <p><strong>Berat:</strong> {{ $pesanan->berat }} kg</p>
        <p><strong>Total Harga:</strong> Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
        <p><strong>Status:</strong> {{ $pesanan->status }}</p>
        <p><strong>Tanggal:</strong> {{ $pesanan->tanggal_pesanan }}</p>
        <hr>
        <p style="text-align: center;">Terima kasih 😊</p>
        <script>
            window.onload = function() {
                window.print();
            }
        </script>
    </div>
</body>
</html>
