@extends('admin.layouts.app')
@section('page-title', 'Struktur Manajemen')
@section('breadcrumb') / Struktur Manajemen@endsection

@section('content')
<div style="max-width:600px;">
    <form action="{{ route('admin.management.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header">
                <h3>Gambar Struktur Manajemen</h3>
            </div>
            <div class="card-body" style="text-align:center;">
                @if($structure->image)
                    <img src="{{ asset('storage/'.$structure->image) }}" alt="{{ $structure->image_alt }}"
                         style="max-width:100%;border-radius:12px;border:1px solid var(--border);margin-bottom:16px;">
                @else
                    <div style="padding:40px;background:var(--bg);border-radius:12px;color:var(--text-muted);margin-bottom:16px;">
                        Belum ada gambar struktur manajemen.
                    </div>
                @endif

                <div class="form-group" style="text-align:left;">
                    <label class="form-label">Upload / Ganti Gambar</label>
                    <input type="file" name="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" accept="image/*">
                    <div class="form-hint">Format JPG/PNG/WEBP, maks 4MB. Upload bagan/foto struktur manajemen dalam satu gambar.</div>
                    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group" style="text-align:left;">
                    <label class="form-label">Alt Text Gambar</label>
                    <input type="text" name="image_alt" class="form-control"
                           value="{{ old('image_alt', $structure->image_alt) }}" placeholder="Struktur Manajemen DPA Corp">
                </div>
            </div>
        </div>

        <div style="display:flex;gap:10px;margin-top:20px;">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection
