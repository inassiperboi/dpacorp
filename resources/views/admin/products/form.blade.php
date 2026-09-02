@extends('admin.layouts.app')
@section('page-title', isset($product) ? 'Edit Produk' : 'Tambah Produk')
@section('breadcrumb') / <a href="{{ route('admin.products.index') }}">Produk</a> / {{ isset($product) ? 'Edit' : 'Tambah' }}@endsection

@section('content')
<form action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}"
      method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($product)) @method('PUT') @endif

<div style="display:grid;grid-template-columns:1.4fr 1fr;gap:20px;align-items:start;">

    {{-- Kolom Kiri --}}
    <div style="display:flex;flex-direction:column;gap:20px;">
        <div class="card">
            <div class="card-header">
                <h3>Informasi Produk/Layanan</h3>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm">← Kembali</a>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Nama <span class="required">*</span></label>
                    <input type="text" name="nama" class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                           value="{{ old('nama', $product->nama ?? '') }}" required placeholder="Nama produk/layanan">
                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="kategori" class="form-control"
                           value="{{ old('kategori', $product->kategori ?? '') }}" placeholder="Contoh: Transportasi, Food & Beverage">
                    <div class="form-hint">Opsional. Dipakai sebagai label badge dan filter.</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi Singkat</label>
                    <textarea name="deskripsi_singkat" class="form-control" rows="3"
                              placeholder="Ringkasan 1-2 kalimat untuk tampil di card">{{ old('deskripsi_singkat', $product->deskripsi_singkat ?? '') }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi Lengkap</label>
                    <textarea name="deskripsi_lengkap" class="form-control" rows="7"
                              placeholder="Deskripsi detail, boleh panjang">{{ old('deskripsi_lengkap', $product->deskripsi_lengkap ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3>SEO</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control"
                           value="{{ old('meta_title', $product->meta_title ?? '') }}" placeholder="Judul di Google (maks 60 karakter)">
                </div>
                <div class="form-group">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="2"
                              placeholder="Deskripsi di Google (maks 160 karakter)">{{ old('meta_description', $product->meta_description ?? '') }}</textarea>
                </div>
            </div>
        </div>
    </div>

    {{-- Kolom Kanan --}}
    <div style="display:flex;flex-direction:column;gap:20px;">
        <div class="card">
            <div class="card-header"><h3>Thumbnail</h3></div>
            <div class="card-body">
                @if(isset($product) && $product->thumbnail)
                    <img src="{{ asset('storage/'.$product->thumbnail) }}" alt=""
                         style="width:100%;max-height:200px;object-fit:cover;border-radius:10px;margin-bottom:12px;">
                @endif
                <div class="form-group">
                    <label class="form-label">Upload Foto Utama</label>
                    <input type="file" name="thumbnail" class="form-control" accept="image/*">
                    <div class="form-hint">Format JPG/PNG/WebP. Maks 4MB.</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Alt Text Thumbnail</label>
                    <input type="text" name="thumbnail_alt" class="form-control"
                           value="{{ old('thumbnail_alt', $product->thumbnail_alt ?? '') }}" placeholder="Deskripsi gambar untuk SEO">
                </div>
            </div>
        </div>

        @if(isset($product))
        <div class="card">
            <div class="card-header">
                <h3>Galeri Foto</h3>
                <span class="badge badge-info">{{ $product->images->count() }} foto</span>
            </div>
            <div class="card-body">
                {{-- Galeri existing --}}
                @if($product->images->count())
                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-bottom:16px;">
                    @foreach($product->images as $img)
                    <div style="position:relative;">
                        <img src="{{ asset('storage/'.$img->image) }}" alt="{{ $img->alt_text }}"
                             style="width:100%;height:70px;object-fit:cover;border-radius:8px;">
                        <button type="button"
                                onclick="deleteGalleryImage({{ $img->id }}, this)"
                                style="position:absolute;top:4px;right:4px;background:rgba(239,68,68,.9);color:#fff;border:none;border-radius:4px;width:20px;height:20px;cursor:pointer;font-size:11px;display:flex;align-items:center;justify-content:center;">✕</button>
                    </div>
                    @endforeach
                </div>
                @endif
                {{-- Upload galeri baru --}}
                <div class="form-group" style="margin:0;">
                    <label class="form-label">Tambah Foto Galeri</label>
                    <input type="file" name="galeri[]" class="form-control" accept="image/*" multiple>
                    <div class="form-hint">Bisa pilih beberapa file sekaligus.</div>
                </div>
            </div>
        </div>
        @endif

        <div class="card">
            <div class="card-header"><h3>Pengaturan</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Urutan Tampil</label>
                    <input type="number" name="order" class="form-control"
                           value="{{ old('order', $product->order ?? 0) }}" min="0">
                </div>
                <div class="form-group" style="display:flex;align-items:center;gap:10px;">
                    <label class="toggle">
                        <input type="checkbox" name="is_active" value="1"
                               {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                    <label class="form-label" style="margin:0;">Tampilkan di website</label>
                </div>
            </div>
        </div>

        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-primary">💾 Simpan</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </div>

</div>
</form>
@endsection

@push('scripts')
<script>
function deleteGalleryImage(id, btn) {
    Swal.fire({
        title: 'Hapus foto ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal',
    }).then(result => {
        if (!result.isConfirmed) return;
        fetch(`/panel/produk-layanan/image/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            }
        }).then(r => r.json()).then(data => {
            if (data.status === 'ok') {
                btn.closest('div').remove();
                Swal.fire({ toast: true, position: 'center', icon: 'success', title: 'Foto dihapus', showConfirmButton: false, timer: 2000 });
            }
        });
    });
}
</script>
@endpush
