@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-success">Kelola Layanan</h2>

    <!-- Tombol tambah layanan -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahLayananModal">Tambah Layanan</button>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tabel layanan -->
    <table class="table table-bordered">
        <thead class="table-success">
            <tr>
                <th>Nama Layanan</th>
                <th>Harga Per Kg</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($layanan as $item)
                <tr>
                    <td>{{ $item->nama_layanan }}</td>
                    <td>Rp {{ number_format($item->harga_per_kg, 0, ',', '.') }}</td>
                    <td>
                        <!-- Tombol Edit -->
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editLayananModal{{ $item->id }}">
                            Edit
                        </button>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('layanan.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus layanan ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Tambah Layanan -->
<div class="modal fade" id="tambahLayananModal" tabindex="-1" aria-labelledby="tambahLayananModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('layanan.store') }}" method="POST">
        @csrf
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title" id="tambahLayananModalLabel">Tambah Layanan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
              <div class="mb-3">
                  <label for="nama_layanan" class="form-label">Nama Layanan</label>
                  <input type="text" name="nama_layanan" class="form-control" required>
              </div>
              <div class="mb-3">
                  <label for="harga_per_kg" class="form-label">Harga Per Kg</label>
                  <input type="number" name="harga_per_kg" class="form-control" required>
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

<!-- Modal Edit Layanan (satu untuk tiap layanan) -->
@foreach ($layanan as $item)
<div class="modal fade" id="editLayananModal{{ $item->id }}" tabindex="-1" aria-labelledby="editLayananModalLabel{{ $item->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('layanan.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title" id="editLayananModalLabel{{ $item->id }}">Edit Layanan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
              <div class="mb-3">
                  <label for="nama_layanan" class="form-label">Nama Layanan</label>
                  <input type="text" name="nama_layanan" class="form-control" value="{{ $item->nama_layanan }}" required>
              </div>
              <div class="mb-3">
                  <label for="harga_per_kg" class="form-label">Harga Per Kg</label>
                  <input type="number" name="harga_per_kg" class="form-control" value="{{ $item->harga_per_kg }}" required>
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
