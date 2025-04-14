@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Admin</h2>
    <form method="POST" action="{{ route('admin.update', $admin->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Username</label>
            <input name="username" value="{{ $admin->username }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Password (kosongkan jika tidak diubah)</label>
            <input name="password" type="password" maxlength="8" class="form-control">
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="aktif" {{ $admin->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ $admin->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>
        <button class="btn btn-success">Update</button>
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
