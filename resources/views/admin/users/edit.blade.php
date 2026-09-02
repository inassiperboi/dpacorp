@extends('admin.layouts.app')
@section('page-title', 'Edit User')
@section('breadcrumb') / <a href="{{ route('admin.users.index') }}">User</a> / Edit@endsection

@section('content')
<div class="card" style="max-width:600px;">
    <div class="card-header">
        <h3>✏️ Edit User: {{ $user->name }}</h3>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">← Kembali</a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group">
                <label class="form-label" for="name">Nama <span class="required">*</span></label>
                <input type="text" id="name" name="name" class="form-control"
                       value="{{ old('name', $user->name) }}" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="email">Email <span class="required">*</span></label>
                <input type="email" id="email" name="email" class="form-control"
                       value="{{ old('email', $user->email) }}" required>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Password Baru</label>
                <input type="text" id="password" name="password" class="form-control"
                       placeholder="Kosongkan jika tidak ingin mengubah">
                <div class="form-hint">Isi hanya jika ingin mengubah password. Password disimpan apa adanya.</div>
            </div>
            <div class="form-group">
                <label class="form-label" for="role">Role <span class="required">*</span></label>
                <select id="role" name="role" class="form-control form-select" required>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="editor" {{ $user->role === 'editor' ? 'selected' : '' }}>Editor</option>
                </select>
            </div>
            <div style="display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
