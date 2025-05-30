@extends('layouts.layout')

@section('title', 'Kelola Pelanggan - Khalifah Laundry')

@section('pelanggan-active', 'active')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0 text-success">Kelola Pelanggan</h1>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <!-- Pelanggan Management Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Pelanggan</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <button class="btn btn-success" data-toggle="modal" data-target="#tambahPelangganModal">
                            <i class="fas fa-plus mr-1"></i> Tambah Pelanggan
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-success">
                                <tr>
                                    <th>Nama</th>
                                    <th>No HP</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pelanggan as $item)
                                    <tr>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->no_hp }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-warning" data-toggle="modal" data-target="#editPelangganModal{{ $item->id }}" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger delete-pelanggan-btn" data-id="{{ $item->id }}" title="Hapus">
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

    <!-- Tambah Pelanggan Modal -->
    <div class="modal fade" id="tambahPelangganModal" tabindex="-1" role="dialog" aria-labelledby="tambahPelangganModalLabel">
        <div class="modal-dialog" role="document">
            <form action="{{ route('pelanggan.store') }}" method="POST" id="tambahPelangganForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Tambah Pelanggan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No HP</label>
                            <input type="text" name="no_hp" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control" required></textarea>
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

    <!-- Edit Pelanggan Modals -->
    @foreach($pelanggan as $item)
        <div class="modal fade" id="editPelangganModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editPelangganModalLabel{{ $item->id }}">
            <div class="modal-dialog" role="document">
                <form action="{{ route('pelanggan.update', $item->id) }}" method="POST" class="edit-pelanggan-form" data-id="{{ $item->id }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title">Edit Pelanggan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" class="form-control" value="{{ $item->nama }}" required>
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No HP</label>
                                <input type="text" name="no_hp" class="form-control" value="{{ $item->no_hp }}" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" class="form-control" required>{{ $item->alamat }}</textarea>
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
        // Reusable function for handling form submissions
        function handleFormSubmission(form, modalId, successMessage) {
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                timeout: 10000
            }).done((response) => {
                console.log('Success:', response);
                if (modalId) $(`#${modalId}`).modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.success || successMessage,
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
                console.log('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: error.responseJSON?.error || 'Gagal memproses pelanggan. Silakan coba lagi.',
                    confirmButtonColor: '#28a745',
                    customClass: {
                        popup: 'swal2-custom',
                        title: 'swal2-title-custom',
                        content: 'swal2-content-custom'
                    }
                });
            });
        }

        // Add Pelanggan
        $('#tambahPelangganForm').on('submit', function(e) {
            e.preventDefault();
            handleFormSubmission($(this), 'tambahPelangganModal', 'Pelanggan berhasil ditambahkan.');
        });

        // Edit Pelanggan
        $('.edit-pelanggan-form').on('submit', function(e) {
            e.preventDefault();
            const modalId = `editPelangganModal${$(this).data('id')}`;
            handleFormSubmission($(this), modalId, 'Pelanggan berhasil diubah.');
        });

        // Delete Pelanggan
        $('.delete-pelanggan-btn').on('click', function() {
            const pelangganId = $(this).data('id');
            Swal.fire({
                title: 'Hapus Pelanggan',
                text: 'Apakah Anda yakin ingin menghapus pelanggan ini?',
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
                        url: '{{ route('pelanggan.destroy', '') }}/' + pelangganId,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        timeout: 10000
                    }).catch(error => {
                        Swal.showValidationMessage(
                            error.responseJSON?.error || 'Gagal menghapus pelanggan. Silakan coba lagi.'
                        );
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: result.value.success || 'Pelanggan berhasil dihapus.',
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
    });
    </script>
@endsection