@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Layanan</h2>
        <form action="{{ route('layanan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama_layanan">Nama Layanan</label>
                <input type="text" class="form-control" id="nama_layanan" name="nama_layanan" required>
            </div>
            <div class="form-group">
                <label for="harga_per_kg">Harga Per Kg</label>
                <input type="number" class="form-control" id="harga_per_kg" name="harga_per_kg" required step="0.01">
            </div>
            <button type="submit" class="btn btn-success mt-3">Simpan</button>
        </form>
    </div>
@endsection
