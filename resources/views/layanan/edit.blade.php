@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Layanan</h2>
        <form action="{{ route('layanan.update', $layanan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama_layanan">Nama Layanan</label>
                <input type="text" class="form-control" id="nama_layanan" name="nama_layanan" value="{{ $layanan->nama_layanan }}" required>
            </div>
            <div class="form-group">
                <label for="harga_per_kg">Harga Per Kg</label>
                <input type="number" class="form-control" id="harga_per_kg" name="harga_per_kg" value="{{ $layanan->harga_per_kg }}" required>
            </div>
            <button type="submit" class="btn btn-warning mt-3">Update</button>
        </form>
    </div>
@endsection
