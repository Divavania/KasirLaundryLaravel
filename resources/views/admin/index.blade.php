@extends('layouts.layout')

@section('title', 'Kelola Admin - Khalifah Laundry')

@section('admin-active', 'active')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0 text-success">Kelola Admin</h1>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <!-- Admin Management Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Admin</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <button class="btn btn-success" data-toggle="modal" data-target="#tambahAdminModal">
                            <i class="fas fa-plus mr-1"></i> Tambah Admin
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-success">
                                <tr>
                                    <th>Username</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($admins as $admin)
                                    <tr>
                                        <td>{{ $admin->username }}</td>
                                        <td>{{ ucfirst($admin->status) }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-warning" data-toggle="modal" data-target="#editAdminModal{{ $admin->id }}" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger delete-admin-btn" data-id="{{ $admin->id }}" title="Hapus">
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

    <!-- Tambah Admin Modal -->
    <div class="modal fade" id="tambahAdminModal" tabindex="-1" role="dialog" aria-labelledby="tambahAdminModalLabel">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.store') }}" method="POST" id="tambahAdminForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Tambah Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" required>
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
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

    <!-- Edit Admin Modals -->
    @foreach($admins as $admin)
        <div class="modal fade" id="editAdminModal{{ $admin->id }}" tabindex="-1" role="dialog" aria-labelledby="editAdminModalLabel{{ $admin->id }}">
            <div class="modal-dialog" role="document">
                <form action="{{ route('admin.update', $admin->id) }}" method="POST" class="edit-admin-form" data-id="{{ $admin->id }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title">Edit Admin</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" value="{{ $admin->username }}" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password (kosongkan jika tidak diubah)</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="aktif" {{ $admin->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ $admin->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
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
        // Delete Admin Alert
        $('.delete-admin-btn').on('click', function() {
            const adminId = $(this).data('id');
            Swal.fire({
                title: 'Hapus Admin',
                text: 'Apakah Anda yakin ingin menghapus admin ini?',
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
                        url: '{{ route('admin.destroy', '') }}/' + adminId,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        timeout: 10000
                    }).catch(error => {
                        Swal.showValidationMessage(
                            error.responseJSON?.error || 'Gagal menghapus admin. Silakan coba lagi.'
                        );
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: result.value.success || 'Admin berhasil dihapus.',
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

        // Tambah Admin Alert (After Save)
        $('#tambahAdminForm').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                timeout: 10000
            }).done((response) => {
                console.log('Tambah Admin Success:', response); // Debugging
                $('#tambahAdminModal').modal('hide'); // Close modal
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.success || 'Admin berhasil ditambahkan.',
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
                console.log('Tambah Admin Error:', error); // Debugging
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: error.responseJSON?.error || 'Gagal menambah admin. Silakan coba lagi.',
                    confirmButtonColor: '#28a745',
                    customClass: {
                        popup: 'swal2-custom',
                        title: 'swal2-title-custom',
                        content: 'swal2-content-custom'
                    }
                });
            });
        });

        // Edit Admin Alert (After Save)
        $('.edit-admin-form').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const adminId = form.data('id'); // Get ID from data-id attribute
            $.ajax({
                url: form.attr('action'),
                type: 'POST', // Handle Laravel's _method for PUT
                data: form.serialize(),
                timeout: 10000
            }).done((response) => {
                console.log('Edit Admin Success:', response); // Debugging
                $(`#editAdminModal${adminId}`).modal('hide'); // Close specific modal
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.success || 'Admin berhasil diubah.',
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
                console.log('Edit Admin Error:', error); // Debugging
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: error.responseJSON?.error || 'Gagal mengedit admin. Silakan coba lagi.',
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