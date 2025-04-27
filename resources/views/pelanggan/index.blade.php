@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-success">Kelola Pelanggan</h2>

    <!-- Tombol tambah pelanggan -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahPelangganModal">
        Tambah Pelanggan
    </button>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tabel Pelanggan -->
    <table class="table table-bordered">
        <thead class="table-success">
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
                        <!-- Tombol Edit -->
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPelangganModal{{ $item->id }}">
                            Edit
                        </button>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('pelanggan.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Tambah Pelanggan -->
<div class="modal fade" id="tambahPelangganModal" tabindex="-1" aria-labelledby="tambahPelangganModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('pelanggan.store') }}" method="POST">
        @csrf
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title" id="tambahPelangganModalLabel">Tambah Pelanggan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
              <div class="mb-3">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" name="nama" class="form-control" required>
              </div>
              <div class="mb-3">
                  <label for="no_hp" class="form-label">No HP</label>
                  <input type="text" name="no_hp" class="form-control" required>
              </div>
              <div class="mb-3">
                  <label for="alamat" class="form-label">Alamat</label>
                  <textarea name="alamat" class="form-control" required></textarea>
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

<!-- Modal Edit Pelanggan (satu untuk tiap pelanggan) -->
@foreach($pelanggan as $item)
<div class="modal fade" id="editPelangganModal{{ $item->id }}" tabindex="-1" aria-labelledby="editPelangganModalLabel{{ $item->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('pelanggan.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title" id="editPelangganModalLabel{{ $item->id }}">Edit Pelanggan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
              <div class="mb-3">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" name="nama" class="form-control" value="{{ $item->nama }}" required>
              </div>
              <div class="mb-3">
                  <label for="no_hp" class="form-label">No HP</label>
                  <input type="text" name="no_hp" class="form-control" value="{{ $item->no_hp }}" required>
              </div>
              <div class="mb-3">
                  <label for="alamat" class="form-label">Alamat</label>
                  <textarea name="alamat" class="form-control" required>{{ $item->alamat }}</textarea>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
          </div>
        </div>
    </form>
  </div>
</div>
@endforeach

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
