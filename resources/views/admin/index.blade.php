@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-success">Kelola Admin</h2>

    <button class="btn btn-success mb-3" data-toggle="modal" data-target="#tambahAdminModal">Tambah Admin</button>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-success">
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
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editAdminModal{{ $admin->id }}">Edit</button>
                        <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus admin ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Tambah Admin -->
<div class="modal fade" id="tambahAdminModal" tabindex="-1" role="dialog" aria-labelledby="tambahAdminModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('admin.store') }}" method="POST">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="tambahAdminModalLabel">Tambah Admin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" name="username" class="form-control" required>
              </div>
              <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" required>
              </div>
              <div class="mb-3">
                  <label for="status" class="form-label">Status</label>
                  <select name="status" class="form-control" required>
                      <option value="aktif">Aktif</option>
                      <option value="nonaktif">Nonaktif</option>
                  </select>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
    </form>
  </div>
</div>

<!-- Modal Edit Admin untuk setiap admin -->
@foreach($admins as $admin)
<div class="modal fade" id="editAdminModal{{ $admin->id }}" tabindex="-1" role="dialog" aria-labelledby="editAdminModalLabel{{ $admin->id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('admin.update', $admin->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editAdminModalLabel{{ $admin->id }}">Edit Admin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" name="username" class="form-control" value="{{ $admin->username }}" required>
              </div>
              <div class="mb-3">
                  <label for="password" class="form-label">Password (kosongkan jika tidak diubah)</label>
                  <input type="password" name="password" class="form-control">
              </div>
              <div class="mb-3">
                  <label for="status" class="form-label">Status</label>
                  <select name="status" class="form-control" required>
                      <option value="aktif" {{ $admin->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                      <option value="nonaktif" {{ $admin->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                  </select>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </div>
        </div>
    </form>
  </div>
</div>
@endforeach
@endsection