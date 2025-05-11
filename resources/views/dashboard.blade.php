<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e8f5e9, #f5f5f5);
            font-family: 'Poppins', sans-serif;
            position: relative;
            min-height: 100vh;
            padding-bottom: 2rem;
            overflow-x: hidden;
        }
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><circle cx="30" cy="30" r="20" fill="rgba(40,167,69,0.1)"/><circle cx="170" cy="50" r="15" fill="rgba(40,167,69,0.15)"/><circle cx="100" cy="150" r="25" fill="rgba(40,167,69,0.1)"/><circle cx="50" cy="100" r="10" fill="rgba(40,167,69,0.2)"/></svg>');
            background-size: 400px;
            opacity: 0.25;
            z-index: -1;
            animation: float 25s infinite linear;
        }
        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-30px); }
            100% { transform: translateY(0); }
        }
        .welcome-card {
            background: #ffffff;
            border: 1px solid rgba(40, 167, 69, 0.2);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .welcome-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        .welcome-card::before {
            content: '\f7e4';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 40px;
            color: rgba(40, 167, 69, 0.15);
            opacity: 0.5;
        }
        .welcome-card h2::before {
            content: 'Khalifah Laundry';
            display: block;
            font-size: 1.2rem;
            font-weight: 600;
            color: #28a745;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .stats-card {
            background: #ffffff;
            border: 1px solid rgba(40, 167, 69, 0.2);
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }
        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: #28a745;
        }
        .stats-card .small {
            font-size: 0.9rem;
            color: #495057;
            font-weight: 400;
        }
        .stats-card .fs-5 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2e7d32;
        }
        .table-responsive {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 1rem;
        }
        .table-success {
            background: #e8f5e9 !important;
        }
        .table th, .table td {
            vertical-align: middle;
            font-size: 0.95rem;
        }
        .table th {
            font-weight: 600;
            color: #2e7d32;
        }
        .table tbody tr:hover {
            background: rgba(232, 245, 233, 0.5);
        }
        .btn-success {
            background: #28a745;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-success:hover {
            background: #2e7d32;
            box-shadow: 0 4px 10px rgba(46, 125, 50, 0.3);
            transform: translateY(-2px);
        }
        .btn-sm {
            border-radius: 6px;
        }
        .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }
        .modal-header.bg-success {
            background: #28a745;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        .modal-body {
            background: #ffffff;
            padding: 1.5rem;
        }
        .form-control, .select2-container--default .select2-selection--single {
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            background: #f8faf8;
            transition: all 0.3s ease;
        }
        .form-control:focus, .select2-container--default .select2-selection--single:focus {
            border-color: #2e7d32;
            box-shadow: 0 0 8px rgba(46, 125, 50, 0.2);
            background: #fff;
        }
        .form-control::placeholder {
            color: #999;
            font-weight: 300;
        }
        @media (max-width: 576px) {
            .welcome-card {
                padding: 1.5rem;
            }
            .welcome-card h2 {
                font-size: 1.5rem;
            }
            .welcome-card h2::before {
                font-size: 1rem;
            }
            .stats-card .fs-5 {
                font-size: 1.2rem;
            }
            .table th, .table td {
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    @extends('layouts.app')

    @section('content')
    <div class="d-flex justify-content-center mb-4">
        <div class="welcome-card" style="max-width: 500px; width: 90%; text-align: center;">
            <h2 class="mb-2 text-success" style="font-size: 1.75rem; font-weight: 500;">
                Halo, {{ auth()->user()->username }} 
                <span style="font-size: 1.1rem; font-weight: 400; color: #6c757d;">({{ auth()->user()->role }})</span>
            </h2>
            <p class="mb-0" style="font-size: 1rem; font-weight: 400; color: #495057;">Selamat datang di sistem kasir laundry</p>
        </div>
    </div>

    <div class="row justify-content-center mb-4">
        <div class="col-10 col-sm-6 col-md-4 col-lg-3 p-0 mx-2 mb-3 mb-md-0 stats-card">
            <div class="text-center p-3">
                <div class="small">Total Pesanan</div>
                <div class="fs-5 fw-semibold">{{ $totalPesanan }}</div>
            </div>
        </div>
        <div class="col-10 col-sm-6 col-md-4 col-lg-3 p-0 mx-2 mb-3 mb-md-0 stats-card">
            <div class="text-center p-3">
                <div class="small">Status Selesai</div>
                <div class="fs-5 fw-semibold">{{ $totalSelesai }}</div>
            </div>
        </div>
    </div>
    <hr>

    <div class="container">
        <h2 class="text-success mb-3">Daftar Pesanan</h2>

        <form action="{{ route('dashboard') }}" method="GET" class="mb-3">
            <div class="row d-flex align-items-center flex-wrap">
                <div class="col-8 col-md-4 mb-2 mb-md-0">
                    <input type="text" name="search" class="form-control w-100" placeholder="Cari Pesanan" value="{{ request('search') }}">
                </div>
                <div class="col-4 col-md-2">
                    <button type="submit" class="btn btn-success w-100 d-flex align-items-center justify-content-center" style="padding: 8px;">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#tambahPesananModal">Tambah Pesanan</button>

        <div class="table-responsive">
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
                        <td>
                            @if ($pesanan->layanan->isNotEmpty())
                                {{ $pesanan->layanan->pluck('nama_layanan')->implode(', ') }}
                            @else
                                -
                            @endif
                        </td>                        
                        <td>
                            {{ number_format($pesanan->layanan->sum('pivot.berat'), 2, ',', '.') }}
                        </td>
                        <td>
                            Rp {{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}
                        </td>
                        <td>
                            <form action="{{ route('pesanan.update.status', $pesanan->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="btn-group" role="group">
                                    <button type="submit" name="status" value="Diproses" class="btn btn-sm {{ $pesanan->status == 'Diproses' ? 'btn-warning' : 'btn-outline-warning' }}" title="Diproses: Pesanan sedang diproses">
                                        <i class="fas fa-spinner"></i>
                                    </button>
                                    <button type="submit" name="status" value="Selesai" class="btn btn-sm {{ $pesanan->status == 'Selesai' ? 'btn-success' : 'btn-outline-success' }}" title="Selesai: Pesanan telah selesai">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button type="submit" name="status" value="Diambil" class="btn btn-sm {{ $pesanan->status == 'Diambil' ? 'btn-primary' : 'btn-outline-primary' }}" title="Diambil: Pesanan telah diambil">
                                        <i class="fas fa-shopping-bag"></i>
                                    </button>
                                </div>
                                <span class="d-block d-md-none mt-1 small {{ $pesanan->status == 'Diproses' ? 'text-warning' : ($pesanan->status == 'Selesai' ? 'text-success' : 'text-primary') }}">
                                    {{ $pesanan->status }}
                                </span>
                            </form>
                        </td>
                        <td>{{ $pesanan->tanggal_pesanan }}</td>
                        <td style="min-width: 180px;">
                            <div class="d-flex flex-row justify-content-center align-items-center gap-1">
                                <button class="btn btn-sm btn-danger px-1 py-0" style="width: 28px; height: 28px;" data-toggle="modal" data-target="#hapusPesananModal{{ $pesanan->id }}" title="Hapus pesanan ini">
                                    <i class="fas fa-trash" style="font-size: 14px;"></i>
                                </button>
                                <button class="btn btn-sm btn-info px-1 py-0" style="width: 28px; height: 28px;" data-toggle="modal" data-target="#detailPesananModal{{ $pesanan->id }}" title="Lihat detail pesanan">
                                    <i class="fas fa-eye" style="font-size: 14px;"></i>
                                </button>
                                <button class="btn btn-sm btn-secondary px-1 py-0" style="width: 28px; height: 28px;" data-toggle="modal" data-target="#cetakNotaModal{{ $pesanan->id }}" title="Cetak nota pesanan">
                                    <i class="fas fa-file-invoice" style="font-size: 14px;"></i>
                                </button>
                                <button class="btn btn-sm btn-success px-1 py-0" style="width: 28px; height: 28px;" data-toggle="modal" data-target="#cetakBuktiModal{{ $pesanan->id }}" title="Cetak bukti penerimaan">
                                    <i class="fas fa-receipt" style="font-size: 14px;"></i>
                                </button>
                            </div>
                            <div class="d-flex flex-row justify-content-center align-items-center gap-1 d-block d-md-none mt-1 small">
                                <span class="text-danger text-center">Hapus</span>
                                <span class="text-info text-center">Detail</span>
                                <span class="text-secondary text-center">Nota</span>
                                <span class="text-success text-center">Bukti</span>
                            </div>
                        </td>                                     
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="tambahPesananModal" tabindex="-1" role="dialog" aria-labelledby="tambahPesananModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('pesanan.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="tambahPesananModalLabel">Tambah Pesanan Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="pelanggan_id" class="form-label">Pilih Pelanggan</label>
                            <select name="pelanggan_id" class="select2 form-control" style="width: 100%; border-color: #4caf50;" required>
                                <option></option>
                                @foreach($pelanggan as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="layanan" class="form-label">Pilih Layanan</label>
                            @foreach($layanan as $l)
                                <div class="form-check mb-2">
                                    <input type="checkbox" name="layanan_id[]" value="{{ $l->id }}" class="form-check-input layanan-checkbox" id="layanan-{{ $l->id }}" style="accent-color: #4caf50;">
                                    <label class="form-check-label" for="layanan-{{ $l->id }}">
                                        {{ $l->nama_layanan }} (Rp {{ number_format($l->harga_per_kg) }}/kg)
                                    </label>
                                    <input type="number" name="berat[{{ $l->id }}]" class="form-control mt-1 berat-input" id="berat-{{ $l->id }}" placeholder="Berat (kg)" step="0.01" style="width: 150px;" disabled>
                                </div>
                            @endforeach
                        </div>                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @foreach($pesanans as $pesanan)
    <div class="modal fade" id="detailPesananModal{{ $pesanan->id }}" tabindex="-1" role="dialog" aria-labelledby="detailPesananModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="detailPesananModalLabel">Detail Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama Pelanggan:</strong> {{ $pesanan->pelanggan->nama }}</p>
                    <p><strong>No. HP:</strong> {{ $pesanan->pelanggan->no_hp }}</p>
                    <p><strong>Alamat:</strong> {{ $pesanan->pelanggan->alamat }}</p>
                    <p><strong>Layanan:</strong> {{ $pesanan->layanan->pluck('nama_layanan')->implode(', ') ?: '-' }}</p>
                    <p><strong>Berat (kg):</strong> {{ number_format($pesanan->layanan->sum('pivot.berat'), 2, ',', '.') }}</p>
                    <p><strong>Total Harga:</strong> Rp {{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}</p>
                    <p><strong>Status:</strong> {{ $pesanan->status }}</p>
                    <p><strong>Tanggal Pesanan:</strong> {{ $pesanan->tanggal_pesanan }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cetakNotaModal{{ $pesanan->id }}" tabindex="-1" role="dialog" aria-labelledby="cetakNotaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="cetakNotaModalLabel">Nota Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="notaContent{{ $pesanan->id }}">
                    <div style="text-align: center;">
                        <h5>Khalifah Laundry</h5>
                        <p>Kiringan<br>Telp: 0812-xxxx-xxxx</p>
                    </div>
                    <hr>
                    <p><strong>Nama:</strong> {{ $pesanan->pelanggan->nama }}</p>
                    <p><strong>No. HP:</strong> {{ $pesanan->pelanggan->no_hp }}</p>
                    <p><strong>Alamat:</strong> {{ $pesanan->pelanggan->alamat }}</p>
                    <p><strong>Layanan:</strong> {{ $pesanan->layanan->pluck('nama_layanan')->implode(', ') ?: '-' }}</p>
                    <p><strong>Berat:</strong> {{ number_format($pesanan->layanan->sum('pivot.berat'), 2, ',', '.') }} kg</p>
                    <p><strong>Total:</strong> Rp {{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}</p>
                    <p><strong>Tanggal:</strong> {{ $pesanan->tanggal_pesanan }}</p>
                    <hr>
                    <p style="text-align: center;">Terima kasih telah menggunakan jasa kami</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-success" onclick="printNota({{ $pesanan->id }})">Cetak</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cetakBuktiModal{{ $pesanan->id }}" tabindex="-1" role="dialog" aria-labelledby="cetakBuktiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="cetakBuktiModalLabel">Bukti Penerimaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="buktiContent{{ $pesanan->id }}">
                    <div style="text-align: center;">
                        <h5>Khalifah Laundry</h5>
                        <p>Bukti Penerimaan</p>
                    </div>
                    <hr>
                    <p><strong>Nama:</strong> {{ $pesanan->pelanggan->nama }}</p>
                    <p><strong>No. HP:</strong> {{ $pesanan->pelanggan->no_hp }}</p>
                    <p><strong>Alamat:</strong> {{ $pesanan->pelanggan->alamat }}</p>
                    <p><strong>Layanan:</strong> {{ $pesanan->layanan->pluck('nama_layanan')->implode(', ') ?: '-' }}</p>
                    <p><strong>Berat:</strong> {{ number_format($pesanan->layanan->sum('pivot.berat'), 2, ',', '.') }} kg</p>
                    <p><strong>Status:</strong> {{ $pesanan->status }}</p>
                    <p><strong>Tanggal:</strong> {{ $pesanan->tanggal_pesanan }}</p>
                    <hr>
                    <p style="text-align: center;">Silakan simpan bukti ini untuk pengambilan</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-success" onclick="printBukti({{ $pesanan->id }})">Cetak</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hapusPesananModal{{ $pesanan->id }}" tabindex="-1" role="dialog" aria-labelledby="hapusPesananModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('pesanan.destroy', $pesanan->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="hapusPesananModalLabel">Hapus Pesanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body"><p>Apakah Anda yakin ingin menghapus pesanan ini?</p></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            if (typeof jQuery === 'undefined') {
                console.error('jQuery is not loaded!');
            } else {
                console.log('jQuery is loaded successfully');
            }

            $('.select2').select2({
                placeholder: "Cari Pelanggan...",
                allowClear: true,
                dropdownParent: $('#tambahPesananModal')
            });

            $('.layanan-checkbox').on('change', function() {
                var layananId = $(this).val();
                var beratInput = $('#berat-' + layananId);
                if ($(this).is(':checked')) {
                    beratInput.prop('disabled', false);
                } else {
                    beratInput.prop('disabled', true).val('');
                }
            });

            $('#tambahPesananModal').on('hidden.bs.modal', function() {
                $('.layanan-checkbox').prop('checked', false);
                $('.berat-input').prop('disabled', true).val('');
                $('.select2').val(null).trigger('change');
            });

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#28a745',
                    timer: 3000,
                    timerProgressBar: true
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#dc3545',
                    timer: 3000,
                    timerProgressBar: true
                });
            @endif
        });

        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus Pesanan',
                text: 'Apakah Anda yakin ingin menghapus pesanan ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('pesanan.destroy', '') }}/' + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.success || 'Pesanan berhasil dihapus.',
                                confirmButtonColor: '#28a745',
                                timer: 3000,
                                timerProgressBar: true
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: xhr.responseJSON?.error || 'Gagal menghapus pesanan.',
                                confirmButtonColor: '#dc3545',
                                timer: 3000,
                                timerProgressBar: true
                            });
                        }
                    });
                }
            });
        }

        function printNota(pesananId) {
            var printContents = document.getElementById('notaContent' + pesananId).innerHTML;
            var newWindow = window.open('', '', 'width=600,height=600');
            newWindow.document.write('<html><head><title>Nota Pesanan</title></head><body>');
            newWindow.document.write(printContents);
            newWindow.document.write('</body></html>');
            newWindow.document.close();
            newWindow.print();
        }

        function printBukti(pesananId) {
            var printContents = document.getElementById('buktiContent' + pesananId).innerHTML;
            var newWindow = window.open('', '', 'width=600,height=600');
            newWindow.document.write('<html><head><title>Bukti Penerimaan</title></head><body>');
            newWindow.document.write(printContents);
            newWindow.document.write('</body></html>');
            newWindow.document.close();
            newWindow.print();
        }
    </script>
    @endsection
</body>
</html>