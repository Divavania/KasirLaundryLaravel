@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Admin</h2>
    <form method="POST" action="{{ route('admin.store') }}">
        @csrf
        <div class="form-group">
            <label>Username</label>
            <input name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Password (max 8 karakter)</label>
            <input name="password" type="password" maxlength="8" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
        </div>
        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
