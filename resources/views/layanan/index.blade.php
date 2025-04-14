@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Kelola Layanan</h2>
        <a href="{{ route('layanan.create') }}" class="btn btn-primary mb-3">Tambah Layanan</a>
        <table class="table">
            <thead>
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
                            <a href="{{ route('layanan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('layanan.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
