@extends('admin.layouts.app')
@section('page-title', isset($subsidiary) ? 'Edit Anak Perusahaan' : 'Tambah Anak Perusahaan')
@section('breadcrumb') / <a href="{{ route('admin.subsidiaries.index') }}">Anak Perusahaan</a> / {{ isset($subsidiary) ? 'Edit' : 'Tambah' }}@endsection

@section('content')
<form action="{{ isset($subsidiary) ? route('admin.subsidiaries.update', $subsidiary) : route('admin.subsidiaries.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($subsidiary)) @method('PUT') @endif

<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;align-items:start;">
    <!-- Kolom Kiri -->
    <div style="display:flex;flex-direction:column;gap:20px;">
        <div class="card">
            <div class="card-header">
                <h3>Informasi Utama</h3>
                <a href="{{ route('admin.subsidiaries.index') }}" class="btn btn-secondary btn-sm">← Kembali</a>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Nama Perusahaan <span class="required">*</span></label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $subsidiary->nama ?? '') }}" required>
                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi Singkat (untuk card)</label>
                    <textarea name="deskripsi_singkat" class="form-control" rows="3">{{ old('deskripsi_singkat', $subsidiary->deskripsi_singkat ?? '') }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi Lengkap</label>
                    <textarea name="deskripsi_lengkap" class="form-control" rows="5">{{ old('deskripsi_lengkap', $subsidiary->deskripsi_lengkap ?? '') }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2">{{ old('alamat', $subsidiary->alamat ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3>Legalitas (Opsional)</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Tanggal Pendirian</label>
                    <input type="date" name="tanggal_pendirian" class="form-control" value="{{ old('tanggal_pendirian', isset($subsidiary->tanggal_pendirian) ? $subsidiary->tanggal_pendirian->format('Y-m-d') : '') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">No. Akta Pendirian</label>
                    <input type="text" name="no_akta" class="form-control" value="{{ old('no_akta', $subsidiary->no_akta ?? '') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">No. SK Kemenkumham</label>
                    <input type="text" name="no_sk_kemenkumham" class="form-control" value="{{ old('no_sk_kemenkumham', $subsidiary->no_sk_kemenkumham ?? '') }}">
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3>SEO</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $subsidiary->meta_title ?? '') }}" placeholder="Judul di Google (maks 60 karakter)">
                </div>
                <div class="form-group">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="2" placeholder="Deskripsi singkat (maks 160 karakter)">{{ old('meta_description', $subsidiary->meta_description ?? '') }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan -->
    <div style="display:flex;flex-direction:column;gap:20px;">
        <div class="card">
            <div class="card-header"><h3>Media</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Logo</label>
                    @if(isset($subsidiary) && $subsidiary->logo)
                        <img src="{{ Storage::url($subsidiary->logo) }}" alt="" style="height:60px;margin-bottom:8px;display:block;border-radius:6px;">
                    @endif
                    <input type="file" name="logo" class="form-control" accept="image/*">
                </div>
                <div class="form-group">
                    <label class="form-label">Alt Text Logo</label>
                    <input type="text" name="logo_alt" class="form-control" value="{{ old('logo_alt', $subsidiary->logo_alt ?? '') }}" placeholder="Logo PT ...">
                </div>
                <div class="form-group">
                    <label class="form-label">Cover Image (Banner Card)</label>
                    @if(isset($subsidiary) && $subsidiary->cover_image)
                        <img src="{{ Storage::url($subsidiary->cover_image) }}" alt="" style="height:80px;width:100%;object-fit:cover;margin-bottom:8px;border-radius:6px;">
                    @endif
                    <input type="file" name="cover_image" class="form-control" accept="image/*">
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3>Website & Kontak</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Website URL <span style="font-size:11px;color:var(--text-muted);">(kosong = tampilkan modal info)</span></label>
                    <input type="url" name="website_url" class="form-control {{ $errors->has('website_url') ? 'is-invalid' : '' }}"
                           value="{{ old('website_url', $subsidiary->website_url ?? '') }}" placeholder="https://www.contoh.com">
                    @error('website_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $subsidiary->email ?? '') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">WhatsApp</label>
                    <input type="text" name="whatsapp" class="form-control" value="{{ old('whatsapp', $subsidiary->whatsapp ?? '') }}" placeholder="628xxxxxxxxxx">
                </div>
                <div class="form-group">
                    <label class="form-label">Instagram</label>
                    <input type="text" name="instagram" class="form-control" value="{{ old('instagram', $subsidiary->instagram ?? '') }}" placeholder="@username">
                </div>
                <div class="form-group">
                    <label class="form-label">TikTok</label>
                    <input type="text" name="tiktok" class="form-control" value="{{ old('tiktok', $subsidiary->tiktok ?? '') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">YouTube</label>
                    <input type="text" name="youtube" class="form-control" value="{{ old('youtube', $subsidiary->youtube ?? '') }}">
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3>Pengaturan Tampil</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Urutan Tampil</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $subsidiary->order ?? 0) }}" min="0">
                </div>
                <div class="form-group" style="display:flex;align-items:center;gap:10px;">
                    <label class="toggle">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $subsidiary->is_active ?? true) ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                    <label class="form-label" style="margin:0;">Tampilkan di website</label>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Layanan / Produk Singkat</h3>
                <button type="button" class="btn btn-secondary btn-sm" onclick="addService()">+ Tambah</button>
            </div>
            <div class="card-body">
                <div id="services-container">
                    @if(isset($subsidiary) && $subsidiary->services->count())
                        @foreach($subsidiary->services as $i => $svc)
                        <div class="service-row" style="display:flex;gap:8px;margin-bottom:8px;">
                            <input type="text" name="services[{{ $i }}][nama_layanan]" class="form-control" placeholder="Nama Layanan" value="{{ $svc->nama_layanan }}" style="flex:1;">
                            <input type="text" name="services[{{ $i }}][icon]" class="form-control" placeholder="Emoji/icon" value="{{ $svc->icon }}" style="width:80px;">
                            <button type="button" class="btn btn-danger btn-sm btn-icon" onclick="this.closest('.service-row').remove()">✕</button>
                        </div>
                        @endforeach
                    @else
                        <div class="service-row" style="display:flex;gap:8px;margin-bottom:8px;">
                            <input type="text" name="services[0][nama_layanan]" class="form-control" placeholder="Nama Layanan" style="flex:1;">
                            <input type="text" name="services[0][icon]" class="form-control" placeholder="Emoji" style="width:80px;">
                            <button type="button" class="btn btn-danger btn-sm btn-icon" onclick="this.closest('.service-row').remove()">✕</button>
                        </div>
                    @endif
                </div>
                <div class="form-hint">Contoh: Tiket Pesawat, Hotel, MICE, Umroh &amp; Haji</div>
            </div>
        </div>

        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-primary">💾 Simpan</button>
            <a href="{{ route('admin.subsidiaries.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </div>
</div>
</form>
@endsection

@push('scripts')
<script>
let svcCount = {{ isset($subsidiary) ? $subsidiary->services->count() : 1 }};
function addService() {
    const container = document.getElementById('services-container');
    const div = document.createElement('div');
    div.className = 'service-row';
    div.style.cssText = 'display:flex;gap:8px;margin-bottom:8px;';
    div.innerHTML = `
        <input type="text" name="services[${svcCount}][nama_layanan]" class="form-control" placeholder="Nama Layanan" style="flex:1;">
        <input type="text" name="services[${svcCount}][icon]" class="form-control" placeholder="Emoji" style="width:80px;">
        <button type="button" class="btn btn-danger btn-sm btn-icon" onclick="this.closest('.service-row').remove()">✕</button>
    `;
    container.appendChild(div);
    svcCount++;
}
</script>
@endpush
