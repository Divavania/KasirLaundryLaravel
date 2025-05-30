@extends('layouts.layout')

@section('title', 'Dashboard - Khalifah Laundry')

@section('dashboard-active', 'active')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0 text-success">Dashboard</h1>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <!-- Stats Cards -->
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fas fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Pesanan</span>
                            <span class="info-box-number">{{ $totalPesanan }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fas fa-check-circle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Status Selesai</span>
                            <span class="info-box-number">{{ $totalSelesai }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Pesanan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard') }}" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari Pesanan" value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-success"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                    <button class="btn btn-success mb-3" data-toggle="modal" data-target="#tambahPesananModal">Tambah Pesanan</button>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-success">
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
                                @forelse($pesanans as $pesanan)
                                <tr>
                                    <td>{{ $pesanan->pelanggan->nama ?? 'Pelanggan Tidak Ditemukan' }}</td>
                                    <td>
                                        @if ($pesanan->layanan->isNotEmpty())
                                            {{ $pesanan->layanan->pluck('nama_layanan')->implode(', ') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ number_format($pesanan->layanan->sum('pivot.berat') ?? 0, 2, ',', '.') }}</td>
                                    <td>Rp {{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('pesanan.update.status', $pesanan->id) }}" method="POST" class="status-form">
                                            @csrf
                                            @method('PUT')
                                            <div class="btn-group btn-group-sm">
                                                <button type="submit" name="status" value="Diproses" class="btn {{ $pesanan->status == 'Diproses' ? 'btn-warning' : 'btn-outline-warning' }}" title="Diproses" aria-label="Ubah ke Diproses">
                                                    <i class="fas fa-spinner"></i>
                                                </button>
                                                <button type="submit" name="status" value="Selesai" class="btn {{ $pesanan->status == 'Selesai' ? 'btn-success' : 'btn-outline-success' }}" title="Selesai" aria-label="Ubah ke Selesai">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                <button type="submit" name="status" value="Diambil" class="btn {{ $pesanan->status == 'Diambil' ? 'btn-primary' : 'btn-outline-primary' }}" title="Diambil" aria-label="Ubah ke Diambil">
                                                    <i class="fas fa-shopping-bag"></i>
                                                </button>
                                            </div>
                                            <small class="d-block mt-1 {{ $pesanan->status == 'Diproses' ? 'text-warning' : ($pesanan->status == 'Selesai' ? 'text-success' : 'text-primary') }}">{{ $pesanan->status }}</small>
                                        </form>
                                    </td>
                                    <td>{{ $pesanan->tanggal_pesanan ?? '-' }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-danger delete-pesanan-btn" data-id="{{ $pesanan->id }}" title="Hapus" aria-label="Hapus Pesanan"><i class="fas fa-trash"></i></button>
                                            <button class="btn btn-info" data-toggle="modal" data-target="#detailPesananModal{{ $pesanan->id }}" title="Detail" aria-label="Lihat Detail"><i class="fas fa-eye"></i></button>
                                            <button class="btn btn-secondary" data-toggle="modal" data-target="#cetakNotaModal{{ $pesanan->id }}" title="Nota" aria-label="Cetak Nota"><i class="fas fa-file-invoice"></i></button>
                                            <button class="btn btn-success" data-toggle="modal" data-target="#cetakBuktiModal{{ $pesanan->id }}" title="Bukti" aria-label="Cetak Bukti"><i class="fas fa-receipt"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada pesanan ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tambah Pesanan Modal -->
    <div class="modal fade" id="tambahPesananModal" tabindex="-1" role="dialog" aria-labelledby="tambahPesananModalLabel">
        <div class="modal-dialog" role="document">
            <form action="{{ route('pesanan.store') }}" method="POST" id="tambahPesananForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Tambah Pesanan Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="pelanggan_id">Pilih Pelanggan</label>
                            <select name="pelanggan_id" class="select2 form-control" required>
                                <option value="" disabled selected>Cari Pelanggan...</option>
                                @foreach($pelanggan as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Pilih Layanan</label>
                            @forelse($layanan as $l)
                                <div class="form-check mb-2">
                                    <input type="checkbox" name="layanan_id[]" value="{{ $l->id }}" class="form-check-input layanan-checkbox" id="layanan-{{ $l->id }}">
                                    <label class="form-check-label" for="layanan-{{ $l->id }}">
                                        {{ $l->nama_layanan }} (Rp {{ number_format($l->harga_per_kg, 0, ',', '.') }}/kg)
                                    </label>
                                    <input type="number" name="berat[{{ $l->id }}]" class="form-control mt-1 berat-input" id="berat-{{ $l->id }}" placeholder="Berat (kg)" step="0.01" min="0" disabled>
                                </div>
                            @empty
                                <p>Tidak ada layanan tersedia.</p>
                            @endforelse
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

    <!-- Detail, Nota, and Bukti Modals -->
    @foreach($pesanans as $pesanan)
    <div class="modal fade" id="detailPesananModal{{ $pesanan->id }}" tabindex="-1" role="dialog" aria-labelledby="detailPesananModalLabel{{ $pesanan->id }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Detail Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama Pelanggan:</strong> {{ $pesanan->pelanggan->nama ?? 'Pelanggan Tidak Ditemukan' }}</p>
                    <p><strong>No. HP:</strong> {{ $pesanan->pelanggan->no_hp ?? '-' }}</p>
                    <p><strong>Alamat:</strong> {{ $pesanan->pelanggan->alamat ?? '-' }}</p>
                    <p><strong>Layanan:</strong> {{ $pesanan->layanan->pluck('nama_layanan')->implode(', ') ?: '-' }}</p>
                    <p><strong>Berat (kg):</strong> {{ number_format($pesanan->layanan->sum('pivot.berat') ?? 0, 2, ',', '.') }}</p>
                    <p><strong>Total Harga:</strong> Rp {{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}</p>
                    <p><strong>Status:</strong> {{ $pesanan->status ?? '-' }}</p>
                    <p><strong>Tanggal Pesanan:</strong> {{ $pesanan->tanggal_pesanan ?? '-' }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cetakNotaModal{{ $pesanan->id }}" tabindex="-1" role="dialog" aria-labelledby="cetakNotaModalLabel{{ $pesanan->id }}">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Nota Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="notaContent{{ $pesanan->id }}">
                    <div style="text-align: center;">
                        <h5>Khalifah Laundry</h5>
                        <p>Kiringan<br>Telp: 0812-xxxx-xxxx</p>
                    </div>
                    <hr>
                    <p><strong>Nama:</strong> {{ $pesanan->pelanggan->nama ?? 'Pelanggan Tidak Ditemukan' }}</p>
                    <p><strong>No. HP:</strong> {{ $pesanan->pelanggan->no_hp ?? '-' }}</p>
                    <p><strong>Alamat:</strong> {{ $pesanan->pelanggan->alamat ?? '-' }}</p>
                    <p><strong>Layanan:</strong> {{ $pesanan->layanan->pluck('nama_layanan')->implode(', ') ?: '-' }}</p>
                    <p><strong>Berat:</strong> {{ number_format($pesanan->layanan->sum('pivot.berat') ?? 0, 2, ',', '.') }} kg</p>
                    <p><strong>Total:</strong> Rp {{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}</p>
                    <p><strong>Tanggal:</strong> {{ $pesanan->tanggal_pesanan ?? '-' }}</p>
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

    <div class="modal fade" id="cetakBuktiModal{{ $pesanan->id }}" tabindex="-1" role="dialog" aria-labelledby="cetakBuktiModalLabel{{ $pesanan->id }}">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Bukti Penerimaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="buktiContent{{ $pesanan->id }}">
                    <div style="text-align: center;">
                        <h5>Khalifah Laundry</h5>
                        <p>Bukti Penerimaan</p>
                    </div>
                    <hr>
                    <p><strong>Nama:</strong> {{ $pesanan->pelanggan->nama ?? 'Pelanggan Tidak Ditemukan' }}</p>
                    <p><strong>No. HP:</strong> {{ $pesanan->pelanggan->no_hp ?? '-' }}</p>
                    <p><strong>Alamat:</strong> {{ $pesanan->pelanggan->alamat ?? '-' }}</p>
                    <p><strong>Layanan:</strong> {{ $pesanan->layanan->pluck('nama_layanan')->implode(', ') ?: '-' }}</p>
                    <p><strong>Berat:</strong> {{ number_format($pesanan->layanan->sum('pivot.berat') ?? 0, 2, ',', '.') }} kg</p>
                    <p><strong>Status:</strong> {{ $pesanan->status ?? '-' }}</p>
                    <p><strong>Tanggal:</strong> {{ $pesanan->tanggal_pesanan ?? '-' }}</p>
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
    @endforeach
@endsection

@section('scripts')
    <script>
    $(document).ready(function() {
        // Initialize Select2 for customer dropdown
        $('.select2').select2({
            placeholder: "Cari Pelanggan...",
            allowClear: true,
            dropdownParent: $('#tambahPesananModal'),
            width: '100%'
        });

        // Enable/disable weight input based on service checkbox
        $('.layanan-checkbox').on('change', function() {
            var layananId = $(this).val();
            var beratInput = $('#berat-' + layananId);
            if ($(this).is(':checked')) {
                beratInput.prop('disabled', false);
            } else {
                beratInput.prop('disabled', true).val('');
            }
        });

        // Reset form when modal is closed
        $('#tambahPesananModal').on('hidden.bs.modal', function() {
            $('.layanan-checkbox').prop('checked', false);
            $('.berat-input').prop('disabled', true).val('');
            $('.select2').val(null).trigger('change');
        });

        // Delete Pesanan
        $('.delete-pesanan-btn').on('click', function() {
            const pesananId = $(this).data('id');
            Swal.fire({
                title: 'Hapus Pesanan',
                text: 'Apakah Anda yakin ingin menghapus pesanan ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'swal2-custom',
                    title: 'swal2-title-custom',
                    content: 'swal2-content-custom'
                },
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return $.ajax({
                        url: '{{ route('pesanan.destroy', '') }}/' + pesananId,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        timeout: 10000
                    }).catch(error => {
                        Swal.showValidationMessage(
                            error.responseJSON?.error || 'Gagal menghapus pesanan. Silakan coba lagi.'
                        );
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: result.value.success || 'Pesanan berhasil dihapus.',
                        confirmButtonColor: '#28a745',
                        customClass: {
                            popup: 'swal2-custom',
                            title: 'swal2-title-custom',
                            content: 'swal2-content-custom'
                        }
                    }).then(() => {
                        location.reload();
                    });
                }
            });
        });

        // Session-based alerts
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#28a745',
                customClass: {
                    popup: 'swal2-custom',
                    title: 'swal2-title-custom',
                    content: 'swal2-content-custom'
                }
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#dc3545',
                customClass: {
                    popup: 'swal2-custom',
                    title: 'swal2-title-custom',
                    content: 'swal2-content-custom'
                }
            });
        @endif

        @if ($searchNotFound)
            Swal.fire({
                icon: 'warning',
                title: 'Pencarian Tidak Ditemukan',
                text: 'Tidak ada nama pelanggan dengan pencarian Anda.',
                confirmButtonColor: '#6c757d',
                customClass: {
                    popup: 'swal2-custom',
                    title: 'swal2-title-custom',
                    content: 'swal2-content-custom'
                }
            });
        @endif
    });

    // Print Nota
    function printNota(pesananId) {
        var printContents = document.getElementById('notaContent' + pesananId).innerHTML;
        var newWindow = window.open('', '', 'width=600,height=600');
        newWindow.document.write('<html><head><title>Nota Pesanan</title><style>@media print { body { font-size: 12px; } p { margin: 5px 0; } }</style></head><body>');
        newWindow.document.write(printContents);
        newWindow.document.write('</body></html>');
        newWindow.document.close();
        newWindow.print();
    }

    // Print Bukti
    function printBukti(pesananId) {
        var printContents = document.getElementById('buktiContent' + pesananId).innerHTML;
        var newWindow = window.open('', '', 'width=600,height=600');
        newWindow.document.write('<html><head><title>Bukti Penerimaan</title><style>@media print { body { font-size: 12px; } p { margin: 5px 0; } }</style></head><body>');
        newWindow.document.write(printContents);
        newWindow.document.write('</body></html>');
        newWindow.document.close();
        newWindow.print();
    }
    </script>
@endsection