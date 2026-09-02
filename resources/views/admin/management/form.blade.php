@extends('admin.layouts.app')
@section('page-title', isset($member) ? 'Edit Anggota' : 'Tambah Anggota Manajemen')
@section('breadcrumb') / <a href="{{ route('admin.management.index') }}">Manajemen</a> / {{ isset($member) ? 'Edit' : 'Tambah' }}@endsection

@section('content')
<form action="{{ isset($member) ? route('admin.management.update', $member) : route('admin.management.store') }}"
      method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($member)) @method('PUT') @endif

<div style="display:grid;grid-template-columns:1.4fr 1fr;gap:20px;align-items:start;">

    <div class="card">
        <div class="card-header">
            <h3>Data Anggota</h3>
            <a href="{{ route('admin.management.index') }}" class="btn btn-secondary btn-sm">← Kembali</a>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                <input type="text" name="nama" class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                       value="{{ old('nama', $member->nama ?? '') }}" required>
                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Jabatan <span class="required">*</span></label>
                <input type="text" name="jabatan" class="form-control {{ $errors->has('jabatan') ? 'is-invalid' : '' }}"
                       value="{{ old('jabatan', $member->jabatan ?? '') }}" required placeholder="Contoh: Direktur Utama">
                @error('jabatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Deskripsi / Bio Singkat</label>
                <textarea name="deskripsi" class="form-control" rows="4"
                          placeholder="Latar belakang, pengalaman, atau catatan singkat">{{ old('deskripsi', $member->deskripsi ?? '') }}</textarea>
            </div>
        </div>
    </div>

    <div style="display:flex;flex-direction:column;gap:20px;">
        <div class="card">
            <div class="card-header"><h3>Foto</h3></div>
            <div class="card-body" style="text-align:center;">
                @if(isset($member) && $member->foto)
                    <img src="{{ asset('storage/'.$member->foto) }}" alt="{{ $member->nama }}"
                         style="width:100px;height:100px;border-radius:50%;object-fit:cover;border:4px solid var(--border);margin-bottom:12px;">
                @else
                    <div style="width:100px;height:100px;border-radius:50%;background:linear-gradient(135deg,#e0f2fe,#bfdbfe);display:flex;align-items:center;justify-content:center;font-size:40px;font-weight:700;color:#1a3a6e;margin:0 auto 12px;">
                        {{ strtoupper(substr(old('nama', $member->nama ?? 'A'), 0, 1)) }}
                    </div>
                @endif
                <div class="form-group" style="text-align:left;">
                    <label class="form-label">Upload Foto</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                    <div class="form-hint">Format JPG/PNG. Maks 2MB. Disarankan foto formal persegi.</div>
                </div>
                <div class="form-group" style="text-align:left;">
                    <label class="form-label">Alt Text Foto</label>
                    <input type="text" name="foto_alt" class="form-control"
                           value="{{ old('foto_alt', $member->foto_alt ?? '') }}" placeholder="Foto [Nama], [Jabatan]">
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3>Pengaturan</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Urutan Tampil</label>
                    <input type="number" name="urutan" class="form-control"
                           value="{{ old('urutan', $member->urutan ?? 0) }}" min="0">
                    <div class="form-hint">0 = paling atas. Semakin kecil = semakin dulu ditampilkan.</div>
                </div>
                <div class="form-group" style="display:flex;align-items:center;gap:10px;">
                    <label class="toggle">
                        <input type="checkbox" name="is_active" value="1"
                               {{ old('is_active', $member->is_active ?? true) ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                    <label class="form-label" style="margin:0;">Tampilkan di website</label>
                </div>
            </div>
        </div>

        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-primary">💾 Simpan</button>
            <a href="{{ route('admin.management.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </div>
</div>
</form>
@endsection
