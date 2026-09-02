@extends('admin.layouts.app')
@section('page-title', 'Profil Perusahaan')
@section('breadcrumb') / Profil Perusahaan@endsection

@section('content')

<div style="display:grid;grid-template-columns:1fr;gap:20px;">

{{-- Profil Utama --}}
<div class="card">
    <div class="card-header">
        <h3>🏢 Data Profil Perusahaan</h3>
        @if($company)
            <span class="badge badge-success">Data tersedia</span>
        @else
            <span class="badge badge-warning">Belum ada data</span>
        @endif
    </div>
    <form action="{{ route('admin.company-profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="card-body">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div class="form-group">
                    <label class="form-label">Nama Resmi Perusahaan <span class="required">*</span></label>
                    <input type="text" name="nama_resmi" class="form-control" required
                           value="{{ old('nama_resmi', $company->nama_resmi ?? '') }}" placeholder="PT Dharma Putra Airlangga">
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Singkat / Brand</label>
                    <input type="text" name="nama_singkat" class="form-control"
                           value="{{ old('nama_singkat', $company->nama_singkat ?? '') }}" placeholder="DPA Corp">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Tagline</label>
                <input type="text" name="tagline" class="form-control"
                       value="{{ old('tagline', $company->tagline ?? '') }}" placeholder="Slogan perusahaan">
            </div>

            <hr style="border:none;border-top:1px solid var(--border);margin:16px 0;">

            <div class="form-group">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="2">{{ old('alamat', $company->alamat ?? '') }}</textarea>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;">
                <div class="form-group">
                    <label class="form-label">Kota</label>
                    <input type="text" name="kota" class="form-control" value="{{ old('kota', $company->kota ?? '') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Provinsi</label>
                    <input type="text" name="provinsi" class="form-control" value="{{ old('provinsi', $company->provinsi ?? '') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Kode Pos</label>
                    <input type="text" name="kode_pos" class="form-control" value="{{ old('kode_pos', $company->kode_pos ?? '') }}">
                </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                <div class="form-group">
                    <label class="form-label">Koordinat Latitude</label>
                    <input type="text" name="lat" class="form-control"
                           value="{{ old('lat', $company->lat ?? '') }}" placeholder="-7.261553">
                </div>
                <div class="form-group">
                    <label class="form-label">Koordinat Longitude</label>
                    <input type="text" name="lng" class="form-control"
                           value="{{ old('lng', $company->lng ?? '') }}" placeholder="112.740793">
                </div>
            </div>
            <div class="form-hint" style="margin-bottom:16px;">💡 Dapatkan koordinat dari Google Maps → klik kanan di lokasi → "What's here?"</div>

            <hr style="border:none;border-top:1px solid var(--border);margin:16px 0;">

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                <div class="form-group">
                    <label class="form-label">Telepon</label>
                    <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $company->telepon ?? '') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">WhatsApp</label>
                    <input type="text" name="whatsapp" class="form-control"
                           value="{{ old('whatsapp', $company->whatsapp ?? '') }}" placeholder="628xxxxxxxxxx">
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $company->email ?? '') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Jam Operasional</label>
                    <input type="text" name="jam_operasional" class="form-control"
                           value="{{ old('jam_operasional', $company->jam_operasional ?? '') }}" placeholder="Senin–Jumat: 08.00–17.00 WIB">
                </div>
            </div>

            <hr style="border:none;border-top:1px solid var(--border);margin:16px 0;">

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                <div class="form-group">
                    <label class="form-label">Instagram</label>
                    <input type="text" name="instagram" class="form-control"
                           value="{{ old('instagram', $company->instagram ?? '') }}" placeholder="@username">
                </div>
                <div class="form-group">
                    <label class="form-label">TikTok</label>
                    <input type="text" name="tiktok" class="form-control"
                           value="{{ old('tiktok', $company->tiktok ?? '') }}" placeholder="@username">
                </div>
                <div class="form-group">
                    <label class="form-label">YouTube</label>
                    <input type="text" name="youtube" class="form-control" value="{{ old('youtube', $company->youtube ?? '') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Facebook</label>
                    <input type="text" name="facebook" class="form-control" value="{{ old('facebook', $company->facebook ?? '') }}">
                </div>
            </div>

            <hr style="border:none;border-top:1px solid var(--border);margin:16px 0;">

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div class="form-group">
                    <label class="form-label">Logo Perusahaan</label>
                    @if($company && $company->logo)
                        <img src="{{ asset('storage/'.$company->logo) }}" alt="Logo" style="height:60px;display:block;margin-bottom:8px;border-radius:6px;">
                    @endif
                    <input type="file" name="logo" class="form-control" accept="image/*">
                    <div class="form-hint">SVG/PNG transparan direkomendasikan.</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Alt Text Logo</label>
                    <input type="text" name="logo_alt" class="form-control"
                           value="{{ old('logo_alt', $company->logo_alt ?? '') }}" placeholder="Logo DPA Corp">
                    <label class="form-label" style="margin-top:12px;">Cover / Banner Header</label>
                    <input type="file" name="cover" class="form-control" accept="image/*">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">💾 Simpan Profil Perusahaan</button>
        </div>
    </form>
</div>

{{-- SEO Settings --}}
<div class="card">
    <div class="card-header">
        <h3>🔍 Pengaturan SEO Global</h3>
    </div>
    <form action="{{ route('admin.seo-settings.update') }}" method="POST">
        @csrf @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label class="form-label">Meta Title Default</label>
                <input type="text" name="default_meta_title" class="form-control"
                       value="{{ old('default_meta_title', $seo->default_meta_title ?? '') }}"
                       placeholder="Judul default di Google (maks 60 karakter)">
            </div>
            <div class="form-group">
                <label class="form-label">Meta Description Default</label>
                <textarea name="default_meta_description" class="form-control" rows="3"
                          placeholder="Deskripsi default di Google (maks 160 karakter)">{{ old('default_meta_description', $seo->default_meta_description ?? '') }}</textarea>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                <div class="form-group">
                    <label class="form-label">Google Analytics ID</label>
                    <input type="text" name="google_analytics_id" class="form-control"
                           value="{{ old('google_analytics_id', $seo->google_analytics_id ?? '') }}" placeholder="G-XXXXXXXXXX">
                </div>
                <div class="form-group">
                    <label class="form-label">Google Site Verification</label>
                    <input type="text" name="google_site_verification" class="form-control"
                           value="{{ old('google_site_verification', $seo->google_site_verification ?? '') }}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">💾 Simpan Pengaturan SEO</button>
        </div>
    </form>
</div>

</div>
@endsection
