@extends('layouts.layout')

@section('title', 'Kelola Layanan - Khalifah Laundry')

@section('layanan-active', 'active')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0 text-success">Kelola Layanan</h1>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <!-- Layanan Management Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Layanan</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <button class="btn btn-success" data-toggle="modal" data-target="#tambahLayananModal">
                            <i class="fas fa-plus mr-1"></i> Tambah Layanan
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-success">
                                <tr>
                                    <th>Nama Layanan</th>
                                    <th>Harga Per Kg</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($layanan as $item)
                                    <tr>
                                        <td>{{ $item->nama_layanan }}</td>
                                        <td>Rp {{ number_format($item->harga_per_kg, 0, ',', '.') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-warning" data-toggle="modal" data-target="#editLayananModal{{ $item->id }}" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger delete-layanan-btn" data-id="{{ $item->id }}" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tambah Layanan Modal -->
    <div class="modal fade" id="tambahLayananModal" tabindex="-1" role="dialog" aria-labelledby="tambahLayananModalLabel">
        <div class="modal-dialog" role="document">
            <form action="{{ route('layanan.store') }}" method="POST" id="tambahLayananForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Tambah Layanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_layanan">Nama Layanan</label>
                            <input type="text" name="nama_layanan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="harga_per_kg">Harga Per Kg</label>
                            <input type="number" name="harga_per_kg" class="form-control" required>
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

    <!-- Edit Layanan Modals -->
    @foreach($layanan as $item)
        <div class="modal fade" id="editLayananModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editLayananModalLabel{{ $item->id }}">
            <div class="modal-dialog" role="document">
                <form action="{{ route('layanan.update', $item->id) }}" method="POST" class="edit-layanan-form" data-id="{{ $item->id }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title">Edit Layanan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_layanan">Nama Layanan</label>
                                <input type="text" name="nama_layanan" class="form-control" value="{{ $item->nama_layanan }}" required>
                            </div>
                            <div class="form-group">
                                <label for="harga_per_kg">Harga Per Kg</label>
                                <input type="number" name="harga_per_kg" class="form-control" value="{{ $item->harga_per_kg }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection

@section('scripts')
    <script>
    $(document).ready(function() {
        // Delete Layanan Alert
        $('.delete-layanan-btn').on('click', function() {
            const layananId = $(this).data('id');
            Swal.fire({
                title: 'Hapus Layanan',
                text: 'Apakah Anda yakin ingin menghapus layanan ini?',
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
                        url: '{{ route('layanan.destroy', '') }}/' + layananId,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        timeout: 10000
                    }).catch(error => {
                        Swal.showValidationMessage(
                            error.responseJSON?.error || 'Gagal menghapus layanan. Silakan coba lagi.'
                        );
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: result.value.success || 'Layanan berhasil dihapus.',
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

        // Tambah Layanan Alert (After Save)
        $('#tambahLayananForm').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                timeout: 10000
            }).done((response) => {
                console.log('Tambah Layanan Success:', response); // Debugging
                $('#tambahLayananModal').modal('hide'); // Close modal
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.success || 'Layanan berhasil ditambahkan.',
                    confirmButtonColor: '#28a745',
                    customClass: {
                        popup: 'swal2-custom',
                        title: 'swal2-title-custom',
                        content: 'swal2-content-custom'
                    }
                }).then(() => {
                    location.reload();
                });
            }).fail((error) => {
                console.log('Tambah Layanan Error:', error); // Debugging
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: error.responseJSON?.error || 'Gagal menambah layanan. Silakan coba lagi.',
                    confirmButtonColor: '#28a745',
                    customClass: {
                        popup: 'swal2-custom',
                        title: 'swal2-title-custom',
                        content: 'swal2-content-custom'
                    }
                });
            });
        });

        // Edit Layanan Alert (After Save)
        $('.edit-layanan-form').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const layananId = form.data('id'); // Get ID from data-id attribute
            $.ajax({
                url: form.attr('action'),
                type: 'POST', // Handle Laravel's _method for PUT
                data: form.serialize(),
                timeout: 10000
            }).done((response) => {
                console.log('Edit Layanan Success:', response); // Debugging
                $(`#editLayananModal${layananId}`).modal('hide'); // Close specific modal
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.success || 'Layanan berhasil diubah.',
                    confirmButtonColor: '#28a745',
                    customClass: {
                        popup: 'swal2-custom',
                        title: 'swal2-title-custom',
                        content: 'swal2-content-custom'
                    }
                }).then(() => {
                    location.reload();
                });
            }).fail((error) => {
                console.log('Edit Layanan Error:', error); // Debugging
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: error.responseJSON?.error || 'Gagal mengedit layanan. Silakan coba lagi.',
                    confirmButtonColor: '#28a745',
                    customClass: {
                        popup: 'swal2-custom',
                        title: 'swal2-title-custom',
                        content: 'swal2-content-custom'
                    }
                });
            });
        });
    });
    </script>
@endsection