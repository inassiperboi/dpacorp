@extends('admin.layouts.app')
@section('page-title', 'Tambah User')
@section('breadcrumb') / <a href="{{ route('admin.users.index') }}">User</a> / Tambah@endsection

@section('content')
<div class="card" style="max-width:600px;">
    <div class="card-header">
        <h3>+ Tambah User Baru</h3>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">← Kembali</a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="name">Nama <span class="required">*</span></label>
                <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                       value="{{ old('name') }}" placeholder="Nama lengkap" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="email">Email <span class="required">*</span></label>
                <input type="email" id="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                       value="{{ old('email') }}" placeholder="user@dpacorp.id" required>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Password <span class="required">*</span></label>
                <input type="text" id="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                       placeholder="Minimal 4 karakter" required>
                <div class="form-hint">Password disimpan apa adanya (tidak di-enkripsi).</div>
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="role">Role <span class="required">*</span></label>
                <select id="role" name="role" class="form-control form-select" required>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin (akses penuh)</option>
                    <option value="editor" {{ old('role') === 'editor' ? 'selected' : '' }}>Editor (tidak bisa hapus user)</option>
                </select>
            </div>
            <div style="display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary">Simpan User</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
